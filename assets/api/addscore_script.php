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
    if(!$_SESSION["user"]["UserName"]){
        header('Location: signin.php');
    }
    //проверка на админа
    require_once "isAdmin.php";
    //подключение к БД
    require_once "db_connect.php";

    // Получение данных из AJAX-запроса
    $teamId = $_POST['team_id'];
    $score = $_POST['score'];

    $sql = mysqli_query($db, "UPDATE teams SET teamscore = '$score' WHERE id = '$teamId'");
?>