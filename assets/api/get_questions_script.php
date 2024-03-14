<?php
    require_once "db_connect.php";

    $questions=mysqli_query($db, "SELECT * FROM `questions`");
    $questions=mysqli_fetch_all($questions);

    foreach($questions as $question){
        echo "<div class='card'>
                <div class='card-body'>
                    <div class='row'>
                        <div class='col-md-9' style='display:flex; align-items: center;'>
                            <p class='card-text'>Вопрос №".$question[0]."</p>
                        </div>
                        <div class='col-md-2 text-right'>
                            <button class='btn btn-danger btn-sm deleteQuestionBtn' data-question-id='".$question[0]."'>Удалить</button>
                        </div>
                    </div>
                </div>
            </div>";
    }
?>