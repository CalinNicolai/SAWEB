<?php

namespace Calinn\Saweb\Repository;

use Exception;
use mysqli;
use PDO;
use PDOException;

class UserRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Создание пользователя
    public function create(string $login, string $password): bool
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO users (login, password) VALUES (:login, :password)");
            $stmt->bindParam(':login', $login);
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $hashedPassword = $password;
            $stmt->bindParam(':password', $hashedPassword);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Логирование ошибки или вывод сообщения
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Поиск пользователя по ID
    public function find(int $id): ?array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Логирование ошибки или вывод сообщения
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Получение всех пользователей
    public function all(): array
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM users");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Логирование ошибки или вывод сообщения
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

// Метод для поиска пользователя по логину (без SQL Injection)
    public function findByLogin(string $login): ?array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE login = :login");
            $stmt->bindParam(':login', $login);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result === false ? null : $result;
        } catch (PDOException $e) {
            // Логирование ошибки или вывод сообщения
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function login(string $login, string $password)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE login = :login AND password = :password");
            $stmt->bindParam(':login', $login, PDO::PARAM_STR_CHAR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR_CHAR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result === false ? null : $result;
        } catch (Exception) {
            echo 'Incorrect login or password';
        }
    }

    // Удаление пользователя по ID
    public function delete(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Логирование ошибки или вывод сообщения
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Обновление пользователя по ID
    public function update(int $id, string $fullname, string $email, string $password): bool
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE users SET fullname = :fullname, email = :email, password = :password WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':email', $email);
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $hashedPassword);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Логирование ошибки или вывод сообщения
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
