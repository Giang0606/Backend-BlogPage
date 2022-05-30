<?php

namespace App\Repositories;

use App\Models\User; 

class UserRepository {
    public $model;

    public function __construct(User $user)
	{
		$this->model = $user;
    }

    public function getAllUser()
    {
        return $this->model->get();
    }

    public function createUser($data)
    {
        return $this->model->create($data);
    }

    public function findUser($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function findUserByEmail($data)
    {
        return $this->model->where('email', $data['email'])->first();
    }

    public function updateUser($data)
    {
        return $this->model->find($data['id'])->update($data);
    }

    public function deleteUser($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function findUserByBirthday($day)
    {
        return $this->model->where('birth_of_date', 'LIKE', "%".$day."%")->get();
    }
}