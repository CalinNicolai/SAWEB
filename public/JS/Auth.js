document.addEventListener('DOMContentLoaded', function () {
    var form = document.forms['form'];

    form.addEventListener('submit', function (e) {
        var nameErr = document.getElementById('name-err');
        var passwordErr = document.getElementById('password-err');
        nameErr.innerHTML = '';
        passwordErr.innerHTML = '';

        var name = document.getElementById('name').value;
        var password = document.getElementById('password').value;

        var invalidChars = /['!@#$%^&*(),.?":{}|<>]/g;

        var hasError = false;

        if (name === '') {
            nameErr.innerHTML = 'Поле не может быть пустым';
            hasError = true;
        } else if (invalidChars.test(name)) {
            nameErr.innerHTML = 'Недопустимые символы';
            hasError = true;
        }

        if (password === '') {
            passwordErr.innerHTML = 'Поле не может быть пустым';
            hasError = true;
        } else if (invalidChars.test(password)) {
            passwordErr.innerHTML = 'Недопустимые символы';
            hasError = true;
        }

        if (hasError) {
            e.preventDefault();
        }
    });
});
