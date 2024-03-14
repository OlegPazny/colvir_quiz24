<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
    require_once "db_connect.php";

    // Обработка данных из POST-запроса
    foreach ($_POST as $answerId => $points) {
        // Подготовка SQL-запроса для каждого поля ввода
        $sql = mysqli_query($db, "UPDATE `answers` SET `score` = '$points' WHERE `id` = '$answerId'");
    }

    $get_teams=mysqli_query($db, "SELECT * FROM `teams`");
    $teams=mysqli_fetch_all($get_teams);

    foreach($teams as $team){
        $get_points=mysqli_query($db, "SELECT `score` FROM `answers` WHERE ID_team='$team[0]'");
        $points=mysqli_fetch_all($get_points);

        $score=0;
        foreach($points as $point){
            $score=$score+$point[0];
        }
        $insert_points=mysqli_query($db, "UPDATE `teams` SET `teamscore`=$score WHERE `id`='$team[0]'");
    }

    // Отправляем ответ об успешном обновлении
    echo json_encode(['success' => true]);
?>