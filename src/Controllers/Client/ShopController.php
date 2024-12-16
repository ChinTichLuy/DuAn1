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
        middleware_private_for_admin();
    }
    public function index()
    {
        $page = $_GET['page'] ?? 1;

        $categorySearch = $_GET['category'] ?? null;

        $key = $_GET['q'] ?? null;

        $productColors = $this->productColor->getAll('*');


        // Xử lý logic filter product

        if ($key) {
            [$products, $totalPage] = $this->product->filterProduct($page, 20, $key);
        } else if ($categorySearch) {
            [$products, $totalPage] = $this->product->filterProduct($page, 20, null, $categorySearch);
        } else {
            [$products, $totalPage] = $this->product->getAllShop($page, 20);
        }

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
