<?php

namespace App\Domain\Project\Applications;

use App\Domain\Project\Models\Organization;

class OrganizationIndexApplication {
    
    public function __construct(
        protected readonly Organization $organization
    )
    {
    }

    public function fetch () {
        return $this->organization->get();
    }
}