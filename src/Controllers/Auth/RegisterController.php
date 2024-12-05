<?php
namespace App\Controllers\Auth;
use App\Commons\Controller;
use App\Models\User;
class RegisterController extends Controller
{
    private const PATH_VIEW = 'register';
    private User $user;
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
    }
    public function showFormRegister()
    {
        middleware_private_route();
        return $this->viewClient(self::PATH_VIEW);
    }
    public function register()
    {
        middleware_private_route();
        $validation = $this->validator->make($_POST, [
            'name' => "required",
            'email' => "required|email",
            'password' => "required",
        ]);
        $validation->validate();
        if($validation->fails()){
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            $_SESSION['old-data'] = $_POST;
            toastr('error', 'Vui lòng nhập đủ thông tin');
            header('location: ' . routeClient('auth/register'));
            exit();
        }else{
            // Nếu oke thì insert data vào table user
            // tạo function helper middleware kiểm tra user
            $checkEmail = $this->user->findByEmail($_POST['email']);
            
        }

         /**
             * Nếu email đã tồn tại thì return và báo lỗi trong email
             */
            if (!empty($checkEmail)) {
                $_SESSION['errors']['email'] = 'Email đã tồn tại.';
                header('location: ' . routeClient('auth/register'));
                exit();
            }
                /**
             * Nếu email chưa tồn tại tiến hành insert bản ghi vào db
             */

             $this->user->insert([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            toastr('success', 'Đăng ký thành công');
            header('location: ' . routeClient('auth/login'));
            exit();
        }

    }
