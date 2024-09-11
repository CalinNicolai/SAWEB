<?php

namespace Calinn\Saweb\Http\Controllers;

use Calinn\Saweb\Repository\UserRepository;
use PDO;

class AuthController
{

    private $userRepository;

    function __construct()
    {
        $pdo = new PDO('mysql:host=db;dbname=my_database', 'user', 'user_password');
        $this->userRepository = new UserRepository($pdo);
    }

    function index()
    {
        include __DIR__ . '/../../Resources/Views/Auth.php';
    }

    function register()
    {
        include __DIR__ . '/../../Resources/Views/Register.php';
    }

    function signUp()
    {
        $this->userRepository->create($_POST['name'], $_POST['password']);
        include __DIR__ . '/../../Resources/Views/Auth.php';
    }

// Пример метода в AuthController
    public function signIn()
    {
        // Предполагаем, что данные из формы передаются таким образом
        $login = $_POST['name'];
        $password = $_POST['password'];

        $user = $this->userRepository->login($login, $password);

        if ($user) {
            // Успешная аутентификация
            $_SESSION['user_id'] = $user['id'];

            header('Location: /');
            exit();
        } else {
            // Неверные учетные данные
            echo "Invalid login or password.";
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        // Перенаправление на страницу авторизации
        header('Location: /auth');
        exit();
    }
}