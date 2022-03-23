<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TaskController;

Route::middleware(['auth:api'])->group(function () {
  Route::apiResource('/tasks', TaskController::class);
});
