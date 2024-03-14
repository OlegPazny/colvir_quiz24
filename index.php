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
if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > $session_lifetime) {
    // Если прошло более $session_lifetime секунд с момента последней активности, уничтожаем сессию
    session_unset();
    session_destroy();
    session_start(); // Начинаем новую сессию
} 

$_SESSION['last_activity'] = time(); // Обновляем время последней активности

include "answer_script.php";
require_once "get_bg.php";
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
	<!-- CSS Files -->
	<link href="assets/css/material-kit.css?v=2.0.4" rel="stylesheet" />
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="assets/demo/demo.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<style>


</style>

<body class="login-page sidebar-collapse" style="background-image: url('data:image/jpeg;base64,<?php echo($bg);?>'); background-size:cover; background-repeat:no repeat;">
	<?php if ($isAdmin != true && $isAssistant != true && $isColvir != true) { ?>
		<form action="logout.php" style="position:absolute; margin:1%;">
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
									<h4 class="card-title"><img src="avatar/<?php echo $teampic; ?>.svg"
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
												echo ("<option value=" . $question[0] . ">Вопрос №". $question[0] . "</option>");
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
								<h4 class="card-title"><img src="avatar/<?php echo $teampic; ?>.svg"
										height="50px" />&nbsp;&nbsp;
									<?php echo "Добро пожаловать, уважаемый " . $teamname . ". Что желаете?"; ?>
								</h4>
							</div>
							<div class="card-body">
								<center>
									<a href="logout.php"><button type="button"
											class="btn btn-primary btn-sm">Выйти</button></a>
									<a href="assistant.php"><button type="button" class="btn btn-danger btn-sm">Вводить
											результаты!</button></a>
									<a href="inbox.php"><button type="button" class="btn btn-primary btn-sm">Смотреть
											ответы!</button></a>
									<a href="score.php"><button type="button" class="btn btn-success btn-sm">Смотреть
											турнирную таблицу!</button></a>
									<div class="input-group" style="justify-content: center">
										<label class="input-group-btn" >
											<span class="btn btn-primary btn-sm" style="display: flex; align-items: center; height:95%;">
												<span class="fileinput-new">Выберите изображение</span>
												<input type="file" id="imageFile" name="file" accept="image/*" style="display: none;">
											</span>
										</label>

										<button id="uploadBtn" class="btn btn-primary btn-sm">Сменить фоновое изображение</button>
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
														<input type="text" class="form-control" placeholder="Название Quiz" id="quizName" name="quizName" required>
														</div>
														<button type="submit" class="btn btn-primary btn-block">Сохранить</button>
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
														<input type="text" class="form-control" placeholder="Максимальный балл" id="quizMaxScore" name="quizMaxScore" required>
														</div>
														<button type="submit" class="btn btn-primary btn-block">Сохранить</button>
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
															<input type="text" class="form-control" id="newQuestion" name="newQuestion" placeholder="Текст вопроса" required>
															<input type="text" class="form-control" id="newQuestionType" name="newQuestionType" placeholder="Тип вопроса" required>
															<input type="text" class="form-control" id="newQuestionScore" name="newQuestionScore" placeholder="Максимальный балл" required>
															<input type="text" class="form-control" id="newQuestionAnsw" name="newQuestionAnsw" placeholder="Правильный ответ" required>
														</div>
														<button type="submit" class="btn btn-primary btn-block">Добавить вопрос</button>
													</form>
												</div>
											</div>
											<div class="card">
												<div class="card-body" style="padding: 0 10px 0 10px;">
													<!-- Список существующих вопросов -->
													<div id="existingQuestions">
														<?php include 'get_questions_script.php'; ?>
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
	<script>
		$(document).ready(function () {
			// Обработчик события отправки формы
			$('.form').submit(function (e) {
				e.preventDefault(); // Предотвращаем стандартное поведение формы
				// Получаем данные формы
				var formData = $(this).serialize();
				// Отправляем AJAX запрос
				$.ajax({
					type: 'POST',
					url: 'sendanswer_script.php', // Укажите путь к вашему обработчику на сервере
					data: formData,
					success: function (response) {
						// Очищаем поля формы
						$('.form')[0].reset();

						// Выводим асинхронное сообщение в форме (зеленый цвет)
						$('.status-message').html('<span style="color: green; margin-left: 5%;">Данные успешно отправлены!</span>');
					},
					error: function (xhr, status, error) {
						// Выводим сообщение об ошибке, если что-то пошло не так (красный цвет)
						$('.status-message').html('<span style="color: red; margin-left: 5%;">Произошла ошибка: ' + error + '</span>');
					}
				});
			});
			document.getElementById('uploadBtn').addEventListener('click', function () {
				var fileInput = document.getElementById('imageFile');
				var file = fileInput.files[0];

				// Проверка, был ли выбран файл
				if (!file) {
					alert('Изображение не выбрано!');
					return;
				}

				// Проверка формата файла
				if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
					alert('Пожалуйста, загружайте только изображения формата JPG, JPEG или PNG!');
					return;
				}

				var formData = new FormData();
				formData.append('imageFile', file);

				var xhr = new XMLHttpRequest();
				xhr.open('POST', 'background_img_script.php', true);
				xhr.onload = function () {
					if (xhr.status === 200) {
						// Обработка успешного ответа
						alert('Изображение загружено успешно! Перезагрузите страницу, чтобы увидеть результат!');
					} else {
						// Обработка ошибок
						alert('Произошла ошибка при загрузке изображения!');
					}
				};
				xhr.send(formData);
			});
            // Обработка отправки формы через AJAX
            $('#editForm').submit(function(e){
                e.preventDefault();
                var quizName = $('#quizName').val();
                $.ajax({
                    type: 'POST',
                    url: 'update_quiz_name_script.php',
                    data: {quizName: quizName},
                    success: function(response){
                        $('#message').html(response);
                    }
                });
            });
			// Обработка отправки формы через AJAX
            $('#editScoreForm').submit(function(e){
                e.preventDefault();
                var quizScore = $('#quizMaxScore').val();
                $.ajax({
                    type: 'POST',
                    url: 'update_quiz_score_script.php',
                    data: {quizScore: quizScore},
                    success: function(response){
                        $('#message').html(response);
                    }
                });
            });
			// Обработка добавления вопроса через AJAX
            $('#addQuestionForm').submit(function(event){
                event.preventDefault();
                var newQuestion = $('#newQuestion').val();
				var newQuestionType = $('#newQuestionType').val();
				var newQuestionScore = $('#newQuestionScore').val();
				var newQuestionAnsw = $('#newQuestionAnsw').val();
                $.ajax({
                    type: 'POST',
                    url: 'add_question_script.php',
                    data: {
						newQuestion: newQuestion,
						newQuestionType: newQuestionType,
						newQuestionScore: newQuestionScore,
						newQuestionAnsw: newQuestionAnsw,
					},
                    success: function(response){
                        $('#message').html(response);
                        $('#existingQuestions').load('get_questions_script.php'); // Обновляем список вопросов
                    }
                });
            });

            // Обработка удаления вопроса через делегирование событий
            $('#existingQuestions').on('click', '.deleteQuestionBtn', function(){
                var questionId = $(this).data('question-id');
                $.ajax({
                    type: 'POST',
                    url: 'delete_question_script.php',
                    data: {questionId: questionId},
                    success: function(response){
                        $('#message').html(response);
                        $('#existingQuestions').load('get_questions_script.php'); // Обновляем список вопросов
                    }
                });
            });
		});
	</script>
</body>

</html>