<?php

namespace App\Controllers\Admin;

use App\Commons\Controller;
use App\Models\ProductTag;
use App\Models\Tag;

class ProductTagController extends Controller
{
    private const PATH_VIEW = 'product_tags.';
    private Tag $tag;
    public function __construct()
    {
        parent::__construct();
        $this->tag = new Tag();
    }

    public function index()
    {
        $tags = $this->tag->getAll('*');

        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__, [
            'tags' => $tags
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
                header('location: ' . routeAdmin('product-tags/create'));
                exit();
            } else {

                $checkExsits = $this->tag->findByName($_POST['name']);

                if (!empty($checkExsits)) {
                    $_SESSION['errors']['name'] = 'Name đã tồn tại. Vui lòng nhập name khác';
                    header('location: ' . routeAdmin('product-tags/create'));
                    exit();
                }

                $this->tag->insert([
                    'name' => $_POST['name'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                toastr('success', 'Tạo tag thành công');
                header('location: ' . routeAdmin('product-tags'));
                exit();

            }
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }
}
