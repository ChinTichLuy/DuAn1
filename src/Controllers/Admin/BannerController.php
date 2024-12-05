<?php

namespace App\Controllers\Admin;

use App\Commons\Controller;
use App\Models\Banner;

class BannerController extends Controller
{
    private const PATH_VIEW = 'banners.';
    private Banner $banner;


    public function __construct()
    {
        parent::__construct();
        $this->banner = new Banner();
    }

    public function index()
    {
        $banners = $this->banner->getAll('*');
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__, [
            'banners' => $banners
        ]);
    }
    public function create()
    {
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__);
    }
    public function store()
    {
        $validation = $this->validator->make($_POST + $_FILES, [
            'image' => "required|uploaded_file"
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('location: ' . routeAdmin('banners/create'));
            exit();
        } else {
            if (isset($_FILES)) {
                $dataImage = [
                    'name' => $_FILES['image']['name'],
                    'tmp_name' => $_FILES['image']['tmp_name'],
                ];

                $image = upload_file($dataImage, 'banners');

                $this->banner->insert([
                    'image' => $image,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

                toastr('success', 'Thao Tác thành công');
                header('location: ' . routeAdmin('banners'));
                exit();
            }
        }
    }
}
