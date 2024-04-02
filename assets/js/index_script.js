$(document).ready(function () {
    $('.form').submit(function (e) {
        e.preventDefault();
        // Получаем данные формы
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'assets/api/sendanswer_script.php',
            data: formData,
            success: function (response) {
                // Очищаем поля формы
                $('.form')[0].reset();

                // Выводим сообщение в форме (зеленый цвет)
                $('.status-message').html('<span style="color: green; margin-left: 5%;">Данные успешно отправлены!</span>');
            },
            error: function (xhr, status, error) {
                // Выводим сообщение об ошибке(красный цвет)
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
                alert('Изображение загружено успешно! Перезагрузите страницу, чтобы увидеть результат!');
            } else {
                alert('Произошла ошибка при загрузке изображения!');
            }
        };
        xhr.send(formData);
    });
    // обновление названия квиза
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
    // обновление максимального счета
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
    // Обработка добавления вопроса
    $('#addQuestionForm').submit(function (event) {
        event.preventDefault();
        var newQuestionTxt = $('#newQuestionTxt').val();
        var newQuestionType = $('#newQuestionType').val();
        var newQuestionScore = $('#newQuestionScore').val();
        var newQuestionAnsw = $('#newQuestionAnsw').val();
        $.ajax({
            type: 'POST',
            url: 'assets/api/add_question_script.php',
            data: {
                newQuestionTxt: newQuestionTxt,
                newQuestionType: newQuestionType,
                newQuestionScore: newQuestionScore,
                newQuestionAnsw: newQuestionAnsw,
            },
            success: function (response) {
                $('#message').html(response);
                $('#existingQuestions').load('assets/api/get_questions_script.php'); // Обновляем список вопросов
                $('#addQuestionForm')[0].reset();
            }
        });
    });

    // Обработка удаления вопроса
    $('#existingQuestions').on('click', '.deleteQuestionBtn', function () {
        var questionId = $(this).data('question-id');

        // Отображаем confirm
        var confirmation = confirm('Вы уверены, что хотите удалить этот вопрос?');
        if (confirmation) {
            $.ajax({
                type: 'POST',
                url: 'assets/api/delete_question_script.php',
                data: { questionId: questionId },
                success: function (response) {
                    $('#message').html(response);
                    $('#existingQuestions').load('assets/api/get_questions_script.php'); // Обновляем список вопросов
                }
            });
        }
    });
    //открытие страницы с вопросом
    $(document).on('click', '.openQuestionBtn', function () {
        var questionId = $(this).data('question-id');
        openQuestion(questionId);
    });

    function openQuestion(questionId) {
        // Формируем URL с параметрами
        var url = 'question.php?id=' + questionId;
        // Открываем новую страницу
        window.open(url, '_blank');

    }
    // Обработчик событий для каждой карточки вопроса
    document.querySelectorAll('.question-card').forEach(card => {
        card.addEventListener('click', function () {
            // Получаем ID вопроса
            const questionId = this.id.replace('questionCard', '');
            // Вставляем ваш код для открытия аккордеона и инициализации редактора Summernote здесь
            console.log('Кликнута карточка с вопросом №' + questionId);

            // Находим элемент аккордеона внутри карточки
            const accordionElement = this.querySelector('.accordion');
            // Получаем текст вопроса из скрытого элемента внутри карточки с сохранением тегов и стилей
            const questionText = this.querySelector('.question-text').innerHTML;
            // Инициализируем редактор Summernote с текстом вопроса
            const editorId = 'summernoteEditor' + questionId;
            const $editor = $('#' + editorId);
            $editor.summernote({
                placeholder: 'Введите текст вопроса',
                tabsize: 2,
                height: 400
            });
            // Вставляем текст вопроса в редактор Summernote
            $editor.summernote('code', questionText);

            // Добавляем обработчик событий клика к элементу аккордеона
            accordionElement.addEventListener('click', function (event) {
                // Предотвращаем стандартное поведение аккордеона (например, открытие/закрытие по клику)
                event.stopPropagation();
            });

            // Переключаем состояние аккордеона
            if (accordionElement.style.display === 'block') {
                accordionElement.style.display = 'none';
            } else {
                accordionElement.style.display = 'block';
            }
        });
    });

    // Обработчик событий для кнопки "Обновить"
    $('.updateQuestionBtn').on('click', function () {
        // Получаем ID вопроса
        const questionId = $(this).data('question-id');
        // Получаем текст вопроса из редактора Summernote
        const editorId = 'summernoteEditor' + questionId;
        const questionText = $('#' + editorId).summernote('code');

        // Отправляем асинхронный запрос на сервер для обновления данных вопроса в БД
        $.ajax({
            url: 'assets/api/update_question_script.php',
            method: 'POST',
            data: {
                questionId: questionId,
                questionText: questionText
            },
            success: function (response) {
                // В случае успеха выводим сообщение пользователю или выполняем другие действия
                console.log('Данные вопроса успешно обновлены в БД');
            },
            error: function (xhr, status, error) {
                // В случае ошибки выводим сообщение об ошибке или выполняем другие действия
                console.error('Произошла ошибка при обновлении данных вопроса: ' + error);
            }
        });
    });


});