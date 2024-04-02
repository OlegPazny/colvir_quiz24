<?php
// Подключение к БД
require_once "db_connect.php";

// Проверка наличия необходимых данных
if (isset($_POST['questionId']) && isset($_POST['questionText'])) {
    // Получаем ID вопроса и текст вопроса из POST-запроса
    $questionId = $_POST['questionId'];
    $questionText = $_POST['questionText'];

    // Обновляем данные вопроса в БД
    $updateQuery = "UPDATE `questions` SET `value` = '$questionText' WHERE `id` = $questionId";
    $result = mysqli_query($db, $updateQuery);

    // Проверяем успешность выполнения запроса
    if ($result) {
        // Отправляем сообщение об успешном обновлении данных
        echo json_encode(array('status' => 'success'));
    } else {
        // Отправляем сообщение об ошибке
        echo json_encode(array('status' => 'error', 'message' => 'Произошла ошибка при обновлении данных вопроса в БД'));
    }
} else {
    // Отправляем сообщение об ошибке отсутствия данных
    echo json_encode(array('status' => 'error', 'message' => 'Отсутствуют необходимые данные для обновления вопроса'));
}
?>