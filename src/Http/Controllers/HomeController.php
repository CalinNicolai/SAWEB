<?php

namespace Calinn\Saweb\Http\Controllers;

use Calinn\Saweb\Repository\GuestRepository;
use Calinn\Saweb\Repository\UserRepository;
use PDO;

class HomeController
{
    private UserRepository $userRepository;
    private GuestRepository $guestRepository;

    public function __construct()
    {
        $pdo = new PDO('mysql:host=db;dbname=my_database', 'user', 'user_password');
        $this->userRepository = new UserRepository($pdo);
        $this->guestRepository = new GuestRepository($pdo);
    }

    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /auth');
            exit;
        }
        include __DIR__ . '/../../Resources/Views/Home.php';
    }

    public function guest()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /auth');
            exit;
        }

        $guests = $this->guestRepository->all();

        include __DIR__ . '/../../Resources/Views/Guest.php';
    }

    public function accounts()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /auth');
            exit;
        }

        $users = $this->userRepository->all();

        include __DIR__ . '/../../Resources/Views/Accounts.php';
    }

    public function guestHandle()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /auth');
            exit;
        }


        $userID = $_POST['user'];
        $text = $_POST['text_message'];
        $email = $_POST['e_mail'];

        $result = $this->guestRepository->create($userID, $text, $email);

        if (!$result) {
            echo 'Error!';
            exit;
        }

        header('Location: /');
        exit;
    }

    private function validateInput($input)
    {
        $invalidCharsPattern = '/[!@#$%^&*(),.?":{}|<>]/';

        if (preg_match($invalidCharsPattern, $input)) {
            return false;
        }

        return true;
    }
}
