$(document).ready(function() {
    $('#form').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'controllers/calculate.php',
            data: formData,
            success: function(response) {
                $('#result').html('Итоговая стоимость: ' + response);
            },
            error: function(error) {
                console.error('Ошибка:', error);
                $('#result').html('Произошла ошибка при отправке формы.');
            }
        });
    });
});