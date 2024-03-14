<?php
    require_once "db_connect.php";
    $MaxId = mysqli_query($db,"SELECT MAX(id) AS max_id FROM questions");
    if ($MaxId->num_rows > 0) {
        $MaxId=mysqli_fetch_all($MaxId);
        $newId=$MaxId[0][0]+1;
    }else{
        $newId=1;
    }


    // Получение данных из формы
    $newQuestion = $_POST['newQuestion'];
    $newQuestionType = $_POST['newQuestionType'];
    $newQuestionScore = $_POST['newQuestionScore'];
    $newQuestionAnsw = $_POST['newQuestionAnsw'];

    // Добавление нового вопроса в базу данных
    $add_question = mysqli_query($db, "INSERT INTO questions (id, value, type, max_score, right_answer) VALUES ('$newId', '$newQuestion', '$newQuestionType', '$newQuestionScore', '$newQuestionAnsw')");
?>