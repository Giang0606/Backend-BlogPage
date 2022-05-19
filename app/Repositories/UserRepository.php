<?php

namespace App\Repositories;

use App\Models\User; 

class UserRepository {
    public $model;

    public function __construct(User $user)
	{
		$this->model = $user;
    }

    public function createUser($data)
    {
        return $this->model->create($data);
    }

    public function findUserByEmail($data)
    {
        return $this->model->where('email', $data['email'])->first();
    }
}