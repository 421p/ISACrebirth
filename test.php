<?php session_start();
    echo 'Hello, ' . $_SESSION['username'];
    $data = date("d-m-Y H:i:s");
    echo $data;
?>
