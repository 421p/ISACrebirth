<?php
    require_once 'db_connect.php';
    
    $sql_string = "SELECT * FROM users";
    $result = $connection->query($sql_string);
    
    $tempArr = array();
    
    $tempArray = $result->fetch_all(MYSQLI_ASSOC);
    
    foreach($tempArray as $i){
        $x = $i["username"];
        $sql_string = "INSERT INTO results (username) VALUES ('$x')";
        //echo $i['username'];
       
        $connection->query($sql_string);
    }
    
    print_r($tempArray);
    

?>