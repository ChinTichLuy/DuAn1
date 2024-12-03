<?php
use App\Controllers\Client\CartController;
use App\Controllers\Client\HomeController;
use App\Controllers\Client\ShopController;
use App\Controllers\Client\ShopDetailController;
$router->get('/', HomeController::class . '@index');
$router->get('shop', ShopController::class . '@index');
$router->get('shop/{slug}/detail', ShopDetailController::class . '@index');
$router->get('cart', CartController::class . '@index');

// json - ajax
$router->get('/ajax/{productId}/{colorId}/findProductVariantByColorId', ShopDetailController::class . '@findProductVariantByColorId');
$router->post('/ajax/handleAddToCart', ShopDetailController::class . '@handleAddToCart');
$router->post('/ajax/handleUpdateCart', ShopDetailController::class . '@handleUpdateCart');