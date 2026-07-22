<?php
include dirname(__DIR__) . '/config/init.php';
include dirname(__DIR__) . '/config/database.php';
include dirname(__DIR__) . '/inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $artwork_id = $_POST['artwork_id'] ?? '';
    
    if ($artwork_id === '') redirect($_SERVER['HTTP_REFERER'] ?? '/');

    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    
        $_SESSION['cart'] = [];
    
    }

    if (isset($_SESSION['cart'][$artwork_id]['id'])) {

        $_SESSION['cart'][$artwork_id]['count'] += 1;
    
    } else {

        $_SESSION['cart'][$artwork_id] = [
            'id' => $artwork_id,
            'count' => 1,
        ];

    }

    redirect($_SERVER['HTTP_REFERER'] ?? '/');

}