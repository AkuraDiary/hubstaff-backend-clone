<?php

namespace App\Domain\IAM\Applications;

use App\Domain\IAM\Models\Role;

class RoleIndexApplication {
    
    public function __construct(
        protected readonly Role $role
    )
    {
    }

    public function fetch () {
        return $this->role->get();
    }
}