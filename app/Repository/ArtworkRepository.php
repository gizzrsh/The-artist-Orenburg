<?php

namespace App\Repository;
use PDO;

class ArtworkRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM artworks");
        return $stmt->fetchAll();
    }

    public function findAllPublished(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM artworks WHERE is_published = 1");
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM artworks WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function findAllByCategoryId(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM artworks WHERE category_id = :category_id AND is_published = 1");
        $stmt->execute(['category_id' => $id]);
        return $stmt->fetchAll();
    }

    public function create(array $data, string $imagePath)
    {
        $stmt = $this->pdo->prepare("INSERT INTO artworks 
            (category_id, title, description, image, price, is_published)
            VALUES (:category_id, :title, :description, :image, :price, :is_published)");

        $params = [
            ':category_id'  => $data['category_id']  ?? null,
            ':title'        => $data['title']        ?? null,
            ':description'  => $data['description']  ?? null,
            ':image'        => $imagePath,
            ':price'        => $data['price']        ?? 0,
            ':is_published' => $data['is_published'] ?? 0,
        ];

        $stmt->execute($params);

        return $stmt;
    }
}