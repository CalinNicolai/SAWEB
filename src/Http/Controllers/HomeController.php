<?php

namespace Calinn\Saweb\Http\Controllers;

use Calinn\Saweb\Repository\UserRepository;
use PDO;

class HomeController
{
    private $userRepository;

    public function __construct()
    {
        $pdo = new PDO('mysql:host=db;dbname=my_database', 'user', 'user_password');
        $this->userRepository = new UserRepository($pdo);
    }

    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /auth');
            exit;
        }

        // Получение всех пользователей
        $users = $this->userRepository->all(); // Создайте метод findAll() в UserRepository для получения всех пользователей

        // Подключение представления
        include __DIR__ . '/../../Resources/Views/Home.php';
    }
}
