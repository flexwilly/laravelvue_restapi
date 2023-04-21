<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserTaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Routes for Status
/***
//show all records
Route::get("index",[StatusController::class,'index']);

//return a single record
Route::get("show/{status}",[StatusController::class,'show']);

//update a single record
Route::put("update/{status}",[StatusController::class,'update']);

//create a record
Route::post("store",[StatusController::class,'store']);

//delete a status
Route::delete("delete/{status}",[StatusController::class,"destroy"]);
 * 
 */
//using a single resource method for all controllers
Route::apiResource("/status",StatusController::class);
Route::apiResource("/tasks",TaskController::class);
Route::apiResource("/userTasks",UserTaskController::class);