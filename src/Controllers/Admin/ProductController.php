<?php
namespace App\Controllers\Admin;

use App\Commons\Controller;
use App\Interfaces\CRUDinterfaces;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductTag;
use App\Models\ProductVariants;
use App\Models\Tag;
use Exception;

class ProductController extends Controller implements CRUDinterfaces{
    private const PATH_VIEW = 'products.';

    private Category $category;
    private ProductColor $productColor;
    private Tag $tag;

    private Product $product;
    private ProductGallery $productGallery;

    private ProductTag $productTag;

    private ProductVariants $productVariants;
    private $connect;
    public function __construct(){
        parent::__construct();
        $this->category = new Category();
        $this->tag = new Tag();
        $this->productColor = new ProductColor();
        $this->product = new Product();
        $this->connect = $this->product->getConnect();
        $this->productGallery = new ProductGallery();
        $this->productTag = new ProductTag();
        $this->productVariants = new ProductVariants();
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
            [$dataProduct, $dataProductTags, $dataProductVariants, $dataProductGallerys] = $this->handle($_POST + $_FILES);


            $productImages = upload_file([
                'name' => $dataProduct['thumb_image']['name']['thumb_image'],
                'tmp_name' => $dataProduct['thumb_image']['tmp_name']['thumb_image']
            ], 'products');

            $dataProduct['thumb_image'] = $productImages ?: null;
            $dataProduct['price_sale'] = $dataProduct['price_sale'] ?: 0;

            $this->connect->beginTransaction();

            try {
                ## insert data product 
                $productId = $this->product->insertGetId($dataProduct);

                ## Nếu insert không thành công thì tạo mã lỗi mới
                if (!$productId) {
                    throw new Exception('Insert product failed');
                }
                ;

                ## thêm tag vào db
                if (!empty($dataProductTags)) {
                    foreach ($dataProductTags as $tag) {
                        $resultTag = $this->productTag->insert([
                            'product_id' => $productId,
                            'tag_id' => $tag
                        ]);

                        if (!$resultTag) {
                            throw new Exception("Insert product tag {$tag} failed");
                        }
                    }
                }

                ## thêm variant vào db
                if (!empty($dataProductVariants)) {
                    foreach ($dataProductVariants as $variant) {
                        $variant['product_id'] = $productId;

                        $resultVariant = $this->productVariants->insert($variant);

                        if (!$resultVariant) {
                            throw new Exception("Insert product variant {$variant} failed");
                        }
                    }
                }

                if (!empty($dataProductGallerys)) {
                    foreach ($dataProductGallerys as $image) {
                        $image['product_id'] = $productId;

                        $resultGallery = $this->productGallery->insert($image);

                        if (!$resultGallery) {
                            throw new Exception("Insert product image {$image} failed");
                        }
                    }
                }

                $this->connect->commit();
                toastr('success', 'success');
                return header('location: ' . routeAdmin('products'));
            } catch (\Throwable $th) {

                delete_image($dataProduct['thumb_image']);

                
                if (!empty($dataProductGallerys)) {
                    foreach ($dataProductGallerys as $image) {
                        delete_image($image['image']);
                    }
                }


                die('LuxChill Error: ' . $th->getMessage());
            }
        }
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
        $product = $this->product->find($id);

        if ($product) {
            $this->product->delete($id);
            $imageOld = $product['thumb_image'];

            delete_image($imageOld);

            toastr('success', 'Xóa thành công');
            return header('location: ' . routeAdmin('products'));
        }
    }
     
    public function handle($data)
    {
        // Lấy riêng data của product
        $dataProduct = $data['product'];

        // Lấy riêng data của tags
        $dataProductTags = $data['tags'] ?? null;

        // Lấy riêng data product variants
        $dataProductVariantTmp = $data['product_variants'] ?? null;
        $dataProductVariants = [];

        // Lấy riêng product galleries 
        $dataProductGalleryTmp = $_FILES['product_galleries'] ?? null;
        $dataProductGallerys = [];


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
                    'price_regular' => $item['price_regular'] ?: 0,
                    'price_sale' => $item['price_sale'] ?: 0,
                    'created_at' => date('Y/m/d H:i:s'),
                    'updated_at' => date('Y/m/d H:i:s'),
                ];
            }
        }


        // Xử lý data product galery

        if ($dataProductGalleryTmp && !empty($dataProductGalleryTmp['name'][0])) {
            foreach ($dataProductGalleryTmp['name'] as $key => $image) {
                $file = [
                    'name' => $image,
                    'tmp_name' => $dataProductGalleryTmp['tmp_name'][$key]
                ];


                $uploadFile = upload_file($file, 'product_galleries');

                if ($uploadFile) {
                    $dataProductGallerys[] = [
                        'image' => $uploadFile
                    ];
                }

            }
        }


        return [$dataProduct, $dataProductTags, $dataProductVariants, $dataProductGallerys];
    }


}

