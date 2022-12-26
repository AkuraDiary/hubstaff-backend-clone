<?php

namespace App\Domain\Project\Applications;

use Illuminate\Http\Request;
use App\Domain\Project\Models\Organization;
use App\Domain\Project\Services\OrganizationService;

class OrganizationCrudApplication
{

    public function __construct(protected OrganizationService $organizationService)
    {
    }

    public function find(int $id)
    {
        return $this->organizationService->findById($id);
    }

    public function getAll()
    {
        return $this->organizationService->findAll();
    }

    public function create(Request $request)
    {
        $organization = new Organization();
        $organization->fill([
            'name' => $request->name,
        ]);
        $this->organizationService->create($organization);
    }

    public function update (int $id, Request $request) {
        $organization = $this->find($id);
        $organization->fill([
            'name' => $request->name,
        ]);
        $this->organizationService->update($organization);
    }

    public function delete(int $id): void
    {
        $this->organizationService->delete($id);
    }
}
