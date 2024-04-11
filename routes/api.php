<?php

use App\Http\Controllers\Api\V1\Admin\TaskApiController;
use App\Http\Controllers\Api\V1\Admin\TaskStatusApiController;
use App\Http\Controllers\Api\V1\Admin\TaskTagApiController;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'middleware' => ['auth:sanctum']], function () {
    // Task Status
    Route::apiResource('task-statuses', TaskStatusApiController::class);

    // Task Tag
    Route::apiResource('task-tags', TaskTagApiController::class);

    // Task
    Route::post('tasks/media', [TaskApiController::class, 'storeMedia'])->name('tasks.store_media');
    Route::apiResource('tasks', TaskApiController::class);
});
