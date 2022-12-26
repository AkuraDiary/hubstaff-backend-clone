<?php

namespace App\Http\Controllers\Project;

use App\Domain\Project\Applications\OrganizationCrudApplication;
use App\Domain\Project\Applications\OrganizationIndexApplication;
use App\Http\Controllers\Controller;

class UserController extends Controller {

    public function __construct(
        private readonly OrganizationIndexApplication $organizationIndexApplication,
        private readonly OrganizationCrudApplication $organizationCrudApplication
    )
    {
    }

    public function index () {
        return response()->json(['data' => ($this->organizationIndexApplication->fetch())->toArray(), 'status' => 200]);
    }

    public function show (int $id) {
        return response()->json(['data' => ($this->organizationCrudApplication->find($id))->toArray(), 'status' => 200]);
    }

    
}