<?php
namespace App\Controllers\Admin;

use App\Commons\Controller;

class DashBoardController extends Controller {
    private const PATH_VIEW = 'dashboard';
    public function index(){
        return $this->viewAdmin('');
    }
}
