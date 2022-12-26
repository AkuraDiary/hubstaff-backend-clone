<?php

namespace App\Http\Controllers\IAM;

use App\Http\Controllers\Controller;
use App\Domain\IAM\Applications\RoleCrudApplication;
use App\Domain\IAM\Applications\RoleIndexApplication;

class RoleController extends Controller {

    public function __construct(
        private readonly RoleCrudApplication $roleCrudApplication,
        private readonly RoleIndexApplication $roleIndexApplication
    )
    {
}

    public function index () {
        return response()->json(['data' => ($this->roleIndexApplication->fetch())->toArray(), 'status' => 200]);
    }

    public function show (int $id) {
        return response()->json(['data' => ($this->roleCrudApplication->find($id))->toArray(), 'status' => 200]);
    }

    
}