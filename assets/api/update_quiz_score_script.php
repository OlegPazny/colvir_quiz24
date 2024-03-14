<?php
    require_once "db_connect.php";
    // Получение данных из формы
    $quizScore = $_POST['quizScore'];

    // Обновление данных в таблице
    $update_quiz_name = mysqli_query($db, "UPDATE `quiz` SET `max_score`='$quizScore' WHERE `id`=1");
?>