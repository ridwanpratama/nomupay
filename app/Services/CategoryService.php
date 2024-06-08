<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function addNewCategory($data)
    {
        $categoryModel = new Category();
        return $categoryModel->insert($data);
    }

    public function getCategoriesByUserId($userId)
    {
        $categoryModel = new Category();
        return $categoryModel->where('user_id', $userId)->findAll();
    }
}
