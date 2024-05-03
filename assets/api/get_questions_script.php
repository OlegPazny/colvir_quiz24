<?php
require_once "db_connect.php";

$questions = mysqli_query($db, "SELECT * FROM `questions`");
$questions = mysqli_fetch_all($questions);

foreach ($questions as $question) {
    echo "<div class='question-card' id='questionCard" . $question[0] . "'>
            <div class='card-block'>
                    <p class='card-text'>Вопрос №" . $question[0] . "</p>
                    <div class='questions-control-block'>
                        <input type='button' class='openQuestionBtn control-btn' data-question-id='" . $question[0] . "' value='Открыть'></input>
                        <input type='button' class='updateQuestionBtn control-btn' data-question-id='" . $question[0] . "' value='Изменить'></input>
                        <input type='button' class='deleteQuestionBtn control-btn' data-question-id='" . $question[0] . "' value='Удалить'></input>
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