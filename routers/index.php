<?php
use \Bramus\Router\Router;

$router = new Router();

require_once __DIR__. '/client.php';
require_once __DIR__. '/admin.php';

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    // ... do something special here
});

$router->run();