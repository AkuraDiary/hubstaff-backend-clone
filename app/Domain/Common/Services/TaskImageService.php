<?php

namespace App\Domain\Common\Services;

use App\Shareds\BaseService;
use App\Domain\Project\Models\Task;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TaskImageService extends BaseService
{
    public function __construct(
        private readonly Task $task
        )
    {
        parent::__construct($task);
        
    }

    public function uploadImage() {
        // $taskData = Task::where('id', 4)->with('project')->first();
        // if (File::isDirectory($taskData->project->name)) {

        // }
    }
}
