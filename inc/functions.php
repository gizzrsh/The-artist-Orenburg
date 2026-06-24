<?php
declare(strict_types=1);

function validateField(string $value, int $min = 3, int $max = 21): bool 
{
    $strLength = mb_strlen($value); 
    return $min <= $strLength && $strLength <= $max;
}

function validateEmail(string $value): bool
{
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

function redirect(string $url) {
    header("Location: $url");
    exit;
}