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
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

</head>
<style>
	body {
		background-image: url("assets/img/Картинки/bg_1.svg");
		background-size: cover;
	}

	.user-container {
		height: 100vh;
		width: 95vw;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}
	.admin-container{
		margin:5% 12%;
		background-color: white;
		padding:2%;
		border-radius: 10px;
		display:flex;
		flex-direction: column;
		align-items: center;
	}
	.user-form {
		display: flex;
		width: 60%;
		justify-content: center;
		align-self: center;
		flex-direction: column;
		align-items: center;
	}

	.head {
		width: 100%;
		display: flex;
		flex-direction: row;
		justify-content: space-around;
		background-color: #1163ae;
		align-items: center;
		padding: 15px 20px;
		border-radius: 25px;
		border: 1px solid #4082be;
		color: white;
		margin-bottom: 25px;
	}

	.head p {
		font-size: 24px;
		font-weight: 400;
		margin: 0;
		margin-right: 10px;
	}

	.head img {
		margin-right: 10px;
	}

	.head h3 {
		font-size: 48px;
		font-weight: bolder;
		margin-right: 10px;
	}

	.head a button,
	input[type="submit"] {
		border: none;
		font-weight: bold;
		background-color: #78b64e;
		color: white;
		border-radius: 5px;
		font-size: 24px;
		padding: 5px 15px;
		margin-top: 10px;
		cursor: pointer;
		transition: 0.5s ease-in-out;
	}

	.head a button:hover,
	input[type="submit"]:hover {
		transition: 0.5s ease-in-out;
		background-color: #89d555;
	}

	.input-container {
		display: flex;
		flex-direction: column;
		align-items: center;
		background-color: white;
		border-radius: 25px;
		padding: 30px 25px;
		width: 100%;
	}

	.input-container select,
	input[type="text"],
	input[type="text"]::placeholder {
		width: 100%;
		background-color: #1163ae;
		color: white;
		font-size: 24px;
		border: none;
		border-radius: 10px;
		padding: 15px 10px;
		margin-bottom: 15px;
	}

	.logout-btn {
		position: absolute;
		border: none;
		color: #1163ae;
		background-color: white;
		font-weight: bold;
		font-size: 24px;
		padding: 10px 15px;
		border-radius: 10px;
		cursor: pointer;
		transition: 0.5s ease-in-out;
	}

	.logout-btn:hover {
		transition: 0.5s ease-in-out;
		background-color: #f1f1f1;
	}

	#exampleFormControlInput1 {
		width: 15%;
	}

	.note-toolbar {
		background-color: white;
		border-bottom: 1px solid gray;
		border-radius: 7px 7px 0 0;
	}

	.note-editing-area {
		background-color: white;
		border-radius: 0 0 7px 7px;
	}

	.note-editor {
		border-radius: 7px;
	}

	.dropdown-toggle,
	.btn-sm {
		background-color: transparent;
	}

	.modal-content {
		align-items: flex-start;
	}

	.modal-title {
		margin-left: 1rem;
	}

	.note-editable {
		text-align: justify;
	}

	.card-body,
	.card-login {
		padding: 0 10px 0 10px !important;
	}


	.admin-head{
		background-color: #1163ae;
		border-radius:5px;
		color:white;
		font-family:"Oswald";
		padding:1%
	}
	.admin-head p{
		font-size: 24px;
		letter-spacing: 0.5px;
		margin:0;
	}
	.admin-logout-btn{
		border: 1px solid #1163ae;
		color: #1163ae;
		background-color: white;
		font-weight: bold;
		font-size: 24px;
		padding: 10px 15px;
		border-radius: 10px;
		cursor: pointer;
		transition: 0.5s ease-in-out;
	}

	.admin-logout-btn:hover {
		transition: 0.5s ease-in-out;
		background-color: #1163ae;
		color:white;
	}
	.logout-form{
		position:absolute;
		left:13%;
	}
	.admin-nav{
		display:flex;
		flex-direction:row;
		justify-content: space-around;
		margin-top:1%;
	}
	button, input[type="button"]{
		background-color: white;
		border: 1px solid #1163ae;
		color:#1163ae;
		border-radius: 5px;
		padding:5px 10px;
		font-size: 22px;
		width: max-content;
		margin-bottom: 10px; /* Отступ между кнопками */
		transition: 0.5s ease-in-out;
		cursor:pointer;
	}
	button:hover, input[type="button"]:hover{
		color:white;
		background-color: #1163ae;
		border:1px solid white;
		transition: 0.5s ease-in-out;
	}

	.update-blocks-container{
		display:flex;
		flex-direction:row;
		margin-top:5%;
		margin-bottom:5%;
		width:70%;
		justify-content: space-between;
	}
	.add-question-container{
		margin-top:5%;
	}
	.questions-container{
		width:100%;
		margin-top:10%;
	}
	.update-block{
		display: flex;
		align-items: center;
		flex-direction: column;
		background-color: #f9f9f9;
		padding:1%;
		width:30%;
		height: auto;
		border-radius: 5px;
	}
	.insert-question{
		width:100%;
	}
	.update-head{
		background-color:#1163ae;
		text-align: center;
		border-radius: 5px;
		padding:2%;
		margin-top:-10%;
		width:100%;
		margin-bottom:5%;
	}
	.insert-question-head{
		margin-top:-5%;
		margin-bottom:2%;
	}
	.update-head p{
		color:white;
		font-family: "Oswald";
		font-size:24px;
		margin:0;
	}
	.save-btn{
		margin-bottom:-10% !important;
	}
	.save-btn, .question_insert, .control-btn{
		background-color: #1163ae !important;
		border: 1px solid white !important;
		color:white !important;
	}
	.save-btn:hover, .question_insert:hover, .control-btn:hover{
		background-color: white !important;
		border: 1px solid #1163ae !important;
		color:#1163ae !important;
	}
	.question_insert{
		margin-bottom:-3% !important;
	}
	input[type="file"] {
		display: none;
	}

	.custom-file-upload {
		background-color: white;
		border: 1px solid #1163ae;
		color:#1163ae;
		border-radius: 5px;
		padding:5px 10px;
		font-size: 18px;
		width: 100%;
		transition: 0.5s ease-in-out;
		cursor:pointer;
		margin-bottom: 15px;
	}
	.custom-file-upload:hover{
		color:white;
		background-color: #1163ae;
		border:1px solid white;
		transition: 0.5s ease-in-out;
	}

	.change-input{
		background-color: white !important;
		border:1px solid #1163ae !important;
		color:#1163ae !important;
		font-size:20px !important;
		border-radius: 5px !important;
	}
	.change-input::placeholder{
		background-color: white !important;
		color:#1163ae !important;
		font-size:20px !important;
	}
	#summernote{
		margin-bottom: 2%;
	}
	.question-card{
		background-color: #f9f9f9;
		border-radius: 5px;
		padding:2%;
		margin-bottom:1%;
	}
	.card-block{
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: space-between;
	}
	.questions-control-block{
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		width:30%;
	}
	.card-text{
		margin:0 !important;
		font-family: "Oswald";
		font-size:18px;
		font-weight: bold;
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
		<div class="user-container">
			<form class="user-form" method="POST">
				<div class="head">
					<p>Команда </p>
					<img src="assets/img/avatar/<?php echo $teampic; ?>.svg" height="50px" />
					<?php echo "<h3>" . $teamname . "</h3>"; ?>
					<a target="_blank" href="score.php?game=1">
						<button type="button">Смотреть турнирную таблицу!</button>
					</a>
				</div>
				<div class="input-container">
					<select name="qnum" required>
						<option value="" disabled selected hidden>На какой вопрос отвечаем?</option>
						<?php
						foreach ($questions as $question) {
							echo ("<option value=" . $question[0] . ">Вопрос №" . $question[0] . "</option>");
						}
						?>
					</select>
					<input type="text" name="answer" placeholder="Ваш ответ" required>
					<div class="status-message"></div>
					<input class="send_answ" type="submit" name="send_answ" value="Отправить ответ" />
				</div>
			</form>
		</div>
	<?php } else { ?>
		<div class="admin-container">
			<form class="logout-form" action="assets/api/logout.php">
				<button type="submit" class="admin-logout-btn">Выйти</button>
			</form>
			<div class="admin-head">
				<p><?php echo "Добро пожаловать, уважаемый " . $teamname . ". Что желаете?"; ?></p>
				<div class="admin-nav">
					<a href="inbox.php"><input type="button" value="Ответы"></input></a>
					<a href="score.php"><input type="button" value="Турнирная таблица"></input></a>
					<?php if ($isAdmin == true) { ?>
						<a href="wheel.php"><input type="button" value="Открыть барабан"></input></a>
					<?php } ?>
				</div>
			</div>

			<div class="update-blocks-container">
				<div class="update-block">
					<div class="update-head">
						<p>Изменить название</p>
					</div>
					<input type="text" class="form-control change-input" placeholder="Название Quiz" id="quizName" name="quizName" required>
					<input type="button" class="save-btn quiz_name_save" value="Сохранить"></input>
				</div>
				<div class="update-block">
					<div class="update-head">
						<p>Изменить фон</p>
					</div>
					<label for="imageFile" class="custom-file-upload  change-input">
						Выбрать изображение
					</label>
					<input type="file" id="imageFile" name="file" accept="image/*">
					<input type="button" id="uploadBtn" class="save-btn" value="Сохранить"></input>
				</div>
				<div class="update-block">
					<div class="update-head">
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
					<div class="update-head insert-question-head">
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
					<input type="button" class="question_insert" value="Добавить вопрос"></input>
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