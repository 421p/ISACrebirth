<?php session_start();

require_once 'db_connect.php';

function getRandomWord($len = 10) {
    $word = array_merge(range('a', 'z'), range('A', 'Z'));
    shuffle($word);
    return substr(implode($word), 0, $len);
}

function researchTask($taskNumber, $exec, $uploadDir){
    
    $json = file_get_contents('tasks/silverBite.json');
    $template = json_decode($json, true);
    $counter = 1;
    $responce = array(
        'status' => NULL,
        'time' => array(),
        'memory' => array(),
        'confirms' => 0,
        'taskTestsNumber' => count($template[$taskNumber]['input'])
        );
    $generatedInputName = getRandomWord();
    $generatedMemtimeName = getRandomWord();
    $exec['memtime'] = $uploadDir . $generatedMemtimeName;
    $exec['input'] = $generatedInputName;

    for($i = 0; $i < count($template[$taskNumber]['input']); $i++){
        file_put_contents($uploadDir . $generatedInputName, $template[$taskNumber]['input'][$i]);
        
        $exec_string = implode($exec);
        
        exec($exec_string, $cppData);
        
        unlink($uploadDir . $generatedInputName);
        
        $memtime = explode('*', file_get_contents($uploadDir . $generatedMemtimeName));
        $time = $memtime[0];
        $memory = $memtime[1];
        
        unlink($uploadDir . $generatedMemtimeName);
        
        $string = implode(' ', $cppData);
        unset($cppData);
        
        if($template[$taskNumber]['output'][$i] == $string){
            $counter++;
            $responce['time'][$i] = $time;
            $responce['memory'][$i] = $memory;
            
        } else { 
            $responce['status'] = "Failed on $counter check. ";/* .debug
                $template[$taskNumber]['input'][$i] . ' ' .
                $template[$taskNumber]['output'][$i] . ' ' .
                $string . '<br>' . $exec_string; */
        return $responce; }
    }
        $responce['status'] = "Completed";
        $responce['confirms'] = $counter-1;
        
        return $responce;
}
?>