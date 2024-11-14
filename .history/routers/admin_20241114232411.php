<?php

use App\Controllers\Admin\DashBoardController;

$router->mount('/admin',function() use ($router){

    // will result in '/admin/'
    $router->get('/', DashBoardController::class . '@index');

    $router->mount('categories', function() use ($router){
        $router->get('/', Cate);
    });

    $router->mount('/products', function() use ($router){
        $router->get('/',function(){

        });
    });
});