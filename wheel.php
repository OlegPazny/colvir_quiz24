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
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Jura:wght@300..700&family=Open+Sans:ital,wght@0,305;1,305&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <script src="https://cdn.jsdelivr.net/npm/tinycolor2"></script>
  <style type="text/css">
    body{
      background-color: #fff;
    }
    a{
      text-decoration: none;
      color: #fff;
    }
    a:hover{
      text-decoration: none;
      color:#fff;
    }
  </style>
</head>

<body onLoad="qsoundStop();">
  <div id="chart"></div>
  <div id="question">
    <h1></h1>
  </div>
  <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
  <audio id="msound" src="assets/mp3/msoundnew.mp3" volume="0.1" loop></audio>
  <audio id="qsound" src="assets/mp3/qsound.mp3" volume="0.3" loop></audio>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="module" src="assets/js/wheel_script.js"></script>
</body>
</html>