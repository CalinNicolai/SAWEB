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

    public function signIn()
    {
        $login = $_POST['name'];
        $password = $_POST['password'];

        $invalidCharsPattern = '/[!@#$%^&*(),.?":{}|<>]/';

        if (empty($login) || empty($password)) {
            include __DIR__ . '/../../Resources/Views/IncorrectAuth.php';
            exit();
        }

        if (preg_match($invalidCharsPattern, $login)) {
            include __DIR__ . '/../../Resources/Views/IncorrectAuth.php';
            exit();
        }

        if (preg_match($invalidCharsPattern, $password)) {
            include __DIR__ . '/../../Resources/Views/IncorrectAuth.php';
            exit();
        }

        $user = $this->userRepository->login($login, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];

            header('Location: /');
            exit();
        } else {
            include __DIR__ . '/../../Resources/Views/IncorrectAuth.php';
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        header('Location: /auth');
        exit();
    }
}