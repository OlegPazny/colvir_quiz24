<!DOCTYPE html>
<?php
	require_once "assets/api/addscore_script.php";	
?>
<html lang="ru">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
		<link rel="icon" type="image/png" href="assets/img/favicon.png">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>
			Староновогодний Colvir Мини-Quiz 2024
		</title>
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
		<!--     Fonts and icons     -->
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato|Material+Icons" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
		<!-- CSS Files -->
		<link href="assets/css/material-kit.css?v=2.0.4" rel="stylesheet" />
		<!-- CSS Just for demo purpose, don't include it in your project -->
		<link href="assets/demo/demo.css" rel="stylesheet" />
	</head>
	
	<body class="login-page sidebar-collapse">
		<div class="page-header" style="background-image: url('assets/img/background.jpg'); background-size: cover; background-position: top center;">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 ml-auto mr-auto">
						<?php if($isAdmin == true || $isAssistant == true || $isColvir == true){ ?>
							<form class="form" method="GET" action="assistant.php">
								<div class="card card-login">
									<div class="card-header card-header-info text-center">
										<h4 class="card-title"><?php echo "Обновление данных..."; ?></h4>
									</div>
									<div class="card-body">
										<center>
											<?php
																						
											?>
											<h4>Данные успешно обновлены</h4><br/><br/>
										</center>
									</div>
									<div class="footer text-center">
										<input type="submit" class="btn btn-info btn-link btn-wd btn-lg" name="submit" value="Назад" />
									</div>
								</div>
							</form>
							<?php }else{ ?>
							<div class="card card-login">
								
								<div class="card-header card-header-info text-center">
									<h4 class="card-title">Ошибка</h4>
								</div>
								<div class="card-body">
									<div class="alert alert-danger" role="alert">Вы неверно заполнили форму. Попробуйте еще раз!</div><br/><Br/>
								</div>
								<div class="footer text-center">
									<a href="index.php" class="btn btn-info btn-link btn-wd btn-lg">Назад</a>
								</div>
							</div>
							
						<?php };?>
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
	</body>
	
</html>					