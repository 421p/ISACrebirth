<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Статистика данных</title>
    <link rel="stylesheet" href="../css/admin.css" type="text/css" />
</head>
<body>
    <div id=container>
    <table>
        <tr>
            <td>Имя пользователя</td>
            
            <td>Задача №1(крайняя попытка)</td>
            <td>Задача №2(крайняя попытка)</td>
            <td>Задача №3(крайняя попытка)</td>
            <td>Задача №4(крайняя попытка)</td>
            <td>Задача №5(крайняя попытка)</td>
            
            <td>Код к задаче №1</td>
            <td>Код к задаче №2</td>
            <td>Код к задаче №3</td>
            <td>Код к задаче №4</td>
            <td>Код к задаче №5</td>
            
            <td>Задача №1(кол-во попыток)</td>
            <td>Задача №2(кол-во попыток)</td>
            <td>Задача №3(кол-во попыток)</td>
            <td>Задача №4(кол-во попыток)</td>
            <td>Задача №5(кол-во попыток)</td>
            
            <td>Общее количество баллов</td>
        </tr>
      
    <?php require_once '../php/db_connect.php';
    
        $sql_query="SELECT * FROM results";
        $result = $connection->query($sql_query);
        //This was so lame for me :(
        //I'm sorry, haven't found another way to select all, but one column. If you know one - topin2122@gmail.com
        $tempArr = $result->fetch_all(MYSQLI_ASSOC);
        usort($tempArr, function($a, $b) {
        return $b['points'] - $a['points'];
        });
        foreach($tempArr as $row){
            echo '<tr>'.
                '<td>'.$row['username'].'</td>'.
                '<td>'.$row['task0'].'</td>' .
                '<td>'.$row['task1'].'</td>' .
                '<td>'.$row['task2'].'</td>' .
                '<td>'.$row['task3'].'</td>' .
                '<td>'.$row['task4'].'</td>' .
                
                '<td>'.'<details>'.'<pre>'.$row['code_task0'].'</pre>'.'</details>'.'</td>'.
                '<td>'.'<details>'.'<pre>'.$row['code_task1'].'</pre>'.'</details>'.'</td>'.
                '<td>'.'<details>'.'<pre>'.$row['code_task2'].'</pre>'.'</details>'.'</td>'.
                '<td>'.'<details>'.'<pre>'.$row['code_task3'].'</pre>'.'</details>'.'</td>'.
                '<td>'.'<details>'.'<pre>'.$row['code_task4'].'</pre>'.'</details>'.'</td>'.
                /*
                echo '<td>'.'<pre>'.$row['code_task0'].'</pre>'.'</td>';
                echo '<td>'.'<pre>'.$row['code_task1'].'</pre>'.'</td>';
                echo '<td>'.'<pre>'.$row['code_task2'].'</pre>'.'</td>';
                echo '<td>'.'<pre>'.$row['code_task3'].'</pre>'.'</td>';
                echo '<td>'.'<pre>'.$row['code_task4'].'</pre>'.'</td>';
                */
                '<td>'.$row['attempt_task0'].'</td>'.
                '<td>'.$row['attempt_task1'].'</td>'.
                '<td>'.$row['attempt_task2'].'</td>'.
                '<td>'.$row['attempt_task3'].'</td>'.
                '<td>'.$row['attempt_task4'].'</td>'.
                
                '<td>'.$row['points'].'</td>'.
            '</tr>';
        }
    ?>
    </table>
    </div>
    
    <a href="#">Загрузить задачи</a>
    <a href="../php/db_init.php">Начать олимпиаду!</a><!-- Инициализирует базу результатов, согласно таблице пользователей, тыкать ТОЛЬКО ТОГДА, КОГДА ВСЕ УЧАСТНИКИ ЗАРЕГИСТРИРОВАНЫ-->
    <a href="../php/db_truncate.php" id="BIG_RED_BUTTON">DO NOT PRESS THIS BIG RED BUTTON</a> <!-- Ручной режим, на всякий случай -->
    <a href="../index.html">Вернуться на главную</a>
</body>
</html>