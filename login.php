<?php session_start();
require_once 'php/db_connect.php';
require_once 'php/redirect.php';
    if(!ok())
        die("Error :(");
    
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    echo $password;
    
    $sql_request = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $connection->query($sql_request);
    if($result->num_rows==1){echo "WOW SUCH LOGIN MUCH WORK WOW";
        
        $_SESSION['username'] = $username;
        redirect('prototype.php');
    }
    
?>