<?php
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
function incFile(string $urlFile) {
    include ROOT_PATH . $urlFile;
}
?>