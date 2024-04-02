<?php
require_once "db_connect.php";

$questions = mysqli_query($db, "SELECT * FROM `questions`");
$questions = mysqli_fetch_all($questions);

foreach ($questions as $question) {
    echo "<div class='card question-card' id='questionCard" . $question[0] . "'>
            <div class='card-body'>
                <div class='row' style='justify-content:space-between'>
                    <div class='col-md-9' style='display:flex; align-items: center;'>
                        <p class='card-text'><b>Вопрос №" . $question[0] . "</b></p>
                    </div>
                    <div class='col-md-2 text-right'>
                        <button class='btn btn-primary btn-sm openQuestionBtn' data-question-id='" . $question[0] . "'>Открыть</button>
                        <button class='btn btn-danger btn-sm deleteQuestionBtn' data-question-id='" . $question[0] . "'>Удалить</button>
                        <button class='btn btn-info btn-sm updateQuestionBtn' data-question-id='" . $question[0] . "'>Обновить</button>
                    </div>
                </div>
            </div>
            <!-- Аккордеон для редактора Summernote -->
            <div class='accordion' id='accordionQuestion" . $question[0] . "' style='display:none;'>
                <div class='card'>
                    <div class='card-body'>
                        <div id='summernoteEditor" . $question[0] . "'></div>
                    </div>
                </div>
            </div>
            <!-- Скрытый элемент с текстом вопроса -->
            <div class='question-text' id='questionText" . $question[0] . "' style='display:none;'>" . $question[1] . "</div>
        </div>";
}
?>