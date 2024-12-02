<?php

namespace App\Controllers\Api;

use App\Models\Category;

class CategoryController
{
    private Category $category;

    public function __construct()
    {
        $this->category = new Category();
    }
    public function getAll()
    {

        $categories = $this->category->getAll();

        header('Content-type: application/json');
        echo json_encode([
            'categories' => $categories,
            'status' => true
        ]);
    }
}
