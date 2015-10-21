<?php

function json_read($task){
        global $tasksDir;
        $json = file_get_contents($tasksDir . '/' . $task);
        return json_decode($json, true);
    }
    
    function json_write($task, $template){
        global $tasksDir;
        $json = json_encode($template, JSON_UNESCAPED_UNICODE);
        file_put_contents($tasksDir . '/' . $task, $json);
    }
    
    $template = json_read($tasksList[$_GET['task']+1]);
    
    function getTaskConditions($taskNumber, $lang){
        global $template;
        return $template[$taskNumber]['conditions'][$lang];
    }
    
    function getTaskIO($taskNumber, $which){
        global $template;
        return $template[$taskNumber][$which];
    }
    
    function getTaskExamples($taskNumber, $which){
        global $template;
        return $template[$taskNumber]['examples'][$which];
    }
    
    function getTaskTitle($taskNumber){
        global $template;
        return $template[$taskNumber]['title'];    
    }
    
    function getTaskPoints($taskNumber){
        global $template;
        return $template[$taskNumber]['points'];    
    }
    
?>