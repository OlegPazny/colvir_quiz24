<?php
session_start();
//проверка на админа
require_once "assets/api/isAdmin.php";
require_once "assets/api/display_question_script.php";
require_once "assets/api/get_bg.php"
	?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		Вопрос #<?php echo $qnum; ?>
	</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
		name='viewport' />
	<!--     Fonts and icons     -->
	<link
		href="https://fonts.googleapis.com/css2?family=Jura:wght@300..700&family=Open+Sans:ital,wght@0,305;1,305&display=swap"
		rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Jura:wght@300..700&family=Open+Sans:ital,wght@0,305;1,305&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
	<!-- CSS Files -->
	<link href="assets/css/material-kit.css?v=2.0.4" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
</head>
<style>
	*{
		font-family:"Oswald";
	}
	body{
		padding-top:2%;
	}
	h1{
		margin:0;
	}
	.container {
		max-width: 95%;
		display: flex;
		flex-direction: row;
		justify-content: space-around;
	}
</style>
<?php if ($isAdmin == true || $isAssistant == true || $isColvir == true) { ?>

	<body>
		<div class="container">
			<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false">
				<div class="carousel-head">
					<h1>Вопрос <span class="q-blue">№<?php echo $qnum; ?></span></h1> 
					<div class="question-type">
						<?php echo $qtype; ?>
					</div>
				</div>
				<div class="carousel-inner">
					<div class="carousel-item active">
						
						<?php if ($isMusic == true) { ?>
							<div class="video-container">
								<iframe width="330" height="200" src="https://www.youtube.com/embed/<?php echo ($video_id); ?>"
									frameborder="0"
									allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
									allowfullscreen>
								</iframe>
							</div>
						<?php } else { ?>
							<h1>
								<?php echo ($qtext); ?>
							</h1>
						<?php } ?>
					</div>
					<div class="carousel-item">
						<h1>
							<?php echo $qansw; ?>
						</h1>
					</div>
				</div>
				<a id="prv" class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
					<span class="sr-only">Назад</span>
				</a>
				<a id="nxt" class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"
					onclick="rsoundPlay();return false;">
					<span class="sr-only">Далее</span>
				</a>

			</div>
			<div class="time-control-block">
				<audio id="qsound" src="assets/mp3/qsound.mp3" volume="0.3" loop></audio>
				<span style="font-size:120px; color: white;" id="seconds">00</span><span
					style="font-size:90px; color: black; "></span><span
					style="font-size:60px; color: black; visibility: hidden;" id="tens">00</span><br />
				<div class="btn-controls">
					<button id="button-start" class="control-btn" type="button">Старт</button>
					<button id="button-stop" class="control-btn" type="button">Стоп</button>
					<button id="button-reset" class="control-btn" type="button">Сброс</button>
				</div>
				<audio id="msound" src="assets/mp3/readingnew3.mp3" volume="0.35" loop autoplay></audio>
				<audio id="rsound" src="assets/mp3/zastavka.mp3" volume="0.35" loop></audio>
			</div>
		</div>
		</div>
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
		<script src="assets/js/codepen.js"></script>
		<script src="assets/js/index.js"></script>
		<script type="text/javascript" src="assets/js/question_script.js"></script>
	</body>
	<?php
} else {
	header('Location: index.php');
}
?>

</html>