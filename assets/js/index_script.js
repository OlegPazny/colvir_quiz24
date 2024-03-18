$(document).ready(function () {
    // Обработчик события отправки формы
    $('.form').submit(function (e) {
        e.preventDefault(); // Предотвращаем стандартное поведение формы
        // Получаем данные формы
        var formData = $(this).serialize();
        // Отправляем AJAX запрос
        $.ajax({
            type: 'POST',
            url: 'assets/api/sendanswer_script.php', // Укажите путь к вашему обработчику на сервере
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
        xhr.open('POST', 'assets/api/background_img_script.php', true);
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
    $('#editForm').submit(function (e) {
        e.preventDefault();
        var quizName = $('#quizName').val();
        $.ajax({
            type: 'POST',
            url: 'assets/api/update_quiz_name_script.php',
            data: { quizName: quizName },
            success: function (response) {
                $('#message').html(response);
            }
        });
    });
    // Обработка отправки формы через AJAX
    $('#editScoreForm').submit(function (e) {
        e.preventDefault();
        var quizScore = $('#quizMaxScore').val();
        $.ajax({
            type: 'POST',
            url: 'assets/api/update_quiz_score_script.php',
            data: { quizScore: quizScore },
            success: function (response) {
                $('#message').html(response);
            }
        });
    });
    // Обработка добавления вопроса через AJAX
    $('#addQuestionForm').submit(function (event) {
        event.preventDefault();
        var newQuestion = $('#newQuestion').val();
        var newQuestionType = $('#newQuestionType').val();
        var newQuestionScore = $('#newQuestionScore').val();
        var newQuestionAnsw = $('#newQuestionAnsw').val();
        $.ajax({
            type: 'POST',
            url: 'assets/api/add_question_script.php',
            data: {
                newQuestion: newQuestion,
                newQuestionType: newQuestionType,
                newQuestionScore: newQuestionScore,
                newQuestionAnsw: newQuestionAnsw,
            },
            success: function (response) {
                $('#message').html(response);
                $('#existingQuestions').load('assets/api/get_questions_script.php'); // Обновляем список вопросов
            }
        });
    });

    // Обработка удаления вопроса через делегирование событий
    $('#existingQuestions').on('click', '.deleteQuestionBtn', function () {
        var questionId = $(this).data('question-id');
        $.ajax({
            type: 'POST',
            url: 'assets/api/delete_question_script.php',
            data: { questionId: questionId },
            success: function (response) {
                $('#message').html(response);
                $('#existingQuestions').load('assets/api/get_questions_script.php'); // Обновляем список вопросов
            }
        });
    });
});