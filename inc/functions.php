<?php
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);

function incFile(string $urlFile) {
    require ROOT_PATH . $urlFile;
}
?>