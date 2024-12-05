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
        }else{
            // Nếu oke thì insert data vào table user
            // tạo function helper middleware kiểm tra user
            
        }
        dd($_POST);
    }
}