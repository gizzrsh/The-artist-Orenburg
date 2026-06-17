<?php
require_once __DIR__ . '/init.php';

$dsn = "mysql:host=" . $_ENV['DB_HOST'] . ';' . "dbname=" . $_ENV['DB_NAME'] . ';' . "charset=utf8mb4";
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];

$pdo = new PDO($dsn, $user, $pass);
$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);
$pdo->setAttribute(
    PDO::ATTR_DEFAULT_FETCH_MODE,
    PDO::FETCH_ASSOC
);