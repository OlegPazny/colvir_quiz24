<?php
// Устанавливаем время жизни сессии в 3 часа (в секундах)
$session_lifetime = 3 * 60 * 60;
ini_set('session.gc_maxlifetime', $session_lifetime);

// Запускаем сессию
session_start();

// Обновляем время жизни сессии
if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > $session_lifetime) {
    // Если прошло более $session_lifetime секунд с момента последней активности, уничтожаем сессию
    session_unset();
    session_destroy();
    session_start(); // Начинаем новую сессию
} 

$_SESSION['last_activity'] = time(); // Обновляем время последней активности
    //подключение БД
    require_once "db_connect.php";
    require_once "answer_script.php";

	$qnum=$_POST["qnum"];
    // $maxscore=mysqli_query($db, "SELECT `max_score` FROM `questions` WHERE `id`=".$qnum.";");
    // $maxscore=mysqli_fetch_all($maxscore);
	$answer=htmlspecialchars($_POST["answer"], ENT_QUOTES);	

    $insert_q_data = mysqli_query($db, "INSERT INTO `answers`(`ID_team`, `ID_question`, `answer`, `time`, `ID_maxscore`, `ID_rightanswer`) VALUES ('" . $id . "','" . $qnum . "','" . $answer . "','" . date('h:i:sa') . "','".$qnum."', '".$qnum."')");
?>