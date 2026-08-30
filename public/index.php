<?php

declare(strict_types=1);

use App\Support\Http\Router;

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/config/init.php';

// $router = new Router();

(require dirname(__DIR__) . '/routes/web.php')($router);
(require dirname(__DIR__) . '/routes/admin.php')($router);

$router->dispatch();