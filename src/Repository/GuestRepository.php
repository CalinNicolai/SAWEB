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

    public function delete($commentId)
    {
        $stmt = $this->pdo->prepare('DELETE FROM guest WHERE id = :id');
        $stmt->bindParam(':id', $commentId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteByUserId($userId){
        $stmt = $this->pdo->prepare('DELETE FROM guest WHERE user = :user');
        $stmt->bindParam(':user', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}