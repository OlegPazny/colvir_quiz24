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
require_once "assets/api/get_bg.php";
require_once "assets/api/quiz_name_script.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Авторизация
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
    name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-kit.css?v=2.0.4" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
</head>
<style>
  body{
    background-image: url("assets/img/Картинки/bg_1.svg");
    background-size: cover;
  }
  .container{
    height:100vh;
    width:25%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
  .form-container{
    width:100%;
  }
  .input-container{
    display: flex;
    flex-direction: column;
    width:100%;
    background-color: white;
    border:1px solid #4082be;
    border-radius:25px;
    padding:45px 35px;
    padding-top:30px;
  }
  .head{
    width:100%;
    border:1px solid #4082be;
    background-color: #1163ae;
    width:fit-content;
    height:fit-content;
    border-radius:25px;
    padding:25px 35px;
    display: flex;
    flex-direction:column;
    align-items: center;
    margin-bottom:20px;
  }
  .head h3{
    color:white;
    font-size:45px;
    font-weight: bold;
    text-align: center;
  }
  .head h4{
    font-size:30px;
    font-weight: 500;
    color:white;
  }
  .form{
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  input[type="text"], input[type="password"]{
    height:60px;
    border:none;
    border-bottom: 1px solid #dcdcdc;
  }
  input[type="text"]::placeholder, input[type="password"]::placeholder{
    font-weight: bold;
    color:#7f7f7f;
  }
  .login-btn{
    border:none;
    background-color: #78b64e;
    color:white;
    border-radius: 5px;
    font-size: 24px;
    padding:10px 25px;
    margin-top:10px;
    align-self: center;
  }
  .message {
    color: #951212;
    font-size: 15px;
  }

  .none {
    display: none;
  }

  .error {
    border-bottom: 1px solid red;
  }
</style>
<!-- style="background-image: url('data:image/jpeg;base64,<?php echo ($bg); ?>'); background-size: cover; background-position: top center;" -->
<body>
  <div class="container">
    <div class="head">
      <h3><?php echo ($quiz_name); ?></h3>
      <h4>Авторизация</h4>
    </div>
    <div class="form-container">
      <form class="form">
        <div class="input-container">
          <input type="text" id="text" aria-describedby="emailHelp" name="login" placeholder="Логин">
          <input type="password" name="password" id="exampleInputPassword1" placeholder="Пароль">
        </div>
        <input type="submit" class="login-btn" value="Войти" />
      </form>
    </div>
  </div>

</body>
<script src="assets/js/auth.js"></script>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="assets/js/plugins/moment.min.js"></script>
<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--	Plugin for Sharrre btn -->
<script src="assets/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
<!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
<script src="assets/js/material-kit.js?v=2.0.4" type="text/javascript"></script>

</html>