<?php
namespace App\Controllers\Admin;
use App\Commons\Controller;
use App\Models\ProductColor;
class ProductColorController extends Controller
{
    private const PATH_VIEW = 'product_colors.';
    private ProductColor $productColor;
    public function __construct()
    {
        parent::__construct();
        $this->productColor = new ProductColor();
    }
    public function index()
    {
        $productColor = $this->productColor->getAll('*');
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__, [
            'productColor' => $productColor
        ]);
    }
    public function create()
    {
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__);
    }
    public function store()
    {
        try {
            $validation = $this->validator->make($_POST, [
                'name' => 'required|max:255'
            ]);
            $validation->validate();
            if ($validation->fails()) {
                $_SESSION['old-data'] = $_POST;
                $_SESSION['errors'] = $validation->errors()->firstOfAll();
                toastr('error', 'Có lỗi xảy ra');
                header('location: ' . routeAdmin('product-colors/create'));
                exit();
            } else {
                $checkExsits = $this->productColor->findByName($_POST['name']);
                if (!empty($checkExsits)) {
                    $_SESSION['errors']['name'] = 'Name đã tồn tại. Vui lòng nhập name khác';
                    header('location: ' . routeAdmin('product-colors/create'));
                    exit();
                }
                $this->productColor->insert([
                    'name' => $_POST['name'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                toastr('success', 'Tạo color thành công');
                header('location: ' . routeAdmin('product-colors'));
                exit();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}