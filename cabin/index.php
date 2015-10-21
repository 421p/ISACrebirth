<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
</head>
<body>
    
    

<?php

require_once '../php/db_connect.php';

$tasksDir = '../tasks';
$tasksList = scandir($tasksDir);

require_once '../php/littleJSONlib.php';

if($_GET['task'] == NULL){
    
    print('<pre id="preshka"></pre>');
    print('<script src="../js/cabin_listmaker.js"></script>');
   
} else {
    
    print('<pre id="zadachaField">');
    print('<p id="current" data-name="' . $tasksList[$_GET['task']+1] . '">Currently working at: ' . $tasksList[$_GET['task']+1] . '</p>');
    for($i = 0; $i < count($template); $i++){
        print( 
            '<p id="zd' . $i . '">Zadacha #' . $i . ' <br>' . 
            'Title:<br> <textarea class="title" cols="50">' . getTaskTitle($i) . '</textarea>' .
            'Points: <textarea class="points" cols = "5">' . getTaskPoints($i) . '</textarea><br>' .
            '<textarea class="condition" data-lang="ua">' . getTaskConditions($i,'ua') . '</textarea>' .
            '<textarea class="condition" data-lang="ru">' . getTaskConditions($i,'ru') . '</textarea>' .
            '<textarea class="condition" data-lang="en">' . getTaskConditions($i,'en') . '</textarea><br><br>' . 
            'IN:<br><textarea class="input" cols = "89">' . implode('__DELIM__', getTaskIO($i,'input')) . '</textarea><br><br>' .
            'OUT:<br><textarea class="output" cols = "89">' . implode('__DELIM__', getTaskIO($i,'output')) . '</textarea><br><br>' .
            'IN-EX:<br><textarea class="input-examples" cols = "89">' . implode('__DELIM__', getTaskExamples($i,'input')) . '</textarea><br><br>' .
            'OUT-EX:<br><textarea class="output-examples" cols = "89">' . implode('__DELIM__', getTaskExamples($i,'output')) . '</textarea><br><br></p>'
            );
    }
    print('</pre>');
    print('<button id="save">SAVE</button>');
    print('<script src="../js/cabin_jsonmaker.js"></script>');
  
}

?>

</body>
</html>