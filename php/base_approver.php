<?php 
require_once 'db_connect.php';

function approve($username, $taskNumber){
    global $connection;
    $check_code_presence = "SELECT * FROM results WHERE username = '$username'";
    $result = $connection->query($check_code_presence);
    $tempArr = $result->fetch_assoc();
    
    if($tempArr["code_task$taskNumber"]==""){
        return true;
    }
    else{
        return false;
    }
}
?>