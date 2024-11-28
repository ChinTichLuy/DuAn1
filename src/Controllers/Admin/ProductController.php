<?php
namespace App\Controllers\Admin;

use App\Commons\Controller;
use App\Interfaces\CRUDinterfaces;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\Tag;

class ProductController extends Controller implements CRUDinterfaces{
    private const PATH_VIEW = 'products.';

    private Category $category;
    private ProductColor $productColor;
    private Tag $tag;

    private Product $product;
    private $connect;
    public function __construct(){
        parent::__construct();
        $this->category = new Category();
        $this->tag = new Tag();
        $this->productColor = new ProductColor();
        $this->product = new Product();
        $this->connect = $this->product->getConnect();

    }
    public function index(){

        $products = $this->product->getAll('*');
        // dd($products);
        return $this->viewAdmin(self::PATH_VIEW.__FUNCTION__,['products'=> $products]);
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
        // dd($_POST + $_FILES);

         // tạo rule check lỗi các input
         $validation = $this->validator->make($_POST, [
            'product.name' => 'required|max:255',
            'product.thumb_image' => 'nullable|upload_file:0.5M,png,jpeg,gif,webp,jpg',
            'product.price_regular' => 'required|numeric',
            'product.price_sale' => 'required|numeric',
            'product.sku' => 'required',

            'product_galleries' => 'array|max:5',
            'product_galleries.*' => 'nullable|upload_file:0.5M,png,jpeg,gif,webp,jpg',

        ]);

        $validation->validate();

        if ($validation->fails()) {
            // Lưu các data đã nhập vào session - chỉ dùng 1 lần
            $_SESSION['old-data'] = $_POST;
            // Lưu lỗi vào session errors
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            // set thông báo lỗi
            toastr('error', 'Nhập đủ thông tin');
            // redirect về trang create
            return header('location: ' . routeAdmin('products/create'));
        } else {
            $data = $_POST + $_FILES;
        [$dataProduct,$dataProductTags,$dataProductVariants] = $this->handle($data);
        // dd($dataProduct);
        $productImages = upload_file([
            'name'=> $dataProduct['thumb_image']['name']['thumb_image'],
            'tmp_name'=> $dataProduct['thumb_image']['tmp_name']['thumb_image'],

        ],'products');

        $dataProduct['thumb_image'] = $productImages;
         dd($dataProduct);
           
        }


       
       
        $this->connect->beginTransaction();

        try {
            $this->connect->commit();
        } catch (\Throwable $th) {
            $this->connect->rollBack();
            die('Error:'. $th->getMessage());
        }


        // $products = $this->product->insert($dataProduct);
        // if($products){
        //     toastr('success','Thêm Thành Công');
        //     return header('location: ' . routeAdmin('products'));
        // }
        // return header('location: ' . routeAdmin('products/create'));

        

         

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
     
    public function handle($data){    
        // $this->handle = $data;
        // dd($data);
        $dataProduct = $data ['product'];
        $dataProductTags = $data ['tags'] ?? null;
                
        $dataProductVariantTmp = $data ['prroduct_variants'] ?? null;
        $dataProductVariants = [];

        // xu ly tho product image
        $dataProductGallery = $_FILES['product_galleries'];

        //Xu ly slug
        $dataProduct['slug'] = slug($dataProduct['name']);
        $dataProduct['is_active'] ??= 0;
        $dataProduct['is_hot_deal'] ??= 0;
        $dataProduct['is_good_deal'] ??= 0;
        $dataProduct['is_new'] ??= 0;
        $dataProduct['is_show_home'] ??= 0;

        // xu ly image product
        $dataProduct['thumb_image'] = $_FILES['product'];

        if(!empty( $dataProductVariantTmp )){
            foreach($dataProductVariantTmp as $key => $item){

                $dataProductVariants[] = [
                    'product_color_id'=> $key,
                    'quantity'=> $item['quantity'],
                    'price_regular'=> $item['price_regular'],
                    'price_sale'=> $item['price_sale'],
                    'image'=> '',
                    'create_at'=> date('Y-m-d H:i:s'),
                    'update_at'=> date('Y-m-d H:i:s'),
                  

                ];
            }
        }
        return [$dataProduct,$dataProductTags,$dataProductVariants];
    }   


}

