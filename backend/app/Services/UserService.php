<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class UserService
{
    /**
     * @var \Illuminate\Database\Eloquent\Model|\App\Models\User
     */
    private Model $repository;

    private array $rules = [
        'create' => [
            'name'  => 'required|string',
            'email' => 'required|unique:users',
        ],
        'update' => [
            'id'   => 'required|int',
            'name' => 'string',
        ],
    ];

    /**
     * UserService constructor.
     *
     * @param \App\Models\User $repository
     */
    public function __construct(User $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->repository->all()
                                ->toArray()
            ;
    }

    public function create(array $data)
    {
        $validate = $this->validate($data, 'create');

        if (!$validate['success']) {
            return $validate;
        }

        $newItem          = $this->repository->create($data);
        $validate['data'] = $this->getUserById($newItem->id);

        return $validate;
    }

    public function update(array $data)
    {
        $validate = $this->validate($data, 'update');

        if (!$validate['success']) {
            return $validate;
        }

        $id   = $data['id'];
        $data = Arr::only($data, ['name']);

        $this->repository->where('id', $id)
                         ->update($data)
        ;

        $validate['data'] = $this->getUserById($id);

        return $validate;
    }

    public function delete($id)
    {
        $this->repository->destroy($id);

        return ['success' => true, 'id' => $id];
    }

    public function getUserById($id)
    {
        return $this->repository->where('id', $id)
                                ->first(['id', 'name', 'email'])
                                ->toArray()
            ;
    }

    public function validate(array $data, $key)
    {
        $validator = Validator::make($data, $this->rules[$key]);

        return [
            'success' => !$validator->fails(),
            'message' => $validator->errors(),
        ];
    }
}
