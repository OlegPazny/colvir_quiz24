<?php
require_once "db_connect.php";
require_once "assistant_script.php";
require_once "get_bg.php";
require_once "quiz_name_script.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		Вводить баллы!
	</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
		name='viewport' />
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<!-- CSS Files -->
	<link href="assets/css/material-kit.css?v=2.0.4" rel="stylesheet" />
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="profile-page sidebar-collapse" style="background-image: url('data:image/jpeg;base64,<?php echo($bg);?>'); background-size:cover; background-repeat:no repeat;">
	<div class="page-header" data-parallax="true"></div>
	<div class="main main-raised">
		<div class="container">
			<?php if ($isAdmin == true || $isAssistant == true || $isColvir == true) { ?>
				<div class="section text-center">
					<div class="row">
						<div class="col-md-8 ml-auto mr-auto">
							<a href="index.php">
								<h2 class="title"><?php echo($quiz_name);?></h2>
							</a>
							<h5 class="description">АРМ ассистента. <strong>Текущие результаты команд.</strong></h5>
						</div>
					</div>
					<div class="features">
						<form class="form" id="scoreForm">
							<div class="row">
								<!-- карточки с командами -->
								<?php foreach ($results as $result) {
									if ($result[1] == "admin" || $result[1] == "assistant" || $result[1] == "colvir") {
										continue;
									}
									;
									?>
									
									<div class="col-md-4 mb-4">
										<div class="card">
											<div class="card-body">
												<div class="input-group" style="flex-direction:column;">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<img src="avatar/<?php echo $result[5]; ?>.svg" height="25px" />&nbsp;&nbsp;
															<?php echo "Команда '" . $result[3] . "'"; ?>
														</span>
													</div>
													<br>
													<input type="text" data-team-id="<?php echo $result[0]; ?>" class="form-control score-input" style="width:100%" value="<?php echo $result[4]; ?>">
												</div>
											</div>
										</div>
									</div>
								<?php }
								; ?>
								<div class="col-md-12">
									<div class="status-message"></div>
									<a href="inbox.php"><button type="button" class="btn btn-primary btn-lg">Смотреть ответы!</button></a>
									<a href="score.php"><button type="button" class="btn btn-success btn-lg">Смотреть турнирную таблицу!</button></a>
									<a href="index.php"><button type="button" class="btn btn-primary btn-lg">На главную!</button></a>
								</div>
							</div>
						</form>
					</div>
				</div>
			<?php } else { ?>
				<div class="section text-center">
					<div class="row">
						<div class="col-md-8 ml-auto mr-auto">
							<h2 class="title">Вы уверены, что авторизовались в системе?</h2>
							<h5 class="description"><a href="index.php">Авторизоваться</a></h5>
						</div>
					</div>
				<?php }
			; ?>
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

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script>
			//обработка введенных результатов
			$(document).ready(function() {
				$('.score-input').on('input', function() {
					//записываем данные
					var teamId = $(this).data('team-id');
					var score = $(this).val();

					// Проверка на float или int
					if (!/^(-?\d+(\.\d+)?|)$/.test(score)) {
						return;
					}
					$.ajax({
						type: 'POST',
						url: 'addscore_script.php',
						data: {
							team_id: teamId,
							score: score
						},
						success: function(response) {
							console.log(response);
							//если все хорошо
							$('.status-message').html('<span style="color: green; margin-left: 5%;">Данные команды '+teamId+' успешно отправлены!</span>');
						},
						error: function(xhr, status, error) {
							console.error(error);
							//если ошибка
							$('.status-message').html('<span style="color: red; margin-left: 5%;">Данные команды '+teamId+' НЕ отправлены!</span>');
						}
					});
				});
			});

		</script>
</body>

</html>