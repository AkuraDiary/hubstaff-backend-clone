<?php

namespace App\Http\Controllers\IAM;

use App\Http\Controllers\Controller;
use App\Domain\IAM\Applications\UserCrudApplication;
use App\Domain\IAM\Applications\UserIndexApplication;

class UserController extends Controller {

    public function __construct(
        private readonly UserCrudApplication $userCrudApplication,
        private readonly UserIndexApplication $userIndexApplication
    )
    {
    }

    public function index () {
        return response()->json($this->userIndexApplication->fetch());
    }

    public function show (int $id) {
        return response()->json($this->userCrudApplication->find($id));
    }

    
}