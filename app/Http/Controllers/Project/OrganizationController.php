<?php

namespace App\Http\Controllers\Project;

use App\Domain\Project\Applications\OrganizationCrudApplication;
use App\Domain\Project\Applications\OrganizationIndexApplication;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function create (Request $request) {
        $this->organizationCrudApplication->create($request);
        return response()->json(['message' => 'Successfully created new organization']);
    }

    public function update (int $id, Request $request) {
        $this->organizationCrudApplication->update($id, $request);
        return response()->json(['message' => 'Organization name successfully updated']);
    }

    public function delete (int $id) {
        $data = $this->organizationCrudApplication->find($id);
        if (!$data->projects->isEmpty()) {
            return response()->json(['message' => 'Deletion Failed, cannot delete an already filled organization']);
        }

        $this->organizationCrudApplication->delete($id);
        return response()->json(['message' => 'Organization deletion success']);
    }
}