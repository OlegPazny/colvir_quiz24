<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
// Устанавливаем время жизни сессии в 3 часа (в секундах)
$session_lifetime = 3 * 60 * 60;
ini_set('session.gc_maxlifetime', $session_lifetime);

// Запускаем сессию
session_start();

// Обновляем время жизни сессии
if (isset ($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > $session_lifetime) {
	// Если прошло более $session_lifetime секунд с момента последней активности, уничтожаем сессию
	session_unset();
	session_destroy();
	session_start(); // Начинаем новую сессию
}

$_SESSION['last_activity'] = time(); // Обновляем время последней активности

include "assets/api/answer_script.php";
require_once "assets/api/get_bg.php";
?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		Ответы команд
	</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
		name='viewport' />
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Jura:wght@300..700&family=Open+Sans:ital,wght@0,305;1,305&display=swap" rel="stylesheet">
	<!-- CSS Files -->
	<link href="assets/css/material-kit.css?v=2.0.4" rel="stylesheet" />
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="assets/demo/demo.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="assets/css/summernote.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	
</head>
<style>
#exampleFormControlInput1{
    width:15%;
}
.note-toolbar{
    background-color: white;
    border-bottom:1px solid gray;
    border-radius: 7px 7px 0 0;
  }
.note-editing-area{
    background-color: white;
    border-radius: 0 0 7px 7px;
}
.note-editor{
    border-radius: 7px;
}
.dropdown-toggle, .btn-sm{
    background-color: transparent;
}
.modal-content{
    align-items: flex-start;
}
.modal-title{
    margin-left: 1rem;
}
.note-editable {
    text-align: justify;
}
</style>

