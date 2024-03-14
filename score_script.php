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

$teams = mysqli_query($db, "SELECT * FROM `users_tournament` ORDER BY `teamscore` DESC");
$teams = mysqli_fetch_all($teams);
//получаем максимальный балл
$max_score=mysqli_query($db, "SELECT `max_score` FROM `quiz` WHERE `id`=1");
$max_score=mysqli_fetch_all($max_score);

$max_score=$max_score[0][0];
?>