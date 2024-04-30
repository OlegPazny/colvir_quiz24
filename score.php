<?php
require_once "assets/api/score_script.php";
require_once "assets/api/get_bg.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		ТУРНИРНАЯ ТАБЛИЦА
	</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
		name='viewport' />
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css"
		href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<!-- CSS Files -->
	<link href="assets/css/material-kit.css?v=2.0.4" rel="stylesheet" />
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="assets/demo/demo.css" rel="stylesheet" />
</head>
<style>
	body {
		background-color: white;
		align-items: center;
		display: flex;
		flex-direction: column;
	}

	.title {
		color: #1163ae;
	}
	.cards-container{
		width:90vw;
		display: flex;
		flex-wrap: wrap;
		justify-content: space-around;
	}
	.card-body h4{
		margin:0;
		margin-bottom: 10px;
		font-weight: 500;
	}
	.card-container{
		width: calc(30% - 140px); /* Ширина карточки на 30% ширины контейнера минус отступы */
    	margin: 40px; /* Отступы между карточками */
		margin-top:10px;
		margin-bottom: 10px;
	}
	.card{
		background-color: #1163ae;
		border-radius: 15px;
		color:white;
	}
	.progress{
		width:70%;
		background-color: white;
		border-radius:5px;
	}
	.progress-bar{
		border-radius: 5px;
	}

	input[type="button"]{
		border:none;
		background-color: #1163ae;
		color:white;
		border-radius: 5px;
		font-size: 24px;
		padding:15px 25px;
		margin-top:10px;
		margin-bottom:10px;
		cursor: pointer;
		font-weight: bold;
		text-transform: uppercase;
		transition: 0.5s ease-in-out;
	}
	input[type="button"]:hover{
		transition: 0.5s ease-in-out;
		color:#1163ae;
		background-color: white;
		border:1px solid #1163ae;
	}
</style>

<body>
	<h2 class="title">Турнирная таблица</h2>

	<div class="cards-container">
		<?php
		$i = 1;
		foreach ($teams as $team) {
			if ($team[1] == "Администратор" || $team[1] == "Ассистент" || $team[1] == "Колвир") {
				continue;
			}
			$progressbar_width = $team[2] * 100 / $max_score;
			echo ("
					<div class='card-container'>
						<div class='card' style='height:75%'>
							<div class='card-body d-flex flex-column'>
								<h4 class='text-left'>" . $i . ". <img src='assets/img/avatar/" . $team[3] . ".svg'
										height='45px' />&nbsp;&nbsp;
									<strong>" . $team[1] . "</strong>
								</h4>
								<div class='progress' style='height: 25px;'>
									<div class='progress-bar bg-success' role='progressbar'
										style='width: " . $progressbar_width . "%' aria-valuenow='25'
										aria-valuemin='0' aria-valuemax='" . $max_score . "'></div>
								</div>
								<div style='align-self:flex-start;'>
								<h4 class='text-left'>(<strong>" . $team[2] . "</strong>)</h4>
								</div>
		
							</div>
						</div>
					</div>
				");
			$i++;
		}
		?>
	</div>
	<a href="index.php">
		<input type="button" value="На главную">
	</a>

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