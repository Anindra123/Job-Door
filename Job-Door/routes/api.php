<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JobVacencyController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/getJobVacencyList', [JobVacencyController::class, 'getCandidateJobPost']);
Route::get('/getVacencyPostList', [JobVacencyController::class, 'getJobVacencyList']);
Route::get('/searchJobVacencyList/{search}', [JobVacencyController::class, 'searchList']);
Route::get('/apply/{id}', [JobVacencyController::class, 'applyVacantJob']);
Route::get('/getJobVacencyPost/{id}', [JobVacencyController::class, 'getJobPost']);
Route::get('/decline/{id}', [JobVacencyController::class, 'declineVacantJob']);

Route::post("/loginAdmin", [AdminController::class, 'login']);
