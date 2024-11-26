<?php
use App\Controllers\Client\HomeController;
use App\Controllers\Client\ShopController;
use App\Controllers\Client\ShopDetailController;
$router->get('/', HomeController::class . '@index');
$router->get('shop', ShopController::class . '@index');
$router->get('shop/{slug}/detail', ShopDetailController::class . '@index');


// json - ajax

$router->get('/ajax/{productId}/{colorId}/findProductVariantByColorId', ShopDetailController::class . '@findProductVariantByColorId');
$router->post('/ajax/handleAddToCart', ShopDetailController::class . '@handleAddToCart');