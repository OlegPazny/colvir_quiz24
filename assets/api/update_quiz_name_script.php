<?php
    require_once "db_connect.php";
    // Получение данных из формы
    $quizName = $_POST['quizName'];

    // Обновление данных в таблице
    $update_quiz_name = mysqli_query($db, "UPDATE `quiz` SET `quiz_name`='$quizName' WHERE `id`=1");
?>