<?php

include dirname(__DIR__, 2) . '/config/init.php';
include dirname(__DIR__, 2) . '/inc/functions.php';
include dirname(__DIR__, 2) . '/config/csrf_token.php';

if (!is_admin() || !is_logged()) {
    redirect('/');
}

$errors = [];
$allowed_mime = [];

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    CsrfTokenCheck();

    $upload_dir = '';
    switch ($_POST['category_id']) {
        case '1':
            $upload_dir = 'uploads/paiting/';
            break;
        case '2':
            $upload_dir = 'uploads/relief/';
            break;
        case '3':
            $upload_dir = 'uploads/mirrors/';
            break;
        case '4':
            $upload_dir = 'uploads/interior/';
            break;
        
        default:
            $errors['category'] = 'Категория не выбрана';
            break;
    }

    $artwork = [
        'category_id'   => $_POST['category_id'],
        'title'         => $_POST['title'],
        'description'   => $_POST['description'],
        'image'         => $_FILES['image'],
        'price'         => $_POST['price'],
        'is_published'  => $_POST['is_published'] ?? 0,
    ];

    $errors['title']        = (validateField($artwork['title'], 3, 60)) 
        ? '' : 'Название должно содержать от 3 до 60 символов';
    $errors['category_id']  = ($artwork['category_id'] >= 0) 
        ? '' : 'Не выбрана категория';
    $errors['description']  = (validateField($artwork['description'], 0, 255)) 
        ? '' : 'Описание должно содержать от 0 до 255 символов';
    $errors['image']        = validateUploadImage($_FILES);


    $validation = array_filter($errors);

    if (!empty($validation)) {
        $_SESSION['errors'] = $errors;
        redirect($_SERVER['HTTP_REFERER']);
    } else {

        $real_mime_type = mime_content_type($artwork['image']['tmp_name']);
        
        $allowed_types = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/gif'  => 'gif',
            'image/webp' => 'webp'
        ];
        $extension = $allowed_types[$real_mime_type];

        $unique_name = 'img_' . uniqid() . '.' . $extension; 
        $image_path = $upload_dir . $unique_name;
        $full_path = dirname(__DIR__, 2) . '/' . $image_path;

        if (move_uploaded_file($artwork['image']['tmp_name'], $full_path)) {
            error_log("Файл успешно загружен: " . $full_path);
        } else {
            $_SESSION['errors'] = "Возможная атака через загрузку файла!\n";
            redirect($_SERVER['PHP_SELF']);
        }

        $artworkRepo->create($artwork, $image_path);


        redirect('../');
    }

}