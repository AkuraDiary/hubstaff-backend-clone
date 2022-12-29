<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;
use App\Domain\Project\Models\Task;
use App\Http\Controllers\Controller;
use App\Domain\Project\Applications\TaskCrudApplication;
use App\Domain\Project\Applications\TaskIndexApplication;

class TaskController extends Controller {

    const DONE = 'Done';

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

    public function create (Request $request) {
        $this->taskCrudApplication->create($request);
        return response()->json(['message' => 'Successfully created new task']);
    }

    public function update (int $id, Request $request) {
        $this->taskCrudApplication->update($id, $request);
        return response()->json(['message' => 'Successfully updated task']);
    }

    public function delete (int $id) {
        $taskData = $this->taskCrudApplication->find($id);
        if ($taskData->status == self::DONE) {
            return response()->json(['message' => 'Deletion Failed, cannot delete an already done task']);
        }
        $this->taskCrudApplication->delete($id);
        return response()->json(['message' => 'Deletion Success']);
    }

    public function markTaskDone (int $id) {

        if (Task::where('id', $id)->first()->status == 'Done') {
            return response()->json(['message' => 'Project status is already set to Done'], 400);
        }

        $this->taskCrudApplication->taskDone($id);
        return response()->json(['message' => 'Task Done']);
    }
}