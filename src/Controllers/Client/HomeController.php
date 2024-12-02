<?php
namespace App\Controllers\Client;
use App\Commons\Controller;
class HomeController extends Controller{
    private const PATH_VIEW = 'home';
    public function index()
    {
        // dd($_SESSION);
        return $this->viewClient(self::PATH_VIEW);
    }
}