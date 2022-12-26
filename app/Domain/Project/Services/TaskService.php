<?php

namespace App\Domain\Project\Services;

use App\Domain\Project\Models\Project;
use App\Shareds\BaseService;

class TaskService extends BaseService {

    protected $with = [
        'assigner',
        'assignee',
        'project'
    ];

    public function __construct(
        private readonly Project $project,
    )
    {
        parent::__construct($project);
    }
}