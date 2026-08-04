<?php

namespace App\Repository;
use PDO;

class UserRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function findByEmail(string $email): array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function findAllActive(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM users WHERE is_active = 1");
        return $stmt->fetchAll();
    }

    public function updateTokenByEmail(string $email, string $token, string $token_expired)
    {
        $stmt = $this->pdo->prepare("UPDATE users 
                                    SET token = :token, token_expired = :token_expired
                                    WHERE email = :email");
        $stmt->execute(['email' => $email, 'token' => $token, 'token_expired' => $token_expired]);
        return $stmt;
    }

    public function emailConfirmedByToken(string $token)
    {
        $stmt = $this->pdo->prepare("UPDATE users 
                    SET token = NULL, token_expired = NULL, email_verified = 1 
                    WHERE token = :token AND token_expired > NOW()");
        $stmt->execute(['token' => $token]);
        
        return $stmt;
    }

    public function updatePasswordByToken(string $token, string $password) 
    {
        $stmt = $this->pdo->prepare("UPDATE users
                                    SET password = :password, token = NULL, token_expired = NULL
                                    WHERE token = :token AND token_expired > NOW()");
        $stmt->execute(['token' => $token, 'password' => password_hash($password, PASSWORD_DEFAULT)]);
        
        return $stmt;
    }

    public function createUser(array $userData)
    {
        
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, role_id) 
                                    VALUES (:name, :email, :password, :role_id)");
        $stmt->execute($userData);
        
        return $stmt;
        
    }

}