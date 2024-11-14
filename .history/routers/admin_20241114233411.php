<?php

use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\DashBoardController;

$router->mount('/admin',function() use ($router){

    // will result in '/admin/'
    $router->get('/', DashBoardController::class . '@index');

    $router->mount('/categories', function() use ($router){
        $router->get('/', CategoryController::class . '@index');
        $router->get('/create', CategoryController::class . '@create');
        $router->get('/store', CategoryController::class . '@store');
        // $router->get('/', CategoryController::class . '@index');
        // $router->get('/', CategoryController::class . '@index');
        // $router->get('/', CategoryController::class . '@index');
        // $router->get('/', CategoryController::class . '@index');
    });

    $router->mount('/products', function() use ($router){
        $router->get('/',function(){

        });
    });
});