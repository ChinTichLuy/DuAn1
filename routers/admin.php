<?php
$router->mount('/admin',function() use ($router){

    // will result in '/admin/'
    $router->get('/', function(){
        echo 'Admin Page';
    });

    $router->mount('/products', function() use ($router){
        $router->get('/',function(){

        });
    });
});