<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div id="registration-success" style="display:none;color:green;"></div>

<div id="registration-block">
    <h1>Регистрация</h1>
    <div id="registration-error" style="display:none;color:red;"></div>
    <form id="registration-form" action="registration.php">
        <label for="name">Имя:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="surname">Фамилия:</label><br>
        <input type="text" id="surname" name="surname"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">Пароль:</label><br>
        <input type="password" id="password" name="password"><br>
        <label for="confirm-password">Повторите пароль:</label><br>
        <input type="password" id="confirm-password" name="confirm_password"><br>
        <button type="submit">Зарегистрироваться</button>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#registration-form').submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var formData =form.serialize();
            $('#registration-error').hide();

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: formData,
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        $('#registration-block').hide();
                        $('#registration-success').text(data.message).show();
                    } else {
                        $('#registration-error').text(data.errors).show();
                    }
                },
                error: function () {
                    $('#registration-error').text('Произошла ошибка при отправке данных').show();
                }
            });
        });
    });
</script>
</body>
</html>