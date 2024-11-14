<?php

namespace App\Controllers\Admin;

use App\Commons\Controller;
use App\Interfaces\CRUDinterfaces;

class CategoryController extends Controller implements CRUDinterfaces
{

    private const PATH_VIEW = 'categories.';
    public function index() {
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__);
    }
    public function create() {
        return $this->viewAdmin(self::PATH_VIEW . __FUNCTION__);
    }
    public function store() {
        $slug = slug($_POST)
        dd($_POST);
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
