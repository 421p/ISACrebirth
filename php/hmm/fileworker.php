<?php


if($_POST['wswd'] == NULL) die();

$depends = $_POST['wswd'];

$empty_json = '[{
    "input": [],
    "output": [],
    "conditions": {
        "ru": "",
        "ua": "",
        "en": ""
    },
    "examples": {
        "input": [],
        "output": []
    }
},
{
    "input": [],
    "output": [],
    "conditions": {
        "ru": "",
        "ua": "",
        "en": ""
    },
    "examples": {
        "input": [],
        "output": []
    }
},
{
    "input": [],
    "output": [],
    "conditions": {
        "ru": "",
        "ua": "",
        "en": ""
    },
    "examples": {
        "input": [],
        "output": []
    }
},
{
    "input": [],
    "output": [],
    "conditions": {
        "ru": "",
        "ua": "",
        "en": ""
    },
    "examples": {
        "input": [],
        "output": []
    }
},
{
    "input": [],
    "output": [],
    "conditions": {
        "ru": "",
        "ua": "",
        "en": ""
    },
    "examples": {
        "input": [],
        "output": []
    }
}]';

$filename = $_POST['filename'];
$taskDir = '../tasks/';
$tasksList = scandir($taskDir);

function danceWithJson($json_string, $delimiter, $filename, $taskDir){
    
    $wArray = json_decode($json_string, true);
    for($i = 0; $i < 5; $i++){
        //Проверочка на соответсиве инпутов аутпутам
        if(substr_count($wArray[$i]['input'], $delimiter) != substr_count($wArray[$i]['output'], $delimiter)) die ('Error. I/O missmatch.');
        if(substr_count($wArray[$i]['examples']['input'], $delimiter) != substr_count($wArray[$i]['examples']['output'], $delimiter)) die ('Error. I/O examples missmatch.');
        
        $wArray[$i]['input'] = explode($delimiter, $wArray[$i]['input']);
        $wArray[$i]['output'] = explode($delimiter, $wArray[$i]['output']);
        $wArray[$i]['examples']['input'] = explode($delimiter, $wArray[$i]['examples']['input']);
        $wArray[$i]['examples']['output'] = explode($delimiter, $wArray[$i]['examples']['output']);    
    }

    
    file_put_contents($taskDir . $filename, json_encode($wArray, JSON_UNESCAPED_UNICODE));
    die('done');
}

function outputJSONListOfFiles($status = 'error'){
    global $tasksList;
    global $taskDir;
    $tasksList = scandir($taskDir);
    
    $msg = "Choose one or create new: <br><br>";
    for($i=2; $i < count($tasksList);$i++){
        $msg .= '<a href="?task=' . ($i-1) . '">' . $tasksList[$i] . '</a> <button data-filename="' . $tasksList[$i] . '" class="_delete">delete</button><br>';   
    }
    $msg .= '<br> <textarea id="_textfield" cols="75" rows = "2" placeholder="For addidng a new tasklist type a customname here and press Ook. Ook?"></textarea> <button id="_create">Ook</button>';

    header('Content-Type: application/json');
    die(json_encode(array(
        'list' => $msg,
        'status' => $status
    )));
}


switch($depends){
    case 'CREATE': file_put_contents($taskDir . $filename . '.json', $empty_json);
    outputJSONListOfFiles('succes');
    break;
    case 'DELETE': $tasksList = scandir($taskDir);
    unlink($taskDir . $filename);
    outputJSONListOfFiles('succes');
    break;
    case 'GETLIST' : outputJSONListOfFiles('succes');
    break;
    case 'EDIT' : danceWithJson($_POST['jsonstring'], '__DELIM__', $filename, $taskDir);
    break;
}

?>
