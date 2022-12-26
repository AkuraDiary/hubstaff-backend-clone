<?php

namespace App\Domain\Project\Applications;

use App\Domain\Project\Models\Task;

class TaskIndexApplication {

    public function __construct(
        protected readonly Task $task
    )
    {
    }

    public function fetch () {
        return $this->task->get();
    }
} 