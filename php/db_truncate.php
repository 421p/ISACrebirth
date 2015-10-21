<?php
    require_once 'db_connect.php';
    require_once 'redirect.php';
    
    $database = "app";
    $duplicate = "mysqldump $database > $database.sql";

    exec($duplicate, $avadaKedavra);

    print_r($avadaKedavra);

    $sql="TRUNCATE TABLE results";
    $connection->query($sql);
    
    redirect("../admin/index.php");
?>