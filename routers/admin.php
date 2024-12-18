<?php

use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\CommentController;
use App\Controllers\Admin\DashBoardController;
use App\Controllers\Admin\ProductColorController;
use App\Controllers\Admin\ProductController;
use App\Controllers\Admin\OrderController;
use App\Controllers\Admin\ProductTagController;
use App\Controllers\Admin\UserController;

$router->before('GET|POST', '/admin/*.*', function(){
    middleware_auth();
});

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

    $router->mount('/comments', function() use ($router){
        $router->get('/', CommentController::class . '@index');
        $router->get('/create', CommentController::class . '@create');
        $router->post('/store', CommentController::class . '@store');
        $router->get('/{id}/edit', CommentController::class . '@edit');
        $router->post('/{id}/update', CommentController::class . '@update');
        $router->post('/{id}/delete', CommentController::class . '@delete');
        $router->get('/{id}', CommentController::class . '@show');
    });

    $router->mount('/users', function() use ($router){
        $router->get('/', UserController::class . '@index');
        $router->get('/create', UserController::class . '@create');
        $router->post('/store', UserController::class . '@store');
        $router->get('/{id}/edit', UserController::class . '@edit');
        $router->post('/{id}/update', UserController::class . '@update');
        $router->post('/{id}/delete', UserController::class . '@delete');
        $router->get('/{id}', UserController::class . '@show');
    });

    $router->mount('/product-colors', function () use ($router) {
        $router->get('/', ProductColorController::class . '@index');
        $router->get('/create', ProductColorController::class . '@create');
        $router->post('/store', ProductColorController::class . '@store');
        // $router->get('/{id}/edit', ProductTagController::class . '@edit');
        // $router->post('/{id}/update', ProductTagController::class . '@update');
        // $router->post('/{id}/delete', ProductTagController::class . '@delete');
        // $router->get('/{id}', ProductTagController::class . '@show');
    });

    $router->mount('/product-tags', function () use ($router) {
        $router->get('/', ProductTagController::class . '@index');
        $router->get('/create', ProductTagController::class . '@create');
        $router->post('/store', ProductTagController::class . '@store');
        // $router->get('/{id}/edit', ProductTagController::class . '@edit');
        // $router->post('/{id}/update', ProductTagController::class . '@update');
        // $router->post('/{id}/delete', ProductTagController::class . '@delete');
        // $router->get('/{id}', ProductTagController::class . '@show');
    });
    $router->mount('/orders', function () use ($router) {
        $router->get('/', OrderController::class . '@index');
        $router->post('{id}/handleEdit', OrderController::class . '@handleEdit');
        // $router->get('/create', CommentController::class . '@create');
        // $router->post('/store', CommentController::class . '@store');
        // $router->get('/{id}/edit', CommentController::class . '@edit');
        // $router->post('/{id}/update', CommentController::class . '@update');
        // $router->post('/{id}/delete', CommentController::class . '@delete');
        $router->get('/{id}', OrderController::class . '@show');
    });
});