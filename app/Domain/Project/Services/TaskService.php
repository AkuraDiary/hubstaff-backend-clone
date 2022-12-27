<?php

namespace App\Domain\Project\Services;

use App\Domain\Project\Models\Project;
use App\Domain\Project\Models\Task;
use App\Shareds\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskService extends BaseService
{

    const DONE = 'Done';

    protected $with = [
        'assigner',
        'assignee',
        'project'
    ];

    public function __construct(
        private readonly Task $task,
    ) {
        parent::__construct($task);
    }

    public function taskDone(int $id)
    {
        DB::transaction(function () use ($id) {
            $taskData = $this->findById($id);
            $projectData = Project::where('id', $taskData->project_id)->first();

            $taskHour = strtok($taskData->timespan, ':');
            $taskMinute = substr($taskData->timespan, strlen($taskHour) + 1, 2);
            $taskSecond = substr($taskData->timespan, ((strlen($taskHour) + 1) + (strlen($taskMinute) + 1)), 2); 
            
            $projectHour = strtok($projectData->timespan, ':');
            $projectMinute = substr($projectData->timespan, strlen($projectHour) + 1, 2);
            $projectSecond = substr($projectData->timespan, ((strlen($projectHour) + 1) + (strlen($projectMinute) + 1)), 2); 

            $sumHour = (int)$taskHour + (int)$projectHour;
            $sumMinute = (int)$taskMinute + (int)$projectMinute;
            $sumSecond = (int)$taskSecond + (int)$projectSecond;

            if ($sumMinute >= 60) {
                $sumMinute %= 60;
                $sumHour += 1;
            }

            if ($sumSecond >= 60) {
                $sumSecond %= 60;
                $sumMinute += 1;
            }

            $taskData->update([
                'status' => self::DONE,
                'done_date' => now(),
            ]);

            $projectData->update([
                'timespan' => "$sumHour:$sumMinute:$sumSecond",
            ]);
        });
    }
}
