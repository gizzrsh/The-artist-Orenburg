<?php
require $_SERVER['DOCUMENT_ROOT'] . '/inc/functions.php';

session_start();

$_SESSION = [];

session_destroy();

redirect('/auth');
?>