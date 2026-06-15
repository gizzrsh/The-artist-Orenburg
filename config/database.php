<?php

$pdo = new PDO(
    'mysql:host=gizzatrg.beget.tech;dbname=gizzatrg_artsite;charset=utf8mb4',
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