<?php

namespace App\Http\Controllers\Common;

use App\Domain\Common\Services\TaskImageService;
use App\Http\Controllers\Controller;

class TaskImageController extends Controller {
    
    public function __construct(
        private TaskImageService $taskImageService
    )
    {
    }

    public function uploadImage () {
        $this->taskImageService->uploadImage();
    }
}