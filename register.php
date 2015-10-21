<?php
    require_once 'php/db_connect.php';
    require_once 'php/redirect.php';
    
    
    if(isset($_POST['username']) && $_POST['password'] && $_POST['email']){
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $email = $_POST['email'];
    
    }

    if(!ok())
        die("Error :(" . $connection->error());

    $sql_request = "SELECT * FROM users WHERE username = '$username'";
    
    $result = $connection->query($sql_request);
    
    
    
    if($result->num_rows==0){
        /*if there is no login mathing this one, then we let the user register*/
        $sql_request = "INSERT INTO users (username, password, email) 
                           VALUES ('$username', '$password', '$email')";
        $connection->query($sql_request);
        redirect("index.html");
    }
    else 
    echo "Login is already taken, the unknown one.Come back and take another one.";
?>