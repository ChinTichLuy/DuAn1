<?php
namespace App\Controllers\Admin;

use App\Commons\Controller;
use App\Interfaces\CRUDinterfaces;
use App\Models\Category;
use App\Models\ProductColor;
use App\Models\Tag;
class ProductController extends Controller implements CRUDinterfaces{
    private const PATH_VIEW = 'products.';

    private Category $category;
    private ProductColor $productColor;
    private Tag $tag;
    public function __construct(){
        $this->category = new Category();
        $this->tag = new Tag();
        $this->productColor = new ProductColor();
    }
    public function index(){
        return $this->viewAdmin(self::PATH_VIEW.__FUNCTION__);
    }
    public function create(){
        $categories = $this->category->getAll('*');
        $productColors = $this->productColor->getAll('*');
        $tags = $this->tag->getAll('*');

        return $this->viewAdmin(self::PATH_VIEW.__FUNCTION__, [
            'categories'=> $categories,
            'tags'=> $tags,
            'colors'=> $productColors
        ]);

    }
    public function store(){

    }
    public function show(string $id){
        return $this->viewAdmin(self::PATH_VIEW.__FUNCTION__);
    }
    public function edit(string $id){
        return $this->viewAdmin(self::PATH_VIEW.__FUNCTION__);
    }
    public function update(string $id){
    }
    public function delete(string $id){

    }
     
}

