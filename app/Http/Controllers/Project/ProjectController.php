<?php

namespace App\Http\Controllers\Project;

use App\Domain\Project\Applications\ProjectCrudApplication;
use App\Domain\Project\Applications\ProjectIndexApplication;
use App\Http\Controllers\Controller;

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

    public function userProject (int $user_id) {
        return $this->projectCrudApplication->userProject($user_id);
    }
}