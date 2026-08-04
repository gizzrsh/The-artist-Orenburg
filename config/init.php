<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/database.php';

use App\Repository\UserRepository;
use App\Repository\ArtworkRepository;

ini_set('error_log', dirname(__DIR__) . '/logs/uploads.log');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

if ($_ENV['APP_DEBUG'] === 'DEV') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', dirname(__DIR__) . '/logs/php_errors.log');
    error_reporting(E_ALL & ~E_DEPRECATED);
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pdo = Database::getConnection();

$userRepo = new UserRepository($pdo);
$artworkRepo = new ArtworkRepository($pdo);