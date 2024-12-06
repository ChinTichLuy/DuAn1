<?php
namespace App\Controllers\Client;
use App\Commons\Controller;
use App\Models\Product;
class ShopController extends Controller
{
    private const PATH_VIEW = 'shop';
    private Product $product;
    public function __construct()
    {
        middleware_private_for_admin();
        $this->product = new Product();
    }
    public function index()
    {
        $page = $_GET['page'] ?? 1;
        [$products, $totalPage] = $this->product->getAllShop($page, 10);
        // dd($totalPage);
        return $this->viewClient(self::PATH_VIEW, [
            'products' => $products,
            'page' => $page,
            'totalPage' => $totalPage
        ]);
    }
}