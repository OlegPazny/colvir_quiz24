<?php
require_once "db_connect.php";

$questions = mysqli_query($db, "SELECT * FROM `questions`");
$questions = mysqli_fetch_all($questions);

foreach ($questions as $question) {
    echo "<div class='question-card' id='questionCard" . $question[0] . "'>
            <div class='question-card__block'>
                    <p class='question-card__block__text'>Вопрос №" . $question[0] . "</p>
                    <div class='question-card__control-block'>
                        <input type='button' class='openQuestionBtn question-card__control-block__btn' data-question-id='" . $question[0] . "' value='Открыть'></input>
                        <input type='button' class='updateQuestionBtn question-card__control-block__btn' data-question-id='" . $question[0] . "' value='Изменить'></input>
                        <input type='button' class='deleteQuestionBtn question-card__control-block__btn' data-question-id='" . $question[0] . "' value='Удалить'></input>
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