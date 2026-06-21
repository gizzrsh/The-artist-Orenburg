<?php

function validateField(string $value, int $min = 3, int $max = 21): bool 
{
    $strLength = mb_strlen($value); 
    return $min <= $strLength && $strLength <= $max;
}

function validateEmail(string $value): bool
{
    $email = filter_var($value, FILTER_SANITIZE_EMAIL);
    list ($user, $domain) = explode("@", $email);
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && checkdnsrr($domain, 'MX')) {
        return true;
    } else {
        return false;
    }
}

function validatePassword(string $value): bool {
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_\-+=\[\]{};:\'",.<>\/?~`|\\\])$/';
    return mb_strlen($value) >= 8 && preg_match($pattern, $value);
}