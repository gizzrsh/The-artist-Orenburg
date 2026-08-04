<?php

function dd(mixed $value) {
    echo "<pre>";
        var_dump($value);
    echo "</pre>";
    
    exit;
}

function redirect(string $url) {
    header("Location: $url");
    exit;
}

function validateField(string $value, int $min = 3, int $max = 21): bool {
    $strLength = mb_strlen($value); 
    return $min <= $strLength && $strLength <= $max;
}

function validateEmail(string $value): bool {
    $email = filter_var($value, FILTER_VALIDATE_EMAIL);
    if ($email === false) {
        return false;
    }

    $parts = explode("@", $email);
    $domain = $parts[1];
    if (checkdnsrr($domain, 'MX') || checkdnsrr($domain, 'A')) {
        return true;
    }
    return false;
}

function validatePassword(string $value): bool {
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_\-+=\[\]{};:\'",.<>\/?~`|\\\]).+$/';
    return mb_strlen($value) >= 8 && preg_match($pattern, $value) === 1;
}

function validateUploadImage(array $value): true|string {

    if (!isset($value['image'])) {
        return 'Файл не был отправлен на сервер.';
    }

    $file = $value['image'];
    $errors = '';

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return codeToMessage($file['error']);
    }

    if ($file['size'] > 3000000) {
        $errors = "Извините, файл слишком большой.";
    }

    $allowedTypes = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/gif'  => 'gif',
        'image/webp' => 'webp'
    ];

    $realMimeType = mime_content_type($file['tmp_name']);

    if (!array_key_exists($realMimeType, $allowedTypes)) {
        $errors = "Извините, разрешены только файлы JPG, JPEG, PNG, GIF и WEBP.";
    }

    if (!empty($errors)) {
        return $errors;
    }

    return '';
}

function codeToMessage(int $code) {
    switch ($code) {
        case UPLOAD_ERR_INI_SIZE:
            $message = "Загруженный файл превышает директиву upload_max_filesize в php.ini";
            break;
        case UPLOAD_ERR_FORM_SIZE:
            $message = "Загруженный файл превышает директиву MAX_FILE_SIZE, указанную в HTML-форме";
            break;
        case UPLOAD_ERR_PARTIAL:
            $message = "Загруженный файл был получен только частично";
            break;
        case UPLOAD_ERR_NO_FILE:
            $message = "Файл не был загружен";
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $message = "Отсутствует временная папка";
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $message = "Не удалось записать файл на диск";
            break;
        case UPLOAD_ERR_EXTENSION:
            $message = "Загрузка файла остановлена расширением PHP";
            break;

        default:
            $message = "Неизвестная ошибка загрузки";
            break;
    }
    return $message;
}

function CsrfTokenCheck() {
    $submittedToken = $_POST['csrf_token'];
    $sessionToken = $_SESSION['csrf_token'];

    if (!isset($submittedToken, $sessionToken) || !hash_equals($submittedToken, $sessionToken)) {
        http_response_code(403);
        exit;
    }
}

function is_logged(): bool {
    return (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true); 
}

function is_admin(): bool {
    // return (isset($_SESSION['role_id']) && (int)$_SESSION['role_id'] === 1);
    $stmt = Database::getConnection()->prepare('SELECT slug FROM roles WHERE id = :id');
    $stmt->execute(['id' => $_SESSION['role_id']]);
    $role = $stmt->fetch();
    if (!$role || $role['slug'] !== 'admin') {
        return false;
    }

    return true;
}