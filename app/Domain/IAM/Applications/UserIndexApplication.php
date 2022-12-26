<?php

namespace App\Domain\IAM\Applications;

use App\Domain\IAM\Models\User;

class UserIndexApplication {
    
    public function __construct(
        protected readonly User $user
    )
    {
    }

    public function fetch () {
        return $this->user->get();
    }
}