<?php

namespace App\Domain\IAM\Services;

use App\Shareds\BaseService;
use App\Domain\IAM\Models\User;

class UserService extends BaseService {

    protected $with = [
        'role',
        'organization'
    ];

    public function __construct(
        private readonly User $user,
    )
    {
        parent::__construct($user);
    }

    public function findByRoleName (string $role_name) {
        return $this->user->whereHas('role', function ($query) use ($role_name){
            return $query->where('name', $role_name);
        })->first();
    }
}