<?php

$pdo = new PDO(
    'mysql:host=localhost;dbname=artist_site;charset=utf8mb4',
    'root',
    'dad102rus'
);

$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);