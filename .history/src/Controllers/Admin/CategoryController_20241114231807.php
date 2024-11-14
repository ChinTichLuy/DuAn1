<?php
namespace App\Controllers\Admin;

use App\Commons\Controller;

class CategoryController extends Controller implements \CRUDinterfaces{

    public function index();
    public function create();
    public function store();
    public function show(string $id);
    public function edit(string $id);
    public function update(string $id);
    public function delete(string $id);

}