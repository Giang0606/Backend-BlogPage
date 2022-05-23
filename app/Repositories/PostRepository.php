<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository {
    public $model;

    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    public function getAllPost()
    {
        return $this->model->get();
    }
    
    public function createPost($data)
    {
        return $this->model->create($data);
    }

    public function updatePost($data)
    {
        return $this->model->where('id', $data['id'])->update($data);
    }

    public function deletePost($url)
    {
        return $this->model->where('url', $url)->delete();
    }

    public function findPostByUrl($url)
    {
        return $this->model->where('url', $url)->first();
    }
}