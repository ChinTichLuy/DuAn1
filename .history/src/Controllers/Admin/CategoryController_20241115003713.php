<?php

namespace App\Controllers\Admin;

use App\Commons\Controller;
use App\Interfaces\CRUDinterfaces;
use App\Models\Category;

class CategoryController extends Controller implements CRUDinterfaces
{

    private const PATH_VIEW = 'categories.';
    private Category $category;

    public function __construct()
    {
        parent::__construct();
        $this->category = new Category();
    }
    public function index()
    {

        $categories = $this->category->getAll("*");

        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__, [
            'categories' => $categories
        ]);
    }
    public function create()
    {
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__);
    }
    public function store()
    {
        // $slug = slug($_POST['name']);
        // dd($slug);

        $validation = $this->validator->make($_POST, [
            'name' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'nullable|in:0,1'
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['old-data'] = $_POST;
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            toastr('error', 'Nhập đủ thông tin');
            return header('location: ' . routeAdmin('categories/create'));
        } else {

            $this->category->insert([
                'name' => $_POST['name'],
                'slug' => slug($_POST['name']),
                'description' => $_POST['description'],
                'status' => $_POST['status'] ??= 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            toastr('success', 'Tạo thành công');
            return header('location: ' . routeAdmin('categories'));
        }


        // dd($_POST);
    }
    public function show(string $id)
    {
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__);
    }
    public function edit(string $id)
    {
        dd($id);
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__);
    }
    public function update(string $id) {}
    public function delete(string $id) {}
}
