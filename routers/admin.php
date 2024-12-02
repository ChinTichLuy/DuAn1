<?php

use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\DashBoardController;
use App\Controllers\Admin\ProductController;

$router->mount('/admin',function() use ($router){

    // will result in '/admin/'
    $router->get('/', DashBoardController::class . '@index');

    $router->mount('/categories', function() use ($router){
        $router->get('/', CategoryController::class . '@index');
        $router->get('/create', CategoryController::class . '@create');
        $router->post('/store', CategoryController::class . '@store');
        $router->get('/{id}/edit', CategoryController::class . '@edit');
        $router->post('/{id}/update', CategoryController::class . '@update');
        $router->post('/{id}/delete', CategoryController::class . '@delete');
        $router->get('/{id}', CategoryController::class . '@show');
    });


    $router->mount('/products', function() use ($router){
        $router->get('/', ProductController::class . '@index');
        $router->get('/create', ProductController::class . '@create');
        $router->post('/store', ProductController::class . '@store');
        $router->get('/{id}/edit', ProductController::class . '@edit');
        $router->post('/{id}/update', ProductController::class . '@update');
        $router->post('/{id}/delete', ProductController::class . '@delete');
        $router->get('/{id}', ProductController::class . '@show');
    });

    // $router->mount('/products', function() use ($router){
    //     $router->get('/',function(){

    //     });
    // });
});