<?php
namespace App\Controllers\Admin;

use App\Commons\Controller;
use App\Interfaces\CRUDinterfaces;
use App\Models\Category;
use App\Models\ProductColor;
use App\Models\Tag;

class ProductController extends Controller implements CRUDinterfaces
{
    private const PATH_VIEW = 'products.';
    private Category $category;
    private ProductColor $productColor;
    private Tag $tag;


    public function __construct()
    {
        $this->category = new Category();
        $this->productColor = new ProductColor();
        $this->tag = new Tag();
    }
    public function index()
    {



        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__);
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

        $data = $_POST + $_FILES;

        [$dataProduct, $dataProductTags, $dataProductVariants] = $this->handle($data);

        dd($dataProduct);

        /// insert get id products 
        // use transaction 

        try {
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


        } catch (\Throwable $th) {
            //throw $th;
        }

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

    }

    public function handle($data)
    {
        $dataProduct = $data['product'];
        $dataProductTags = $data['tags'] ?? null;

        $dataProductVariantTmp = $data['product_variants'] ?? null;
        $dataProductVariants = [];

        // 'is_active', 'is_hot_deal', 'is_good_deal', 'is_new', 'is_show_home'

        // Xử lý slug
        $dataProduct['slug'] = slug($dataProduct['name']);
        $dataProduct['is_active'] ??= 0;
        $dataProduct['is_hot_deal'] ??= 0;
        $dataProduct['is_good_deal'] ??= 0;
        $dataProduct['is_new'] ??= 0;
        $dataProduct['is_show_home'] ??= 0;

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

