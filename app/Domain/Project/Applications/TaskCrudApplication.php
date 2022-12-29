<?php

namespace App\Domain\Project\Applications;

use App\Domain\Project\Models\Task;
use Illuminate\Http\Request;
use App\Domain\Project\Services\TaskService;
use App\Http\Request\Project\TaskUpdateRequest;
use Illuminate\Support\Facades\Auth;

class TaskCrudApplication
{

    const TODO = 'Todo';

    public function __construct(protected TaskService $taskService)
    {
    }

    public function find(int $id)
    {
        return $this->taskService->findById($id);
    }

    public function getAll()
    {
        return $this->taskService->findAll();
    }

    public function create(Request $request)
    {
        $task = new Task();
        $task->fill([
            'name' => $request->name,
            'description' => $request->description,
            'status' => self::TODO,
            'time_needed' => date('H:i:s', $request->time_needed),
            'assigner_id' => Auth::user()->id,
            'assignee_id' => $request->assignee_id,
            'project_id' => $request->project_id
        ]);
        $this->taskService->create($task);
    }

    public function update (int $id, TaskUpdateRequest $request) {
        $task = $this->find($id);
        $task->fill($request->validated());
        $this->taskService->update($task);
    }

    public function delete(int $id): void
    {
        $this->taskService->delete($id);
    }

    public function taskDone (int $id) {
        $this->taskService->taskDone($id);
    }
}
