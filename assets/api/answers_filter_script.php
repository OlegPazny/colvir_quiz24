<?php
include 'db_connect.php'; // Подключение к базе данных

if (isset($_POST['teamname'])) {
    $teamname = $_POST['teamname'];
    $sql = "SELECT `answers`.`id`, teamname, value, answer, time, max_score, score, right_answer 
            FROM `answers` 
            INNER JOIN `teams` ON `answers`.`ID_team` = `teams`.`id` 
            INNER JOIN `questions` ON `answers`.`ID_question` = `questions`.`id` 
                AND `answers`.`ID_maxscore` = `questions`.`id` 
                AND `answers`.`ID_rightanswer` = `questions`.`id`";

    if (!empty($teamname)) {
        $sql .= " WHERE teamname = '$teamname'";
    }

    $result = mysqli_query($db, $sql);

    if ($result) {
        $html = '<table class="table">';
        $html .= '<thead><tr><th>#</th><th>Команда</th><th>Ответ</th><th>Время</th></tr></thead>';
        $html .= '<tbody>';

        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $html .= '<tr>';
            $html .= '<td>' . $i . '</td>';
            $html .= '<td>' . $row['teamname'] . '</td>';
            $html .= '<td>' . $row['answer'] . '</td>';
            $html .= '<td>' . $row['time'] . '</td>';
            $html .= '</tr>';
            $i++;
        }

        $html .= '</tbody>';
        $html .= '</table>';

        echo $html;
    } else {
        echo "Ошибка при выполнении запроса: " . mysqli_error($db);
    }
} else {
    echo "Ошибка: Не удалось получить данные команды.";
}
?>