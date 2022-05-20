<?php 

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository {
    public $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getAllCategory()
    {
        return $this->model->get();
    }

    public function findCategory($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function createCategory($data)
    {
        return $this->model->create($data);
    }

    public function updateCategory($data)
    {
        return $this->model->find($data['id'])->update($data);
    }

    public function deleteCategory($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function findByKey($key)
    {
        return $this->model->where('category_name', 'LIKE', "%".$key."%")->get();
    }
}