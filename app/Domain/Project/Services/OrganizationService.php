<?php

namespace App\Domain\Project\Services;

use App\Shareds\BaseService;
use App\Domain\Project\Models\Organization;

class OrganizationService extends BaseService {

    protected $with = [
        'projects'
    ];

    public function __construct(
        private readonly Organization $organization,
    )
    {
        parent::__construct($organization);
    }
}