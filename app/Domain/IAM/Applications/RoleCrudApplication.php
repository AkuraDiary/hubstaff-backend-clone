<?php

namespace App\Domain\IAM\Applications;

use App\Domain\IAM\Models\Role;
use Illuminate\Http\Request;
use App\Domain\IAM\Services\RoleService;

class RoleCrudApplication
{

    public function __construct(protected RoleService $roleService)
    {
    }

    public function find(int $id)
    {
        return $this->roleService->findById($id);
    }

    public function getAll()
    {
        return $this->roleService->findAll();
    }

    public function create(Request $request)
    {
        $role = new Role();
        $role->fill([
            'name' => $request->name,
        ]);
        $this->roleService->create($role);
    }

    public function update (int $id, Request $request) {
        $role = $this->find($id);
        $role->fill([
            'name' => $request->name,
        ]);
        $this->roleService->update($role);
    }

    public function delete(int $id): void
    {
        $this->roleService->delete($id);
    }
}
