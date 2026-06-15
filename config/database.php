<?php

if ($_SERVER['HTTP_HOST'] === 'gizzatrg.beget.tech') {
    // Beget Хостинг
    $pdo = new PDO(
        'mysql:host=localhost;dbname=gizzatrg_artsite;charset=utf8mb4',
        'gizzatrg_artsite',
        'Dad102russs'
    );
    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    $pdo->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );
} elseif ($_SERVER['HTTP_HOST'] === 'localhost:8080') {
    // Localhost
    $pdo = new PDO(
        'mysql:host=localhost;dbname=artist_site;charset=utf8mb4',
        'root',
        'dad102rus'
    );
    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    $pdo->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );
}