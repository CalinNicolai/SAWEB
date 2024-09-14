<?php

namespace Calinn\Saweb\Repository;

use PDO;
use PDOException;

class GuestRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(string $userID, string $message, string $email): bool
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO guest (user, text_message, e_mail, data_time_message) VALUES (:user_id, :message, :email, NOW())");
            $stmt->bindParam(':user_id', $userID);
            $stmt->bindParam(':message', $message);
            $stmt->bindParam(':email', $email);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function all(): array
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM guest");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
}