<?php

namespace App\Controllers\Client;

use App\Commons\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;

class ShopController extends Controller
{
    private const PATH_VIEW = 'shop';
    private Product $product;
    private Category $category;
    private ProductColor $productColor;
    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
        $this->productColor = new ProductColor();
    }
    public function index()
    {
        $page = $_GET['page'] ?? 1;

        $categorySearch = $_GET['category'] ?? null;

        [$products, $totalPage] = $this->product->getAllShop($page, 1);

        $productColors = $this->productColor->getAll('*');


        // Xử lý logic filter product



        // dd($productColors);

        return $this->viewClient(self::PATH_VIEW, [
            'products' => $products,
            'page' => $page,
            'totalPage' => $totalPage,
            'categories' => $this->category->getAll('*'),
            'productColors' => $productColors
        ]);
    }
}
