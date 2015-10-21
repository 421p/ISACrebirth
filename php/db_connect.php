<?php
    $db_host = "localhost";
    $db_username = "topin212";
    $db_password = "";
    $db_database = "app";
    
    $connection = new mysqli($db_host, $db_username, $db_password, $db_database);
    
    function ok(){
        if($connection->connect_errno)
            {
                echo 'Error: ' + $connection->connect_error;
                return false;
            }
                
        return true;
    }

?>