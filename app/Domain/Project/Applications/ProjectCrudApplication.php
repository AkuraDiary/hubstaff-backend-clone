<?php

namespace App\Domain\Project\Applications;

use Illuminate\Http\Request;
use App\Domain\Project\Models\Project;
use App\Domain\Project\Services\ProjectService;
use App\Http\Requests\Project\ProjectUpdateRequest;

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

    public function create(Request $request)
    {
        $project = new Project();
        $project->fill([
            'name' => $request->name,
            'description' => $request->description,
            'organization_id' => $request->organization_id
        ]);
        $this->projectService->create($project);
    }

    public function update (int $id, ProjectUpdateRequest $request) {
        $project = $this->find($id);
        $project->fill($request->validated());
        $this->projectService->update($project);
    }

    public function delete(int $id): void
    {
        $this->projectService->delete($id);
    }

    public function userProject (int $user_id) {
        return $this->projectService->userProject($user_id);
    }
}