<body class="login-page sidebar-collapse"
	style="background-image: url('data:image/jpeg;base64,<?php echo ($bg); ?>'); background-size:cover; background-repeat:no repeat;">
	<?php if ($isAdmin != true && $isAssistant != true && $isColvir != true) { ?>
		<form action="assets/api/logout.php" style="position:absolute; margin:1%;">
			<button type="submit" class="btn btn-secondary" class="logout-btn">Выйти</button>
		</form>
	<?php }
	; ?>
	<div>
		<div class="container" style="padding-top:2%">
			<div class="row">
				<div class="col-lg-10 ml-auto mr-auto">
					<!-- проверка на админа -->
					<?php if ($isAdmin != true && $isAssistant != true && $isColvir != true) { ?>

						<div class="card card-login">
							<form class="form" method="POST">
								<div class="card-header card-header-info text-center">
									<h4 class="card-title"><img src="assets/img/avatar/<?php echo $teampic; ?>.svg"
											height="50px" />&nbsp;&nbsp;
										<?php echo "Команда '" . $teamname . "'"; ?>&nbsp;&nbsp;<a target="_blank"
											href="score.php?game=1"><button type="button"
												class="btn btn-success btn-sm">Смотреть турнирную таблицу!</button></a>
									</h4>
								</div>
								<div class="card-body">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="material-icons">format_list_numbered</i>
											</span>
										</div>
										<select class="form-control" name="qnum" required>
											<option value="" disabled selected hidden>На какой вопрос отвечаем?</option>
											<?php
											foreach ($questions as $question) {
												echo ("<option value=" . $question[0] . ">Вопрос №" . $question[0] . "</option>");
											}
											?>
										</select>
									</div>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="material-icons">question_answer</i>
											</span>
										</div>
										<input type="text" name="answer" class="form-control" placeholder="Ваш ответ..."
											required>
									</div>
								</div>
								<div class="status-message"></div>
								<div class="footer text-center">
									<input type="submit" class="btn btn-info btn-link btn-wd btn-lg" name="send_answ"
										value="Отправить ответ" />
								</div>
							</form>

						</div>

					<?php } else { ?>

						<div class="card card-login">
							<div class="card-header card-header-info text-center">
								<h4 class="card-title"><img src="assets/img/avatar/<?php echo $teampic; ?>.svg"
										height="50px" />&nbsp;&nbsp;
									<?php echo "Добро пожаловать, уважаемый " . $teamname . ". Что желаете?"; ?>
								</h4>
							</div>
							<div class="card-body">
								<center>
									<a href="assets/api/logout.php"><button type="button"
											class="btn btn-primary btn-sm">Выйти</button></a>
									<a href="inbox.php"><button type="button" class="btn btn-danger btn-sm">Смотреть
											ответы!</button></a>
									<a href="score.php"><button type="button" class="btn btn-success btn-sm">Смотреть
											турнирную таблицу!</button></a>
									<?php if ($isAdmin == true) { ?>
										<a href="wheel.php"><button type="button"
												class="btn btn-success btn-sm">Открыть барабан</button></a>
									<?php } ?>
									<div class="input-group" style="justify-content: center">
										<label class="input-group-btn">
											<span class="btn btn-success btn-sm"
												style="display: flex; align-items: center; height:95%;">
												<span class="fileinput-new">Выберите изображение</span>
												<input type="file" id="imageFile" name="file" accept="image/*"
													style="display: none;">
											</span>
										</label>

										<button id="uploadBtn" class="btn btn-primary btn-sm">Сменить фоновое
											изображение</button>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-6 col-md-8 ml-auto mr-auto">
											<div class="card">
												<div class="card-header card-header-primary text-center">
													<h4 class="card-title">Изменить название</h4>
												</div>
												<div class="card-body" style="padding: 0 10px 0 10px;">
													<!-- Форма добавления вопроса -->
													<form id="editForm">
														<div class="form-group">
															<input type="text" class="form-control"
																placeholder="Название Quiz" id="quizName" name="quizName"
																required>
														</div>
														<button type="submit"
															class="btn btn-primary btn-block">Сохранить</button>
													</form>
													<div id="message"></div>
												</div>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-6 col-md-8 ml-auto mr-auto">
											<div class="card">
												<div class="card-header card-header-primary text-center">
													<h4 class="card-title">Изменить максимальный балл</h4>
												</div>
												<div class="card-body" style="padding: 0 10px 0 10px;">
													<!-- Форма изменения баллов -->
													<form id="editScoreForm">
														<div class="form-group">
															<input type="text" class="form-control"
																placeholder="Максимальный балл" id="quizMaxScore"
																name="quizMaxScore" required>
														</div>
														<button type="submit"
															class="btn btn-primary btn-block">Сохранить</button>
													</form>
													<div id="message"></div>
												</div>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-lg-6 col-md-8 ml-auto mr-auto">
											<div class="card">
												<div class="card-header card-header-primary text-center">
													<h4 class="card-title">Вопросы</h4>
												</div>
												<div class="card-body" style="padding: 0 10px 0 10px;">
													<!-- Форма добавления вопроса -->
													<form id="addQuestionForm">
														<div class="form-group">
															<div id="summernote">
																<textarea class="form-control" id="newQuestionTxt" name="newQuestionTxt" value="текст"></textarea>
															</div>
															<input type="text" class="form-control" id="newQuestionType"
																name="newQuestionType" placeholder="Тип вопроса" required>
															<input type="text" class="form-control" id="newQuestionScore"
																name="newQuestionScore" placeholder="Максимальный балл"
																required>
															<input type="text" class="form-control" id="newQuestionAnsw"
																name="newQuestionAnsw" placeholder="Правильный ответ"
																required>
														</div>
														<button type="submit" class="btn btn-primary btn-block">Добавить
															вопрос</button>
													</form>
												</div>
											</div>
											<div class="card">
												<div class="card-body" style="padding: 0 10px 0 10px;">
													<!-- Список существующих вопросов -->
													<div id="existingQuestions">
														<?php include 'assets/api/get_questions_script.php'; ?>
													</div>
												</div>
											</div>
										</div>
									</div>
									<br /><br /><br /><br />
								</center>
							</div>
						</div>
					<?php }
					;
					?>
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
	<script src="assets/js/index_script.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://kit.fontawesome.com/936d86183c.js" crossorigin="anonymous"></script>
	<script src="assets/js/summernote.min.js"></script>
    <script src="assets/js/lang/summernote-ru-RU.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
	<script src="assets/js/script.js"></script>
</body>

</html>