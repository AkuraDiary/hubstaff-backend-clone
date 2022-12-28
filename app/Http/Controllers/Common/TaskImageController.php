<?php

namespace App\Http\Controllers\Common;

use App\Domain\Common\Services\TaskImageService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskImageController extends Controller {
    
    public function __construct(
        private TaskImageService $taskImageService
    )
    {
    }

    public function uploadImage (int $id, Request $request) {
        $this->taskImageService->uploadImage($id, $request);
    }
}