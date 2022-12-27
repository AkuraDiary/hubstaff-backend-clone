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
        return response()->json($this->taskIndexApplication->fetch());
    }

    public function show (int $id) {
        return response()->json($this->taskCrudApplication->find($id));
    }

    public function markTaskDone (int $id) {
        $this->taskCrudApplication->taskDone($id);
        return response()->json(['message' => 'Task Done']);
    }
}