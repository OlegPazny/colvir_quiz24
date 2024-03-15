//обработка введенных результатов
$(document).ready(function () {
    $('.score-input').on('input', function () {
        //записываем данные
        var teamId = $(this).data('team-id');
        var score = $(this).val();

        // Проверка на float или int
        if (!/^(-?\d+(\.\d+)?|)$/.test(score)) {
            return;
        }
        $.ajax({
            type: 'POST',
            url: 'assets/api/addscore_script.php',
            data: {
                team_id: teamId,
                score: score
            },
            success: function (response) {
                console.log(response);
                //если все хорошо
                $('.status-message').html('<span style="color: green; margin-left: 5%;">Данные команды ' + teamId + ' успешно отправлены!</span>');
            },
            error: function (xhr, status, error) {
                console.error(error);
                //если ошибка
                $('.status-message').html('<span style="color: red; margin-left: 5%;">Данные команды ' + teamId + ' НЕ отправлены!</span>');
            }
        });
    });
});