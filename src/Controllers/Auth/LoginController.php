<?php
namespace App\Controllers\Auth;
use App\Commons\Controller;
use App\Models\User;
class LoginController extends Controller
{
    private const PATH_VIEW = 'login';
    private User $user;
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
    }
    public function showFormLogin()
    {
        ## Nếu đã đăng nhập không cho vào route login nữa
        middleware_private_route();
        return $this->viewClient(self::PATH_VIEW);
    }
    public function login()
    {
        ## Nếu đã đăng nhập không cho vào route login nữa
        middleware_private_route();
        $validation = $this->validator->make($_POST, [
            'email' => 'required|email',
            'password' => "required"
        ]);
        $validation->validate();
        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            $_SESSION['old-data'] = $_POST;
            return header('location: ' . routeClient('auth/login'));
        } else {
            // Khi validate == true
            $email = $_POST['email'];
            $password = $_POST['password'];
            // Lấy người dùng ra
            $user = $this->user->findByEmail($email);
            // dd($user);
            if (empty($user)) {
                // Nếu người dùng không tồn tại
                $_SESSION['old-data'] = $_POST;
                $_SESSION['errors']['email'] = 'Thông tin tài khoản không chính xác';
                toastr('error', 'Thông tin tài khoản không chính xác');
                return header('location: ' . routeClient('auth/login'));
            }
            ## Nếu oke thì ...
            ## logic cho ra function clean code
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                if ($user['role'] == 1) {
                    ## role == 1 -> admin -> route admin 
                    toastr('success', 'Đăng nhập thành công');
                    header('location: ' . routeAdmin());
                    exit();
                } else {
                    ## member 
                    toastr('success', 'Đăng nhập thành công');
                    header('location: ' . routeClient());
                    exit();
                }
            } else {
                ## Nếu password sai thì vẫn báo ở email / Tránh trường hợp hacker tấn công
                $_SESSION['errors']['email'] = 'Thông tin tài khoản không chính xác';
                header('location: ' . routeClient('auth/login'));
                exit();
            }
        }
    }
    public function logout()
    {
        unset($_SESSION['user']);
        toastr('success', 'Đăng xuất thành công');
        header('location: ' . routeClient());
        exit();
    }
}