<?php


// Запускаем сессию
session_start();


//проверка на админа, ассистента
require_once "isAdmin.php";
//подключение к БД
require_once "db_connect.php";
//получаем вопросы
$questions = mysqli_query($db, "SELECT * FROM `questions`");
$questions = mysqli_fetch_all($questions);
//получаем данные команд
$teams = mysqli_query($db, "SELECT * FROM `teams` ORDER BY `teamname` ASC");
$teams = mysqli_fetch_all($teams);
//получаем ответы
$answers = mysqli_query($db, "SELECT `answers`.`id`, teamname, value, answer, time, max_score, score, right_answer FROM `answers` INNER JOIN `teams` ON `answers`.`ID_team` = `teams`.`id` INNER JOIN `questions` ON `answers`.`ID_question` = `questions`.`id` and `answers`.`ID_maxscore` = `questions`.`id` and `answers`.`ID_rightanswer`=`questions`.`id`;");
$answers = mysqli_fetch_all($answers);
?>