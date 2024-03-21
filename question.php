<?php
session_start();
//проверка на админа
require_once "assets/api/isAdmin.php";
require_once "assets/api/display_question_script.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		Вопрос #
		<?php echo $qnum; ?>
	</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
		name='viewport' />
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css"
		href="https://fonts.googleapis.com/css?family=Jura:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<!-- CSS Files -->
	<link href="assets/css/material-kit.css?v=2.0.4" rel="stylesheet" />


</head>
<style>
	* {
		font-family: "Jura", "Helvetica", "Arial", sans-serif !important;
		font-weight: 500 !important;
	}
</style>
<?php if ($isAdmin == true || $isAssistant == true || $isColvir == true) { ?>

	<body class="login-page sidebar-collapse">
		<div class="page-header"
			style="background-image: url('assets/img/bg0.jpg'); background-size: cover; background-position: top center;">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 ml-auto mr-auto">
						<br /><br />
						<div class="card card-login2">
							<form class="form" method="" action="">
								<div class="card-body">
									<div id="carouselExampleControls" class="carousel slide" data-ride="carousel"
										data-interval="false">
										<div class="carousel-inner">
											<div class="carousel-item active">
												<h3><strong>Вопрос #
														<?php echo $qnum; ?>
													</strong> -
													<?php echo $qtype; ?>
												</h3>
												<center>
													<?php if($isMusic==true){?>
														<iframe width="330" height="200"
															src="https://www.youtube.com/embed/<?php echo ($video_id); ?>"
															frameborder="0"
															allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
															allowfullscreen>
														</iframe>
													<?php }else{?>
														<h1><?php echo($qtext);?></h1>
													<?php }?>
												</center>
											</div>
											<div class="carousel-item">
												<h3><strong>Вопрос #
														<?php echo $qnum; ?>
													</strong> - Ответ</h3>
												<center>
													<h1>
														<?php echo $qansw; ?>
													</h1>
												</center>
											</div>
										</div>

										<a id="prv" class="carousel-control-prev" href="#carouselExampleControls"
											role="button" data-slide="prev">
											<span class="sr-only">Назад</span>
										</a>
										<a id="nxt" class="carousel-control-next" href="#carouselExampleControls"
											role="button" data-slide="next" onclick="rsoundPlay();return false;">
											<span class="sr-only">Далее</span>
										</a>

									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-lg-12 ml-auto mr-auto">
						<div class="card card-login2">
							<div class="card-body"><br /><br />
								<center>
									<audio id="qsound" src="assets/mp3/qsound.mp3" volume="0.3" loop></audio>
									<span style="font-size:120px; color: black;" id="seconds">00</span>&nbsp;&nbsp;<span
										style="font-size:90px; color: black; "></span><br /><span
										style="font-size:60px; color: black; visibility: hidden;" id="tens">00</span><br />
									<button id="button-start" type="button" class="btn btn-success">Старт</button>
									<button type="button" class="btn btn-danger" id="button-stop">Стоп</button>
									<button id="button-reset" type="button" class="btn btn-primary">Сброс</button>
									<audio id="msound" src="assets/mp3/readingnew3.mp3" volume="0.35" loop autoplay></audio>
									<audio id="rsound" src="assets/mp3/zastavka.mp3" volume="0.35" loop></audio>
								</center>
							</div>
						</div>
					</div>





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