<?php

namespace App\Controllers\Client;

use App\Commons\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    private const PATH_VIEW = 'home';
    private Product $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function index()
    {

        $newProduct = $this->product->getTop10NewProductHome();
        $saleProduct = $this->product->getTop10SaleProduct();
        $top10Product = $this->product->getTop10Product();

        
        return $this->viewClient(self::PATH_VIEW, [
            'newProduct' => $newProduct,
            'saleProduct' => $saleProduct,
            'top10Product' => $top10Product,
        ]);
    }
}
