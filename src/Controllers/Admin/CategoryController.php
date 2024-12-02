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
        // select có paginate và deleted_at = 0 / 0 là active 1 là no active thay cho xóa thẳng sẽ gây lỗi hệ thống
        $page = $_GET['page'] ?? 1;
        $perPage = 10; // số record muốn hiện trên 1 trang

        [$categories, $totalPage] = $this->category->paginate($page, $perPage);

        // nếu số page lớn hơn tổng page hiện có thì redirect về trang list page=1
        if ($page > $totalPage) {
            return header('location: ' . routeAdmin('categories'));
        }

        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__, [
            'categories' => $categories,
            'page' => $page,
            'totalPage' => (int) $totalPage
        ]);
    }
    public function create()
    {
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__);
    }
    public function store()
    {
        // tạo rule check lỗi các input
        $validation = $this->validator->make($_POST, [
            'name' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'nullable|in:0,1'
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
            return header('location: ' . routeAdmin('categories/create'));
        } else {
            // insert vào db
            $this->category->insert([
                'name' => $_POST['name'],
                'slug' => slug($_POST['name']),
                'description' => $_POST['description'],
                'status' => $_POST['status'] ??= 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            // nếu thành công set thông báo và redirect về trang list
            toastr('success', 'Tạo thành công');
            return header('location: ' . routeAdmin('categories'));
        }
    }
    public function show(string $id)
    {

        $category = $this->category->find($id);
        // nếu không tìm thấy category redirect trang list
        if (!$category) {
            return header('location: ' . routeAdmin('categories'));
        }

        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__, [
            'category' => $category
        ]);
    }
    public function edit(string $id)
    {
        $category = $this->category->find($id);
        // nếu không tìm thấy category redirect trang list
        if (!$category) {
            return header('location: ' . routeAdmin('categories'));
        }
        ;

        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__, [
            'category' => $category
        ]);
    }
    public function update(string $id)
    {


        $category = $this->category->find($id);

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
            return header('location: ' . routeAdmin('categories/' . $id . '/edit'));
        } else {
            $this->category->update($id, [
                'name' => $_POST['name'],
                'slug' => $_POST['name'] != $category['name'] ? slug($_POST['name']) : $category['slug'],
                'description' => $_POST['description'],
                'status' => $_POST['status'] ??= 0,
                'updated_at' => date('Y/m/d H:i:s')
            ]);

            toastr('success', 'Sửa thành công');
            return header('location: ' . routeAdmin('categories/' . $id . '/edit'));
        }
    }
    public function delete(string $id)
    {
        // test truong hop xoa

        $category = $this->category->find($id);

        if ($category) {
            $this->category->delete2($id);
            toastr('success', 'Delete success');
            return header('location: ' . routeAdmin('categories'));
        }

        toastr('error', 'Khong tim thay category');
        return header('location: ' . routeAdmin('categories'));
    }
}
