<?php

$pdo = new PDO(
    'mysql:host=gizzatrg.beget.tech;dbname=gizzatrg_artsite;charset=utf8mb4',
    'localhost',
    'Dad102rus'
);

$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);
$pdo->setAttribute(
    PDO::ATTR_DEFAULT_FETCH_MODE,
    PDO::FETCH_ASSOC
);