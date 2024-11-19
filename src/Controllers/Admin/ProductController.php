<?php
namespace App\Controllers\Admin;

use App\Commons\Controller;
use App\Interfaces\CRUDinterfaces;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\Tag;

class ProductController extends Controller implements CRUDinterfaces
{
    private const PATH_VIEW = 'products.';
    private Category $category;
    private ProductColor $productColor;
    private Tag $tag;
    private Product $product;
    private $connect;


    public function __construct()
    {
        parent::__construct();
        $this->category = new Category();
        $this->productColor = new ProductColor();
        $this->tag = new Tag();
        $this->product = new Product();
        $this->connect = $this->product->getConnect();

    }
    public function index()
    {
        $products = $this->product->getAll('*');


        // dd($products);

        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__, [
            'products' => $products
        ]);
    }
    public function create()
    {

        $categories = $this->category->getAll('*');
        $tags = $this->tag->getAll('*');
        $productColors = $this->productColor->getAll('*');



        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__, [
            'categories' => $categories,
            'tags' => $tags,
            'colors' => $productColors
        ]);
    }
    public function store()
    {
        // dd($_POST + $_FILES);

        $validation = $this->validator->make($_POST, [
            'product.name' => 'required|max:255',
            'product.thumb_image' => 'nullable|uploaded_file:0,5M,png,jpeg,gif,webp,jpg',
            'product.price_regular' => 'required|numeric',
            'product.price_sale' => 'nullable|numeric',
            'product.sku' => 'required',
            'product.category_id' => "required",

            // product_gallry

            'product_galleries' => 'array|max:5',
            'product_galleries.*' => 'nullable|uploaded_file:0,5M,png,jpeg,gif,webp,jpg'
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

            [$dataProduct, $dataProductTags, $dataProductVariants] = $this->handle($data);

            $productImages = upload_file([
                'name' => $dataProduct['thumb_image']['name']['thumb_image'],
                'tmp_name' => $dataProduct['thumb_image']['tmp_name']['thumb_image']
            ]);

            $dataProduct['thumb_image'] = $productImages ?: null;
            $dataProduct['price_sale'] = $dataProduct['price_sale'] ?: 0;

            $this->product->insert($dataProduct);
            toastr('success', 'success');
            return header('location: ' . routeAdmin('products'));
        }






        // $this->connect->beginTransaction();

        // try {

        //     $product = $this->product->insert($dataProduct);

        //     if($product){

        //     }



        //     $this->connect->commit();
        // } catch (\Throwable $th) {
        //     $this->connect->rollBack();
        //     die('LuxChill Error: ' . $th->getMessage());
        // }


        // dd($dataProduct);

        // $products = $this->product->insert($dataProduct);

        // if ($products) {
        //     toastr('success', 'Thêm thành công');
        //     return header('location: ' . routeAdmin('products'));
        // }

        // return header('location: ' . routeAdmin('products/create'));

        // dd($dataProduct);




        // Nếu k insert không thành công , thì k insert ảnh


        // dd()


        // dd($dataProduct['thumb_image']['name']['thumb_image']);

        // dd($dataProduct);

        /// insert get id products 
        // use transaction 

        // try {
        /// transaction
        // insert bảng products oke => lấy được id

        // $productId = $this->product->insert($dataProduct);

        // if (!empty($dataProductVariants)) {
        //     foreach ($dataProductVariants as $item) {
        //         $item['product_id'] += $productId;
        //         $this->productVariants->insert($item);
        //     }
        // }

        // if(!empty($dataProductTags)){
        //     foreach($dataProductTags as $tag){
        //         $tag['product_id'] += $productId
        //         $this->productTag->insert($item);
        //     }
        // }


        // } catch (\Throwable $th) {
        //     //throw $th;
        // }

    }
    public function show(string $id)
    {
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__);
    }
    public function edit(string $id)
    {
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__);
    }
    public function update(string $id)
    {
    }
    public function delete(string $id)
    {

        ## Xử lý logic xóa mềm sản phẩm
        // .... 
        ##


        toastr('success', 'Xóa thành công');
        return header('location: ' . routeAdmin('products'));
    }

    public function handle($data)
    {
        // Lấy riêng data của product
        $dataProduct = $data['product'];

        // Lấy riêng data của tags
        $dataProductTags = $data['tags'] ?? null;

        // Xử lý thô product variants
        $dataProductVariantTmp = $data['product_variants'] ?? null;
        $dataProductVariants = [];

        // Xử lý thô product image

        $dataProductGallery = $_FILES['product_galleries'];

        // 'is_active', 'is_hot_deal', 'is_good_deal', 'is_new', 'is_show_home'

        // Xử lý slug
        $dataProduct['slug'] = slug($dataProduct['name']);
        $dataProduct['is_active'] ??= 0;
        $dataProduct['is_hot_deal'] ??= 0;
        $dataProduct['is_good_deal'] ??= 0;
        $dataProduct['is_new'] ??= 0;
        $dataProduct['is_show_home'] ??= 0;

        // Xử lý thêm image của product
        $dataProduct['thumb_image'] = $_FILES['product'];

        if (!empty($dataProductVariantTmp)) {
            foreach ($dataProductVariantTmp as $key => $item) {
                $dataProductVariants[] = [
                    'product_color_id' => $key,
                    'quatity' => $item['quantity'],
                    'price_regular' => $item['price_regular'],
                    'price_sale' => $item['price_sale'],
                    'image' => '',
                    'created_at' => date('Y/m/d H:i:s'),
                    'updated_at' => date('Y/m/d H:i:s'),
                ];
            }
        }

        return [$dataProduct, $dataProductTags, $dataProductVariants];
    }

}

