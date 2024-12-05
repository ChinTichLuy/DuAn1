<?php
namespace App\Controllers\Client;
use App\Commons\Controller;
class HomeController extends Controller{
    private const PATH_VIEW = 'home';

    public function __construct(){
        middleware_private_for_admin();
    }
    public function index()
    {
        return $this->viewClient(self::PATH_VIEW);
    }
}