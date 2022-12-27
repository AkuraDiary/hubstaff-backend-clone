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

            $taskTime = $this->splitTime($taskData->time_needed); 
            $projectTime = $this->splitTime($projectData->timespan);

            $sumHour = $taskTime['hour'] + $projectTime['hour'];
            $sumMinute = $taskTime['minute'] + $projectTime['minute'];
            $sumSecond = $taskTime['second'] + $projectTime['second'];

            if ($sumMinute >= 60) {
                $sumMinute %= 60;
                $sumHour += 1;
            }

            if ($sumSecond >= 60) {
                $sumSecond %= 60;
                $sumMinute += 1;
            }

            $sumHour < 10 ? $sumHour = '0' . strval($sumHour) : $sumHour = strval($sumHour);
            $sumMinute < 10 ? $sumMinute = '0' . strval($sumMinute) : $sumMinute = strval($sumMinute);
            $sumSecond < 10 ? $sumSecond = '0' . strval($sumSecond) : $sumSecond = strval($sumSecond);

            $taskData->update([
                'status' => self::DONE,
                'done_date' => now(),
            ]);

            $projectData->update([
                'timespan' => $sumHour . ':' . $sumMinute . ':' . $sumSecond,
            ]);
        });
    }

    public function splitTime ($time) {
        $hour = strtok($time, ':');
        $minute = substr($time, strlen($hour) + 1, 2);
        $second = substr($time, ((strlen($hour) + 1) + (strlen($minute) + 1)), 2);

        return [
            'hour' => (int)$hour,
            'minute' => (int)$minute,
            'second' => (int)$second
        ];
    }
}
