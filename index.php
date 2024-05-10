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
	<link
		href="https://fonts.googleapis.com/css2?family=Jura:wght@300..700&family=Open+Sans:ital,wght@0,305;1,305&display=swap"
		rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Jura:wght@300..700&family=Open+Sans:ital,wght@0,305;1,305&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
	<!-- CSS Files -->
	<link href="assets/css/material-kit.css?v=2.0.4" rel="stylesheet" />
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="assets/demo/demo.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="assets/css/summernote.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

</head>
<style>
	body {
		background-image: url("assets/img/Картинки/bg_1.svg");
		background-size: cover;
	}
</style>

<body>
	<?php if ($isAdmin != true && $isAssistant != true && $isColvir != true) { ?>
		<form action="assets/api/logout.php" style="position:absolute; margin:1%;">
			<button type="submit" class="logout-btn">Выйти</button>
		</form>
	<?php }
	; ?>
	<!-- проверка на админа -->
	<?php if ($isAdmin != true && $isAssistant != true && $isColvir != true) { ?>
		<div class="send-answer-container">
			<form class="send-answer__form" method="POST">
				<div class="send-answer__form__head">
					<p>Команда </p>
					<img src="assets/img/avatar/<?php echo $teampic; ?>.svg" height="50px" />
					<?php echo "<h3>" . $teamname . "</h3>"; ?>
					<a target="_blank" href="score.php?game=1">
						<button type="button">Смотреть турнирную таблицу!</button>
					</a>
				</div>
				<div class="send-answer__form__answ-container">
					<select name="qnum" required>
						<option value="" disabled selected hidden>На какой вопрос отвечаем?</option>
						<?php
						foreach ($questions as $question) {
							echo ("<option value=" . $question[0] . ">Вопрос №" . $question[0] . "</option>");
						}
						?>
					</select>
					<input type="text" name="answer" class="send-answer__form__answ-container__answ" placeholder="Ваш ответ" required>
					<div class="status-message"></div>
					<input class="send_answ send-answer__form__answ-container__btn" type="submit" name="send_answ" value="Отправить ответ" />
				</div>
			</form>
		</div>
	<?php } else { ?>
		<div class="admin-container">
			<form class="logout-form" action="assets/api/logout.php">
				<button type="submit" class="admin-logout-btn">Выйти</button>
			</form>
			<div class="admin-container__head">
				<p><?php echo "Добро пожаловать, уважаемый " . $teamname . ". Что желаете?"; ?></p>
				<div class="admin-nav">
					<a href="inbox.php"><input class="admin-nav__btn" type="button" value="Ответы"></input></a>
					<a href="score.php"><input class="admin-nav__btn" type="button" value="Турнирная таблица"></input></a>
					<?php if ($isAdmin == true) { ?>
						<a href="wheel.php"><input class="admin-nav__btn" type="button" value="Открыть барабан"></input></a>
					<?php } ?>
				</div>
			</div>

			<div class="update-blocks-container">
				<div class="update-block">
					<div class="update-block__head">
						<p>Изменить название</p>
					</div>
					<input type="text" class="form-control change-input" placeholder="Название Quiz" id="quizName" name="quizName" required>
					<input type="button" class="save-btn quiz_name_save" value="Сохранить"></input>
				</div>
				<div class="update-block">
					<div class="update-block__head">
						<p>Изменить фон</p>
					</div>
					<label for="imageFile" class="custom-file-upload  change-input">
						Выбрать изображение
					</label>
					<input type="file" id="imageFile" name="file" accept="image/*">
					<input type="button" id="uploadBtn" class="save-btn" value="Сохранить"></input>
				</div>
				<div class="update-block">
					<div class="update-block__head">
						<p>Изменить балл</p>
					</div>
					<input type="text" class="form-control change-input" placeholder="Максимальный балл" id="quizMaxScore"
						name="quizMaxScore" required>
					<input type="button" class="save-btn quiz_score_save" value="Сохранить"></input>
				</div>
			</div>
			<!-- добавление вопроса -->
			<div class="add-question-container">
				<div class="update-block insert-question">
					<div class="update-block__head insert-question__head">
						<p>Новый вопрос</p>
					</div>
					<div id="summernote">
						<textarea class="form-control" id="newQuestionTxt" name="newQuestionTxt" value="текст"></textarea>
					</div>
					<input type="text" class="form-control change-input" id="newQuestionType" name="newQuestionType"
						placeholder="Тип вопроса" required>
					<input type="text" class="form-control change-input" id="newQuestionScore" name="newQuestionScore"
						placeholder="Максимальный балл" required>
					<input type="text" class="form-control change-input" id="newQuestionAnsw" name="newQuestionAnsw"
						placeholder="Правильный ответ" required>
					<input type="button" class="insert-question__submit" value="Добавить вопрос"></input>
				</div>
			</div>
			<div id="message"></div>
			<div id="scoreMessage"></div>
			<!-- Список существующих вопросов -->
			<div id="existingQuestions" class="questions-container">
				<?php include 'assets/api/get_questions_script.php'; ?>
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

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://kit.fontawesome.com/936d86183c.js" crossorigin="anonymous"></script>
	<script src="assets/js/summernote.min.js"></script>
	<script src="assets/js/lang/summernote-ru-RU.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
		crossorigin="anonymous"></script>
	<script src="assets/js/index_script.js"></script>
	<script src="assets/js/script.js"></script>
</body>

</html>