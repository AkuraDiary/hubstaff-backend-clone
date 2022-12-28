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
        )
    {
        parent::__construct($task);
        
    }

    // public function uploadImage() {
    //     // $taskData = Task::where('id', 4)->with('project')->first();
    //     // if (File::isDirectory($taskData->project->name)) {

    //     // }
    // }

    public function uploadImage(int $id, Request $request) {
        if($request->file('image')){
               $file= $request->file('image');
               $filename= date('YmdHi').$file->getClientOriginalName();
               $file-> move(public_path('public/Image'), $filename);
            
           }
   
   TaskImage::create([
   'image_path' => $filename,
   'task_id' => $id
   ]);
   }
}
