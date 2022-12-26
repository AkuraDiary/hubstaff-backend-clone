<?php

namespace App\Domain\IAM\Services;

use App\Shareds\BaseService;
use App\Domain\IAM\Models\Role;

class RoleService extends BaseService {

    protected $with = [];

    public function __construct(
        private readonly Role $role,
    )
    {
        parent::__construct($role);
    }
}