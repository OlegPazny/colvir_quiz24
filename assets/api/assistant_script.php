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
//проверка на админа, ассистента
require_once "isAdmin.php";
    //получаем результаты
    $results=mysqli_query($db, "SELECT * FROM teams");
    $results = mysqli_fetch_all($results);

    foreach($results as $result){
        $id[$result[0]]=$result[0];
        $teamname[$result[0]]=$result[3];
        $teampic[$result[0]]=$result[5];
        $teamscore[$result[0]]=$result[4];
    };
?>