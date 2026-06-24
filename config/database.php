<?php
require_once __DIR__ . '/init.php';
class Database
{
    private string $dsn;
    private string $username; 
    private string $password;
    public  array  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    private ?PDO $pdo = null;
    public function __construct()
    {
        $this->dsn = "mysql:host=" . $_ENV['DB_HOST'] . ';' . "dbname=" . $_ENV['DB_NAME'] . ';' . "charset=utf8mb4";
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];

        try {
            $this->pdo = new PDO($this->dsn, $this->username, $this->password, $this->options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }

    public function query(string $sql)
    {
        $statement = $this->pdo->query($sql);
        return $statement;
    }
    public function prepare(string $sql, array $params = [])
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        return $statement;
    }
}