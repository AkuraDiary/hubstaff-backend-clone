<?php

namespace App\Domain\IAM\Applications;

use App\Domain\IAM\Models\User;
use Illuminate\Http\Request;
use App\Domain\IAM\Services\UserService;

class UserCrudApplication
{

    public function __construct(protected UserService $userService)
    {
    }

    public function find(int $id)
    {
        return $this->userService->findById($id);
    }

    public function findByRoleName(string $role_name)
    {
        return $this->userService->findByRoleName($role_name);
    }

    public function getAll()
    {
        return $this->userService->findAll();
    }

    public function create(Request $request)
    {
        $user = new User();
        $user->fill([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'organization_id' => $request->organization_id,
            'role_id' => $request->role_id
        ]);
        $this->userService->create($user);
    }

    public function update (int $id, Request $request) {
        $user = $this->find($id);
        $user->fill([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'organization_id' => $request->organization_id,
            'role_id' => $request->role_id
        ]);
        $this->userService->update($user);
    }

    public function delete(int $id): void
    {
        $this->userService->delete($id);
    }
}
