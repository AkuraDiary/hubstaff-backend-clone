<?php

namespace App\Http\Controllers\Project;

use App\Domain\Project\Applications\TaskCrudApplication;
use App\Domain\Project\Applications\TaskIndexApplication;
use App\Http\Controllers\Controller;

class TaskController extends Controller {

    public function __construct(
        private readonly TaskIndexApplication $taskIndexApplication,
        private readonly TaskCrudApplication $taskCrudApplication
    )
    {
    }

    public function index () {
        return response()->json(['data' => ($this->taskIndexApplication->fetch())->toArray(), 'status' => 200]);
    }

    public function show (int $id) {
        return response()->json(['data' => ($this->taskCrudApplication->find($id))->toArray(), 'status' => 200]);
    }

    
}