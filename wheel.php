<?PHP
  session_start();
  //проверка на админа
  require_once "assets/api/isAdmin.php";
  require_once "assets/api/get_bg.php"
?>
<?php
  if ($isAdmin == false && $isAssistant == false && $isColvir == false){
    header('Location: index.php');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>ColvirSuperBaraban</title>
  <link rel="stylesheet" href="assets/css/wheel.css">
  <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Jura:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <style type="text/css">
    body {
      background: url('data:image/jpeg;base64,<?php echo ($bg); ?>') no-repeat;
      background-size: cover;
      background-position: center center;
      background-attachment: fixed;
    }
    a{
      text-decoration: none;
      color: #fff;
    }
    a:hover{
      text-decoration: none;
      color:#fff;
    }
    #chart svg {
    max-width: 100%;
    max-height: 100%;
    width:auto;
    height: auto;
}
  </style>
</head>

<body onLoad="qsoundStop();">
  <center>
    <!-- partial:index.partial.html -->
    <div id="chart"></div>
    <div id="question">
      <h1></h1>
    </div>
    <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <!-- partial -->
    <audio id="msound" src="assets/mp3/msoundnew.mp3" volume="0.1" loop></audio>
    <audio id="qsound" src="assets/mp3/qsound.mp3" volume="0.3" loop></audio>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/wheel_script.js"></script>
  </center>
</body>
</html>