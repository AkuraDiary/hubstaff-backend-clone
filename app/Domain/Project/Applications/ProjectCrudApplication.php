<?php

namespace App\Domain\Project\Applications;

use Illuminate\Http\Request;
use App\Domain\Project\Models\Project;
use App\Domain\Project\Services\ProjectService;

class ProjectCrudApplication
{

    public function __construct(protected ProjectService $projectService)
    {
    }

    public function find(int $id)
    {
        return $this->projectService->findById($id);
    }

    public function getAll()
    {
        return $this->projectService->findAll();
    }

    // public function create(Request $request)
    // {
    //     $organization = new Project();
    //     $organization->fill([
    //         'name' => $request->name,
    //     ]);
    //     $this->projectService->create($organization);
    // }

    // public function update (int $id, Request $request) {
    //     $organization = $this->find($id);
    //     $organization->fill([
    //         'name' => $request->name,
    //     ]);
    //     $this->projectService->update($organization);
    // }

    // public function delete(int $id): void
    // {
    //     $this->projectService->delete($id);
    // }
}
