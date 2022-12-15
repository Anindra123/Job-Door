<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppliedJobController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\InterviewHistoryController;
use App\Http\Controllers\JobVacencyController;
use App\Http\Controllers\ManageCandidateController;
use App\Http\Controllers\ProposalController;
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

/**
JOB SEEKER API
 */
Route::get('/getJobVacencyList', [JobVacencyController::class, 'getCandidateJobPost']);
Route::get('/getVacencyPostList', [JobVacencyController::class, 'getJobVacencyList']);
Route::get('/searchJobVacencyList/{search}', [JobVacencyController::class, 'searchList']);
Route::get('/apply/{id}', [JobVacencyController::class, 'applyVacantJob']);
Route::get('/getJobVacencyPost/{id}', [JobVacencyController::class, 'getJobPost']);
Route::get('/decline/{id}', [JobVacencyController::class, 'declineVacantJob']);
Route::get("/showAppliedJob", [AppliedJobController::class, 'get']);
Route::get("/getInterviewHist", [InterviewHistoryController::class, 'getHistory']);

/**
JOB PROVIDER API
 */
Route::get("/acceptRequest/{id}", [ManageCandidateController::class, "acceptCandidateReq"]);
Route::post("/declineRequest", [ManageCandidateController::class, "rejectCandidateReq"]);
Route::get("/getCandidateList", [ManageCandidateController::class, "manageCandidateList"]);
Route::get('/showPortfolio/{id}', [ManageCandidateController::class, "viewCandidatePortfolio"]);
Route::get('/cvdownload/{id}', [CVController::class, 'downloadCV']);
Route::get('/getApprovedList/{id}', [ProposalController::class, 'getApprovedCandidates']);
Route::post('/saveProposalPhase', [ProposalController::class, 'saveProposalPhases']);
Route::get('/getPhases', [ProposalController::class, 'getProposalPhase']);
Route::get('/getPhases/{id}', [ProposalController::class, 'getProposalPhaseByID']);
Route::post('/saveProposal', [ProposalController::class, 'saveProposal']);
Route::get('/getInterviewProposal/{id}', [ProposalController::class, 'getInterviewProposal']);

//ADMIN API ROUTE
Route::post("/loginAdmin", [AdminController::class, 'login']);
Route::get('/getProposals', [AdminController::class, 'getProposals']);
Route::get('/approveProposals/{id}', [AdminController::class, 'approve']);
