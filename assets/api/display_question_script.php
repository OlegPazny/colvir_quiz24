<?php
    require_once "db_connect.php";

    $questionId = $_GET['id'];
    
    $question=mysqli_query($db, "SELECT * FROM `questions` WHERE `id`='".$questionId."'");
    $question=mysqli_fetch_all($question);

    $qnum=$question[0][0];
    $qtext=$question[0][1];
    $qtype=$question[0][2];
    $qscore=$question[0][3];
    $qansw=$question[0][4];

    $isMusic=false;
    if(strpos($qtext, 'youtube.com') !== false){
        $qtext=strip_tags($qtext);
        // Разбор URL-адреса
        $url_parts = parse_url($qtext);

        // Получение параметров запроса
        parse_str($url_parts['query'], $query_params);

        // Извлечение значения параметра 'v' (video_id)
        $video_id = $query_params['v'];

        $isMusic=true;
 
    }
?>