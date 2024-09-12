document.addEventListener('DOMContentLoaded', function() {
    var form = document.forms['form'];

    form.addEventListener('submit', function(e) {
        // Сбрасываем ошибки
        var nameErr = document.getElementById('name-err');
        var passwordErr = document.getElementById('password-err');
        nameErr.innerHTML = '';
        passwordErr.innerHTML = '';

        // Получаем значения полей
        var name = document.getElementById('name').value;
        var password = document.getElementById('password').value;

        // Регулярное выражение для проверки наличия специальных символов
        var invalidChars = /[!@#$%^&*(),.?":{}|<>]/g;

        // Флаг для отмены отправки формы
        var hasError = false;

        // Проверка поля "name"
        if (name === '') {
            nameErr.innerHTML = 'Поле не может быть пустым';
            hasError = true;
        } else if (invalidChars.test(name)) {
            nameErr.innerHTML = 'Недопустимые символы';
            hasError = true;
        }

        // Проверка поля "password"
        if (password === '') {
            passwordErr.innerHTML = 'Поле не может быть пустым';
            hasError = true;
        } else if (invalidChars.test(password)) {
            passwordErr.innerHTML = 'Недопустимые символы';
            hasError = true;
        }

        // Если есть ошибки, отменяем отправку формы
        if (hasError) {
            e.preventDefault();
        }
    });
});
