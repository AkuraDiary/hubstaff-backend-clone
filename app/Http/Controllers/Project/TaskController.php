<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;
use App\Domain\Project\Models\Task;
use App\Http\Controllers\Controller;
use App\Domain\Project\Applications\TaskCrudApplication;
use App\Domain\Project\Applications\TaskIndexApplication;

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

    public function save (Request $request) {
        $this->taskCrudApplication->create($request);
    }

    public function markTaskDone (int $id) {

        if (Task::where('id', $id)->first()->status == 'Done') {
            return response()->json(['message' => 'Project status is already set to Done'], 400);
        }

        $this->taskCrudApplication->taskDone($id);
        return response()->json(['message' => 'Task Done']);
    }
}