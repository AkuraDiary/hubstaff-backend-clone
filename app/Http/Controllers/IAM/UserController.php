<?php

namespace App\Http\Controllers\IAM;

use App\Http\Controllers\Controller;
use App\Domain\IAM\Applications\UserCrudApplication;
use App\Domain\IAM\Applications\UserIndexApplication;
use Illuminate\Http\Request;

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

    public function create (Request $request) {
        $this->userCrudApplication->create($request);
        return response()->json(['message' => 'User successfully created']);
    }

    public function update (int $id, Request $request) {
        $this->userCrudApplication->update($id, $request);
        return response()->json(['message' => 'User successfully updated']);
    }

    public function delete (int $id) {
        $data = $this->userCrudApplication->find($id);
        if (!$data->tasks->isEmpty()) {
            return response()->json(['message' => 'Deletion Failed, cannot delete users that already has tasks']);
        }
        $this->userCrudApplication->delete($id);
        return response()->json(['message' => 'User Deletion success']);
    }
}