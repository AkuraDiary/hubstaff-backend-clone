<?php

namespace App\Http\Controllers\Project;

use App\Domain\Project\Applications\TaskCrudApplication;
use App\Domain\Project\Applications\TaskIndexApplication;
use App\Domain\Project\Models\Task;
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

        if (Task::where('id', $id)->first()->status == 'Done') {
            return response()->json(['message' => 'Project status is already set to Done'], 400);
        }

        $this->taskCrudApplication->taskDone($id);
        return response()->json(['message' => 'Task Done']);
    }
}