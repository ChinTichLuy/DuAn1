<?php
namespace App\Controllers\Admin;

use App\Commons\Controller;
use CRUDinterfaces;

class ProductController extends Controller implements CRUDinterfaces{
    private const PATH_VIEW = 'products.';
    public function index(){
        return $this->viewAdmin(self::PATH_VIEW.__FUNCTION__);
    }
    public function create(){
        return $this->viewAdmin(self::PATH_VIEW.__FUNCTION__);
    }
    public function store(){

    }
    public function show(string $id){
        return $this->viewAdmin(self::PATH_VIEW.__FUNCTION__);
    }
    public function edit(string $id){
        return $this->viewAdmin(self::PATH_VIEW.__FUNCTION__);
    }
    public function update(string $id){
    }
    public function delete(string $id){

    }
     
}

