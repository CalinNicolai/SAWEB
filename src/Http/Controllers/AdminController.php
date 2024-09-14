<?php

namespace Calinn\Saweb\Http\Controllers;

use Calinn\Saweb\Repository\GuestRepository;
use Calinn\Saweb\Repository\UserRepository;
use PDO;

class AdminController
{

    private UserRepository $userRepository;
    private GuestRepository $guestRepository;

    function __construct()
    {
        $pdo = new PDO('mysql:host=db;dbname=my_database', 'user', 'user_password');
        $this->userRepository = new UserRepository($pdo);
        $this->guestRepository = new GuestRepository($pdo);
    }

    function index()
    {
        $users = $this->userRepository->all();

        $comments = $this->guestRepository->all();

            include __DIR__ . '/../../Resources/Views/Admin.php';
    }

    public function deleteAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $this->userRepository->delete($userId);
            header('Location: /admin');
        }
    }

    public function deleteComment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $commentId = $_POST['comment_id'];
            $this->guestRepository->delete($commentId);
            header('Location: /admin');
        }
    }
}