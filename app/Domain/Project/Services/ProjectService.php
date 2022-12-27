<?php

namespace App\Domain\Project\Services;

use App\Domain\IAM\Models\User;
use App\Domain\IAM\Services\UserService;
use App\Domain\Project\Models\Project;
use App\Shareds\BaseService;

class ProjectService extends BaseService {

    protected $with = [
        'organization'
    ];

    public function __construct(
        private readonly Project $project,
        private readonly UserService $userService
    )
    {
        parent::__construct($project);
    }

    public function userProject (int $user_id) {
        $projectData = Project::with('tasks')
            ->whereHas('tasks', function ($query) use ($user_id) {
            return $query->where('assignee_id', $user_id);
        })->get();

        return [
            'user' => $this->userService->findById($user_id),
            'project' => $projectData
        ];
    }
}