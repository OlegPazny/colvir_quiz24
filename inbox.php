<?php
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
include "assets/api/inbox_script.php";
require_once "assets/api/get_bg.php";
require_once "assets/api/quiz_name_script.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		<?php echo ($quiz_name); ?>
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
	<!-- Bootstrap CSS (если требуется) -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<!-- Bootstrap Select CSS (если требуется) -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"
		rel="stylesheet">

	<!-- jQuery (необходим для Bootstrap и Bootstrap Select) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<!-- Bootstrap JS (если требуется) -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- Bootstrap Select JS (если требуется) -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>


	<script src="https://code.jquery.com/jquery-3.7.1.js"
		integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

</head>

<body class="profile-page sidebar-collapse"
	style="background-image: url('data:image/jpeg;base64,<?php echo ($bg); ?>'); background-size:cover; background-repeat:no repeat;">
	<div class="page-header" data-parallax="true"></div>
	<div class="main main-raised">
		<div class="container">
			<!-- проверка на админку -->
			<?php if ($isAdmin == true || $isAssistant == true || $isColvir == true) { ?>
				<div class="section text-center">
					<div class="row">
						<div class="col-md-8 ml-auto mr-auto">
							<a href="index.php">
								<h2 class="title">
									<?php echo ($quiz_name); ?>
								</h2>
							</a>
							<h4><strong>Ответы команд</h4>
						</div>
					</div>
					<div class="container">
						<div class="row">
							<?php foreach ($questions as $question): ?>
								<div class="col">
									<button type="button" class="btn btn-primary btn-block show-answers"
										data-question-id="<?php echo $question[0]; ?>">
										Вопрос №
										<?php echo $question[0]; ?>
									</button>
								</div>
							<?php endforeach; ?>
							<div class="col">
								<button type="button" class="btn btn-primary btn-block show-all-answers">
									Результаты
								</button>
							</div>
							<div class="col">
								<button type="button" class="btn btn-primary btn-block tournament">
									Турнирная таблица
								</button>
							</div>
						</div>
						<div class="row">
							<?php foreach ($questions as $question): ?>
								<div class="row mt-4" id="answers-container" style="display: none; width: 100%"
									data-question-id="<?php echo $question[0]; ?>">
									<div class="col">
										<div id="answers-table">
											<?php
											$html = "";
											$html = '<table class="table">';
											$html .= '<thead><tr><th>#</th><th>Команда</th><th>Ответ</th><th>Время</th><th>Ввод баллов</th></tr></thead>';
											$html .= '<tbody>';
											$i = 1;
											$display_question_value = false;
											foreach ($answers as $answer):
												if ($answer[2] != $question[1]) {
													continue;
												}
												if ($display_question_value === false) {
													$html .= '<p>Вопрос ' . $question[2] . ': ' . $answer[2] . ' ('.$answer[5].')</p><p>Правильный ответ: ' . $answer[7] . '</p>';
													$display_question_value = true;
												}
												$html .= '<tr>';
												$html .= '<td>' . $i . '</td>';
												$html .= '<td>' . $answer[1] . '</td>';
												$html .= '<td>' . $answer[3] . '</td>';
												$html .= '<td>' . $answer[4] . '</td>';
												$html .= '<td><input type="text" class="form-control points-input" id="points-input-' . $answer[0] . '" value="' . $answer[6] . '"></td>';
												$html .= '</tr>';
												$i = $i + 1;
											endforeach;

											$html .= '</tbody>';
											$html .= '</table>';

											// Возвращаем HTML таблицы
											echo $html;
											?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
							<div class="row mt-4" id="all-answers-container" style="display: none; width: 100%">
								<div class="col">
									<div class="col-md-2">
										<select class="selectpicker" data-style="btn btn-primary"
											title="Выберите команду" id="team-filter">
											<option value="">Все команды</option>
											<?php foreach ($teams as $team): ?>
												<?php
												if ($team[0] == 555 || $team[0] == 666 || $team[0] == 777) {
													continue;
												}
												?>
												<option value="<?php echo $team[3]; ?>">
													<?php echo $team[3]; ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
									<div id="all-answers-table" style="margin-top: 2%;">
										<?php
										$html = "";
										$html = '<table class="table">';
										$html .= '<thead><tr><th>#</th><th>Команда</th><th>Ответ</th><th>Время</th></tr></thead>';
										$html .= '<tbody>';
										$i = 1;
										$display_question_value = false;
										foreach ($answers as $answer):
											if ($display_question_value === false) {
												$display_question_value = true;
											}
											$html .= '<tr>';
											$html .= '<td>' . $i . '</td>';
											$html .= '<td>' . $answer[1] . '</td>';
											$html .= '<td>' . $answer[3] . '</td>';
											$html .= '<td>' . $answer[4] . '</td>';
											$html .= '</tr>';
											$i = $i + 1;
										endforeach;

										$html .= '</tbody>';
										$html .= '</table>';

										// Возвращаем HTML таблицы
										echo $html;
										?>
									</div>
								</div>
							</div>
							<div class="row mt-4" id="tournament-container" style="display: none; width: 100%">
								<div class="col">
									<div class="col-md-2">
										<select class="selectpicker" data-style="btn btn-primary" id="sort-selector" style="align-self: flex-end">
											<option value="alphabetical">По алфавиту</option>
											<option value="points">По баллам</option>
										</select>
									</div>
									<div id="tournament-table" style="margin-top: 2%;">
										<?php
										$html = "";
										$html = '<table class="table">';
										$html .= '<thead><tr><th>#</th><th>Команда</th><th>Счет</th></tr></thead>';
										$html .= '<tbody>';
										$i = 1;
										$display_question_value = false;
										foreach ($teams as $team):
											if ($team[0] == 555 || $team[0] == 666 || $team[0] == 777) {
												continue;
											}
											if ($display_question_value === false) {
												$display_question_value = true;
											}
											$html .= '<tr>';
											$html .= '<td>' . $i . '</td>';
											$html .= '<td>' . $team[3] . '</td>';
											$html .= '<td>' . $team[4] . '</td>';
											$html .= '</tr>';
											$i = $i + 1;
										endforeach;

										$html .= '</tbody>';
										$html .= '</table>';

										// Возвращаем HTML таблицы
										echo $html;
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="statusMessage"></div>
					<form action="index.php">
						<input type="submit" class="btn btn-primary" value="На главную">
						<input type="button" id="updateBtn" class="btn btn-primary" value="Сохранить">
						<input type="button" id="updateScoresBtn" class="btn btn-primary" value="Обновить турнирную таблицу">
					</form>

				</div>
			<?php } else { ?>
				<div class="section text-center">
					<div class="row">
						<div class="col-md-8 ml-auto mr-auto">
							<h2 class="title">Вы уверены, что авторизовались в системе?</h2>
							<form action="assets/api/logout.php">
								<button type="submit" class="btn btn-primary" class="logout-btn">Выйти</button>
							</form>
						</div>
					</div>
				</div>
			<?php }
			; ?>
		</div>
		<script>
			// Обработчик клика на кнопке вопроса
			$(document).ready(function () {
				$('.show-answers').on('click', function () {
					var questionId = $(this).data('question-id');
					var answersContainer = $('#answers-container[data-question-id="' + questionId + '"]');

					$('[id^=answers-container]').fadeOut();
					$('[id^=all-answers-container]').fadeOut();
					$('[id^=tournament-container]').fadeOut();
					// Проверяем, видим ли блок #answers-container
					if (answersContainer.css('display') != 'none') {
						// Если блок видим, скрываем его
						answersContainer.hide();

					} else {
						// Если блок скрыт, показываем его и загружаем ответы
						$.ajax({
							url: 'inbox.php',
							method: 'POST',
							data: { question_id: questionId },
							success: function (response) {

								answersContainer.fadeIn('slow'); // Показываем блок #answers-container
							},
							error: function (xhr, status, error) {
								console.error(xhr.responseText);
							}
						});
					}
				});
				// Обработчик клика на кнопке всех ответов
				$('.show-all-answers').on('click', function () {
					var questionId = $(this).data('question-id');
					var allAnswersContainer = $('#all-answers-container');

					$('[id^=answers-container]').fadeOut();
					$('[id^=tournament-container]').fadeOut();
					// Проверяем, видим ли блок #answers-container
					if (allAnswersContainer.css('display') != 'none') {
						// Если блок видим, скрываем его
						allAnswersContainer.hide();
					} else {
						// Если блок скрыт, показываем его и загружаем ответы
						$.ajax({
							url: 'inbox.php',
							method: 'POST',
							data: { question_id: questionId },
							success: function (response) {

								allAnswersContainer.fadeIn('slow'); // Показываем блок #all-answers-container
							},
							error: function (xhr, status, error) {
								console.error(xhr.responseText);
							}
						});
					}
				});
				// Обработчик клика на кнопке турнирной балицы
				$('.tournament').on('click', function () {
					var questionId = $(this).data('question-id');
					var tournamentContainer = $('#tournament-container');
					var answersContainer = $('#tournament-container[data-question-id="' + questionId + '"]');
					$('[id^=all-answers-container]').fadeOut();
					$('[id^=answers-container]').fadeOut();
					// Проверяем, видим ли блок #answers-container
					if (tournamentContainer.css('display') != 'none') {
						// Если блок видим, скрываем его
						tournamentContainer.hide();
					} else {
						// Если блок скрыт, показываем его и загружаем ответы
						$.ajax({
							url: 'inbox.php',
							method: 'POST',
							data: { question_id: questionId },
							success: function (response) {

								tournamentContainer.fadeIn('slow'); // Показываем блок #all-answers-container
							},
							error: function (xhr, status, error) {
								console.error(xhr.responseText);
							}
						});
					}
				});

				// Получаем все поля ввода с классом "points-input"
				var inputs = document.querySelectorAll('.points-input');

				inputs.forEach(function (input) {
					// Добавляем обработчик события input
					input.addEventListener('input', function (event) {
						// Получаем введенное значение и удаляем все символы, кроме цифр и знака минус
						var value = event.target.value.replace(/[^0-9-]/g, '');

						// Проверяем, если введенное значение пустое, или равно "-", или является валидным числом типа int
						if (value === '' || value === '-' || (!isNaN(value) && parseInt(value) == value)) {
							// Устанавливаем новое значение поля ввода
							event.target.value = value;
						} else {
							// Если введенное значение не валидно, удаляем последний введенный символ
							event.target.value = event.target.value.slice(0, -1);
						}
					});
				});
				//отправка баллов
				// Обработчик события клика по кнопке "Обновить данные"
				document.getElementById('updateBtn').addEventListener('click', function () {
					// Получаем элемент строки состояния
					var statusMessage = document.getElementById('statusMessage');
					// Создаем объект FormData для сбора данных со всех полей ввода
					var formData = new FormData();

					var hasMinus = false;
					document.querySelectorAll('.points-input').forEach(function (input) {
						if (input.value === '-' || input.value === '') {
							hasMinus = true;
						}
					});

					// Если знак минуса присутствует, выводим сообщение об ошибке и останавливаем выполнение скрипта
					if (hasMinus) {
						statusMessage.innerHTML = 'Проверьте введенные данные на корректность!';
						return false;
					}
					// Получаем все поля ввода с классом "points-input"
					document.querySelectorAll('.points-input').forEach(function (input) {
						var answerId = input.id.split('-')[2];
						formData.append(answerId, input.value);
					});

					// Очищаем содержимое строки состояния
					statusMessage.innerHTML = 'Отправка данных...';

					// Отправляем данные на сервер с помощью AJAX запроса
					fetch('assets/api/update_points_script.php', {
						method: 'POST',
						body: formData
					})
						.then(function (response) {
							// Проверяем статус ответа
							if (response.ok) {
								// Парсим JSON-ответ
								return response.json();
							} else {
								// Выводим сообщение об ошибке
								statusMessage.innerHTML = 'Произошла ошибка при отправке данных';
								throw new Error('Network response was not ok.');
							}
						})
						.then(function (data) {
							// Проверяем успешность выполнения запроса
							if (data.success) {
								// Выводим сообщение об успешной отправке данных
								statusMessage.innerHTML = 'Данные успешно отправлены';
							} else {
								// Выводим сообщение об ошибке
								statusMessage.innerHTML = 'Произошла ошибка: ' + data.error;
							}
						})
						.catch(function (error) {
							// Обрабатываем ошибки, если они возникают
							console.error(error);
						});
				});

				$('#team-filter').change(function () {
					var teamname = $(this).val();
					$.ajax({
						url: 'assets/api/answers_filter_script.php',
						type: 'POST',
						data: { teamname: teamname },
						success: function (response) {
							$('#all-answers-table').html(response);
						}
					});
				});

				$('#sort-selector').change(function() {
					var value = $(this).val();
					$.ajax({
						url: 'assets/api/sort_teams_script.php',
						type: 'GET',
						data: { sort: value },
						success: function(response) {
							$('#tournament-table').html(response);
						},
						error: function(xhr, status, error) {
							console.error('Ошибка: ' + status);
						}
					});
				});
				//обновление пользовательской турнирной таблицы
				$('#updateScoresBtn').click(function() {
					$.ajax({
						url: 'assets/api/update_scores_script.php',
						type: 'POST',
						dataType: 'html',
						success: function(response) {
							// Обработка успешного ответа от сервера
							console.log('Скрипт успешно выполнен:', response);
						},
						error: function(xhr, status, error) {
							// Обработка ошибок при выполнении запроса
							console.error('Ошибка:', status, error);
						}
					});
				});
			});
		</script>
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