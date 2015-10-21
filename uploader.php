<?php

require_once 'php/db_connect.php';
require_once 'php/researcher.php';
require_once 'php/redirect.php';
require_once 'php/base_approver.php';

//replace this to JSON next time may be
$points = array(
    "0"=>1,
    "1"=>2,
    "2"=>3,
    "3"=>4,
    "4"=>5,
);

$uploadDir = 'buffer/';
$fileName = $_FILES['SelectedFile']['name'];
$current_file_type = substr(strrchr($fileName, '.'), 1);
$uploadedFile = $uploadDir . $fileName;
$generatedSourceName = getRandomWord();
$generatedRunnerName = getRandomWord();
$taskNumber = $_POST['taskNumber'];
$username = $_POST['sessionUsername'];

switch($current_file_type){
    case 'c' : $compiler = 'tcc'; $generatedSourceName .= '.c';
    break;
    case 'cpp' : $compiler = 'g++'; $generatedSourceName .= '.cpp';
    break;
    case 'py' : $compiler = 'python'; $generatedSourceName .= '.py';
    break;
    default: outputJSON("Please upload only '*.c' or '*.cpp' files.");
    break;
}


// Output JSON
function outputJSON($msg, $status = 'error'){
    header('Content-Type: application/json');
    die(json_encode(array(
        'data' => $msg,
        'status' => $status
    )));
}

// Check for errors
if($_FILES['SelectedFile']['error'] > 0){
    outputJSON('An error ocurred when uploading.');
}
/*
// Check filetype
if($_FILES['SelectedFile']['type'] != 'octet/stream' && $_FILES['SelectedFile']['type'] != 'text/plain'){
    outputJSON('Unsupported filetype uploaded.' . $_FILES['SelectedFile']['type']);
}
*/

// Check filesize
if($_FILES['SelectedFile']['size'] > 1000000){
    outputJSON('File uploaded exceeds maximum upload size.');
}

// Check if the file exists
if(file_exists($uploadDir . $fileName)){
    outputJSON('File with that name already exists.');
}

// Upload file
if(!move_uploaded_file($_FILES['SelectedFile']['tmp_name'], $uploadDir . $generatedSourceName)){
    outputJSON('Error uploading file - check destination is writeable.');
}

$parsedCode = str_replace(array('<', '>'),array('&#60;', '&#62;'),file_get_contents($uploadDir . $generatedSourceName));


//$exec_string = "g++ buffer/$fileName -o buffer/runner && ./buffer/runner > buffer/out.in";

if($compiler == 'python'){
    $exec_comm = array(
        'shell' => 'timeout 1 sh -c "/usr/bin/time -p -f "%e*%M" -o ',
        'memtime' => '',
        'cat' => ' cat ' . $uploadDir,
        'input' => '',
        'execution' => ' | python ' . $uploadDir . $generatedSourceName . '"'
    );
} else {
    $exec_comm = array(
        'compiler' => $compiler,
        'source' => ' ' . $uploadDir . $generatedSourceName,
        'runner' => ' -o ' . $uploadDir . $generatedRunnerName . ' && timeout 1 sh -c "/usr/bin/time -p -f "%e*%M" -o ',
        'memtime' => '',
        'salt' => ' cat ' . $uploadDir,
        'input' => '',
        'execution' => ' | ./' .$uploadDir . $generatedRunnerName . '"'
    );
}

$output_string = "ПУСТОТЕНЬ";

if(approve($username, $taskNumber)){
    $researcher = researchTask($taskNumber,  $exec_comm, $uploadDir);
    
    //Assigning points to the $username
    //If n number of tasks is completed => the task is completed, assign points
    //============
    if($researcher['confirms'] == $researcher['taskTestsNumber']){
        $pointsGained = $points[$taskNumber];
            $sql_request = "UPDATE results SET code_task$taskNumber  = '$parsedCode' WHERE username = '$username'";
            $sql_upd = "UPDATE results SET points = points + $pointsGained WHERE username = '$username'";
            $connection->query($sql_upd);
            $connection->query($sql_request);
            
            $output_string = 'Output from cpp:<br><b> '  .
            '</b><br>' .
            $researcher['status'] . ' ' . $researcher['confirms'] . '/5' .
            '<br><br>' . implode(' ', $researcher['time']) . '    ' . implode( ' ', $researcher['memory']) .
            '<br><br>' . implode(' ', $exec_comm) .
            '<br><br>also your code:<br><pre class="prettyprint">' . $parsedCode . '</pre>' . '<br>' . $taskNumber ;
            
            if($compiler != 'python') unlink($uploadDir . $generatedRunnerName); #УНИЧТОЖЕНИЕ
        }
}
else{
    $output_string = "Task was completed already.";
}

unlink($uploadDir . $generatedSourceName);

//============

//Sending time of completion and number of attempts to the database
//=============
$x = date("d/m/Y H:i:s");;
$sql_request1 = "UPDATE results SET task$taskNumber = '$x', attempt_task$taskNumber = attempt_task$taskNumber + 1 WHERE username = '$username'";
if(!$connection->query($sql_request1))die('BD connection problems.');
//=============


//Succes!
outputJSON($output_string, "succes");

?>
