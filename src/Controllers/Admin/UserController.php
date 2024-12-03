<?php
namespace App\Controllers\Admin;
use App\Commons\Controller;
use App\Interfaces\CRUDinterfaces;
use App\Models\User;
class UserController extends Controller implements CRUDinterfaces
{
    private const PATH_VIEW = 'users.';
    private User $user;
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
    }
    public function index()
    {
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__, [
            'users' => $this->user->getAll('*')
        ]);
    }
    public function create()
    {
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__);
    }
    public function store()
    {
        $validation = $this->validator->validate($_POST + $_FILES, [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'password' => 'required|max:255|alpha_num',
            'avatar' => 'nullable|uploaded_file:0,5M,png,jpeg,gif,webp,jpg',
            'phone' => 'required|numeric|digits:10',
            'is_active' => 'in:0,1',
            'role' => 'in:0,1',
        ]);
        $validation->validate();
        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            $_SESSION['old-data'] = $_POST;
            toastr('error', 'Nhập đủ thông tin');
            return header('location: ' . routeAdmin('users/create'));
        } else {
            $avatar = !empty($_FILES['avatar']) ? upload_file([
                'name' => $_FILES['avatar']['name'],
                'tmp_name' => $_FILES['avatar']['tmp_name'],
            ], 'user') : null;
            try {
                $this->user->insert([
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'phone' => $_POST['phone'],
                    'is_active' => $_POST['is_active'] ??= 0,
                    'role' => $_POST['role'],
                    'avatar' => $avatar,
                    'created_at' => date('Y/m/d H:i:s'),
                    'updated_at' => date('Y/m/d H:i:s'),
                ]);
                toastr('success', 'Thêm user thành công');
                return header('location: ' . routeAdmin('users'));
            } catch (\Throwable $th) {
                if (!empty($_FILES['avatar']['name'])) {
                    delete_image($avatar);
                }
                ;
                die('Error: ' . $th->getMessage());
            }
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
        try {
            $user = $this->user->find($id);
            if ($user) {
                $this->user->delete($id);
                if ($user['avatar']) {
                    delete_image($user['avatar']);
                }
                toastr('success', 'Delete success');
                return header('location: ' . routeAdmin('users'));
            }
        } catch (\Throwable $th) {
            die('Error: ' . $th->getMessage());
        }
    }
}