<?php

namespace App\Controllers\Admin;

use App\Commons\Controller;
use App\Interfaces\CRUDinterfaces;
use App\Models\Category;

class CategoryController extends Controller implements CRUDinterfaces
{

    private const PATH_VIEW = 'categories.';
    private Category $category;

    public function __construct(){
        parent::__construct();
        $this->category = new Category();
    }
    public function index() {
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__);
    }
    public function create() {
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__);
    }
    public function store() {
        // $slug = slug($_POST['name']);
        // dd($slug);

        $validation = $this->validator->make($_POST, [
            'name' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'nullable|in:0,1'
        ]);

        $validation->validate();

        if($validation->fails()){
            $_SESSION['old-data'] = $_POST;
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            toastr('error', 'Nhập đủ thông tin');
            header('location: ' . routeAdmin('categories/create'));
            exit;
        }else{
            dd()
        }


        // dd($_POST);
    }
    public function show(string $id) {
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__);
    }
    public function edit(string $id) {
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__);
    }
    public function update(string $id) {}
    public function delete(string $id) {}
}
