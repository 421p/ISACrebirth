<?php session_start();
    require_once '../php/redirect.php';
    session_destroy();
    redirect("../index.html");
?>