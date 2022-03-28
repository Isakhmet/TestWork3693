<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->all();
    }

    public function create(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function update(Request $request)
    {
        return $this->service->update($request->all());
    }

    public function delete(Request $request)
    {
        return $this->service->delete($request->get('id'));
    }
}
