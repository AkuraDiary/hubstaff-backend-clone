<?php

namespace App\Domain\Common\Services;

use App\Shareds\BaseService;
use App\Domain\Project\Models\Task;
use App\Domain\Common\Models\TaskImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TaskImageService extends BaseService
{
    public function __construct(
        private readonly Task $task
    ) {
        parent::__construct($task);
    }

    public function uploadImage(int $id, Request $request)
    {
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('/images/task/'), $filename);
            
            TaskImage::create([
                'file_path' => $filename,
                'task_id' => $id
            ]);
        }

        return response()->json(['message' => 'No image file found, please input the required image'], 403);
    }
}
