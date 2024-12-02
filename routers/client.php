<?php

use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\Client\CartController;
use App\Controllers\Client\CheckOutController;
use App\Controllers\Client\HomeController;
use App\Controllers\Client\ShopController;
use App\Controllers\Client\ShopDetailController;

$router->get('/', HomeController::class . '@index');
$router->get('shop', ShopController::class . '@index');
$router->get('shop/{slug}/detail', ShopDetailController::class . '@index');

$router->get('cart', CartController::class . '@index');
// $router->get('checkout', )

// $router->get('checkout', CheckOutController::class . '@index');


$router->mount('/checkout', function () use ($router) {
    $router->get('/', CheckOutController::class . '@index');
    $router->post('/add', CheckOutController::class . '@add');
    $router->get('/momo', CheckOutController::class . '@handleMomo');
});

// handle authentication

$router->mount('/auth', function () use ($router) {
    $router->get('/login', LoginController::class . '@showFormLogin');
    $router->post('/login', LoginController::class . '@login');
    // handle register user
    $router->get('/register', RegisterController::class . '@showFormRegister');
    $router->post('/register', RegisterController::class . '@register');

    // route logout
    $router->get('logout', LoginController::class . '@logout');
});

// json - ajax

$router->get('/ajax/{productId}/{colorId}/findProductVariantByColorId', ShopDetailController::class . '@findProductVariantByColorId');
$router->post('/ajax/handleAddToCart', ShopDetailController::class . '@handleAddToCart');
$router->post('/ajax/handleUpdateCart', ShopDetailController::class . '@handleUpdateCart');
