<?php

namespace App\Http\Controllers\Project;

use App\Domain\Project\Applications\ProjectCrudApplication;
use App\Domain\Project\Applications\ProjectIndexApplication;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller {

    public function __construct(
        private readonly ProjectIndexApplication $projectIndexApplication,
        private readonly ProjectCrudApplication $projectCrudApplication
    )
    {
    }

    public function index () {
        return response()->json($this->projectIndexApplication->fetch());
    }

    public function show (int $id) {
        return response()->json($this->projectCrudApplication->find($id));
    }

    public function create (Request $request) {
        $this->projectCrudApplication->create($request);
        return response()->json(['message' => 'Successfully added new Project']);
    }

    public function update (int $id, Request $request) {
        $this->projectCrudApplication->update($id, $request);
        return response()->json(['message' => 'Project successfully updated']);
    }

    public function delete (int $id) {
        $projectData = $this->projectCrudApplication->find($id);
        if ($projectData->tasks->isEmpty()) {
            return response()->json(['message' => 'Deletion Failed, project data has already been filled with tasks'], 400);
        }

        $this->projectCrudApplication->delete($id);
        return response()->json(['message' => 'Deletion Success']);
    }

    public function userProject (int $user_id) {
        return $this->projectCrudApplication->userProject($user_id);
    }
}