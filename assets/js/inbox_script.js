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

    $('#sort-selector').change(function () {
        var value = $(this).val();
        $.ajax({
            url: 'assets/api/sort_teams_script.php',
            type: 'GET',
            data: { sort: value },
            success: function (response) {
                $('#tournament-table').html(response);
            },
            error: function (xhr, status, error) {
                console.error('Ошибка: ' + status);
            }
        });
    });
    //обновление пользовательской турнирной таблицы
    $('#updateScoresBtn').click(function () {
        $.ajax({
            url: 'assets/api/update_scores_script.php',
            type: 'POST',
            dataType: 'html',
            success: function (response) {
                // Обработка успешного ответа от сервера
                console.log('Скрипт успешно выполнен:', response);
            },
            error: function (xhr, status, error) {
                // Обработка ошибок при выполнении запроса
                console.error('Ошибка:', status, error);
            }
        });
    });
});