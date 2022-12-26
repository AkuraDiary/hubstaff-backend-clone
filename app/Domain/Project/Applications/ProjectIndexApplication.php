<?php

namespace App\Domain\Project\Applications;

use App\Domain\Project\Models\Project;

class ProjectIndexApplication {
    
    public function __construct(
        protected readonly Project $project
    )
    {
    }

    public function fetch () {
        return $this->project->get();
    }
}