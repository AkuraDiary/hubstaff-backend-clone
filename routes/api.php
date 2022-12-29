<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Common\TaskImageController;
use App\Http\Controllers\IAM\RoleController;
use App\Http\Controllers\IAM\UserController;
use App\Http\Controllers\Project\OrganizationController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Project\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['sessions']], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::post('/users/create', [UserController::class, 'create']);
    Route::post('/users/{id}/update', [UserController::class, 'update']);
    Route::delete('/users/{id}/delete', [UserController::class, 'delete']);

    Route::get('/roles', [RoleController::class, 'index']);
    Route::get('/roles/{id}', [RoleController::class, 'show']);

    Route::get('/organizations', [OrganizationController::class, 'index']);
    Route::get('/organizations/{id}', [OrganizationController::class, 'show']);
    Route::post('/organizations/create', [OrganizationController::class, 'create']);
    Route::post('/organizations/{id}/update', [OrganizationController::class, 'update']);
    Route::delete('/organizations/{id}/delete', [OrganizationController::class, 'delete']);

    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{id}', [ProjectController::class, 'show']);
    Route::get('/{user_id}/projects', [ProjectController::class, 'userProject']);
    Route::post('/projects/create', [ProjectController::class, 'create']);
    Route::post('/projects/{id}/update', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}/delete', [ProjectController::class, 'delete']);

    Route::get('/tasks', [TaskController::class, 'index']);
    Route::get('/tasks/{id}', [TaskController::class, 'show']);
    Route::post('/tasks/{id}/task-done', [TaskController::class, 'markTaskDone']);
    Route::post('/tasks/create', [TaskController::class, 'create']);
    Route::post('/tasks/{id}/update', [TaskController::class, 'update']);
    Route::delete('/tasks/{id}/delete', [TaskController::class, 'delete']);

    Route::post('/tasks/{id}/upload-image', [TaskImageController::class, 'uploadImage']);
});