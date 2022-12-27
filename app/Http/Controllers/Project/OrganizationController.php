<?php

namespace App\Http\Controllers\Project;

use App\Domain\Project\Applications\OrganizationCrudApplication;
use App\Domain\Project\Applications\OrganizationIndexApplication;
use App\Http\Controllers\Controller;

class OrganizationController extends Controller {

    public function __construct(
        private readonly OrganizationIndexApplication $organizationIndexApplication,
        private readonly OrganizationCrudApplication $organizationCrudApplication
    )
    {
    }

    public function index () {
        return response()->json($this->organizationIndexApplication->fetch());
    }

    public function show (int $id) {
        return response()->json($this->organizationCrudApplication->find($id));
    }

    
}