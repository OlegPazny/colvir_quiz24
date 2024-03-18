<?php
    require_once "db_connect.php";

    // Выполняем запрос к базе данных
$questions = mysqli_query($db, "SELECT * FROM `questions`");

if ($questions) {
    // Преобразуем результат в ассоциативный массив
    $questionsData = mysqli_fetch_all($questions, MYSQLI_ASSOC);
    
    // Возвращаем результат в виде JSON
    echo json_encode($questionsData);
} else {
    // Если произошла ошибка при выполнении запроса
    echo json_encode(array('error' => 'Ошибка выполнения запроса'));
}
?>