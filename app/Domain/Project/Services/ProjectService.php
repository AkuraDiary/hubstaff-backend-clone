<?php

namespace App\Domain\Project\Services;

use App\Domain\Project\Models\Project;
use App\Shareds\BaseService;

class ProjectService extends BaseService {

    protected $with = [
        'organization'
    ];

    public function __construct(
        private readonly Project $project,
    )
    {
        parent::__construct($project);
    }
}