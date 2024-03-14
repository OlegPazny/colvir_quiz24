<?php
    require_once "db_connect.php";

    // Получение данных из формы
    $questionId = $_POST['questionId'];

    // Удаление вопроса из базы данных
    $delete_question = mysqli_query($db, "DELETE FROM `questions` WHERE `id` = '$questionId'");
?>