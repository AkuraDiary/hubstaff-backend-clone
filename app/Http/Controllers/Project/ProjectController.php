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
        return response()->json(['data' => ($this->projectIndexApplication->fetch())->toArray(), 'status' => 200]);
    }

    public function show (int $id) {
        return response()->json(['data' => ($this->projectCrudApplication->find($id))->toArray(), 'status' => 200]);
    }

    
}