<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>C++ code uploader/compiler</title>
    
</head>
<body>
    <!-- Тип кодирования данных, enctype, ДОЛЖЕН БЫТЬ указан ИМЕННО так -->
    <form enctype="multipart/form-data" action="ol.php" method="POST">
        <!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла -->
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        <!-- Название элемента input определяет имя в массиве $_FILES -->
        Отправить этот код: <input name="userfile" type="file" />
        <input type="submit" value="Send File" />
    </form>
</body>
</html>


<?php

$uploaddir = 'buffer/';
$filename = $_FILES['userfile']['name'];
$uploadfile = $uploaddir . basename($filename);

if(!empty($_FILES['userfile']) && $_FILES['userfile']['type'] == 'octet/stream'){

    echo '<pre>';
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        echo "Файл корректен и был успешно загружен.\n";
    } else {
        echo "Возможная атака с помощью файловой загрузки!\n";
    }
    
    echo 'Некоторая отладочная информация:<br><br><br>';
    print_r($_FILES);
    echo '<br><br><br>';
    
    $exec_string = "g++ buffer/$filename -o buffer/runner && ./buffer/runner > buffer/out.in";
    
    exec($exec_string);
    
    echo  "Output from cpp: <b>" . file_get_contents('buffer/out.in') . "</b>
    <br>
    Задача успешно выполнена и вам зачислено 1285671657926587216578265872785 баллов.";
    
    unlink('buffer/out.in');
    unlink('buffer/runner');
    unlink('buffer/test.cpp');

    
    print "</pre>";
}
?>