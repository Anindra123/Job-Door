<?php

use App\Http\Controllers\CVController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterviewProcessController;
use App\Http\Controllers\JobVacencyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\WorkExpController;
use App\Models\InterviewProposal;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/






/**
    Grouping similar routes with middleware makes code cleaner
    
    preventBackLogout : will not allow user to go back after logout by 
    pressing back button of browser

    checkLogin : prevents user from going to login page after sucessfully login
 */

Route::group(['middleware' => ['preventBackLogout', 'checkLogout']], function () {
    Route::get('/register', [RegistrationController::class, 'getForm']);
    Route::post('/register', [RegistrationController::class, 'signUp']);
    Route::get('/login', [LoginController::class, 'getForm']);
    Route::post('/login', [LoginController::class, 'signIn'])->name('login');
    Route::get('/', [LoginController::class, 'getForm'])->name('login');
    Route::get('/login', [LoginController::class, 'getForm'])->name('login');
    Route::get('/email/verify', function () {
        return view('verify-email');
    })->middleware(['auth', 'verified'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $req) {
        $req->fulfill();
        return view('login')->with('Registered successfully');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $req) {
        $req->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});
/**
    Grouping similar routes with middleware makes code cleaner
    
    handle roles : use to redirect to specific dashboard based on roles
    
 */
Route::group(['middleware' => ['preventBackLogout', 'checkLogout', 'handleRoles']], function () {

    Route::post('/login', [LoginController::class, 'signIn']);
});



/**
    This middleware is handled seperately as it is logging out it
    doesnot require extra validation
 */
Route::get('/logout', [LoginController::class, 'logOut'])
    ->middleware('preventBackLogout');


/**
    Grouping similar routes with middleware
    
    preventBackLogout : will not allow user to go back after logout by 
    pressing back button of browser

    checkLogin : check whether user has session
 */

//Job seeker routes
Route::group(['middleware' => ['preventBackLogout', 'checkLogin', 'jobSeekerRule']], function () {
    Route::get('/dashboard', [DashboardController::class, 'show']);
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::get('/updateprofile', [ProfileController::class, 'updateProfile']);
    Route::post('/updateprofile', [ProfileController::class, 'update']);
    Route::get('/portfolio', [PortfolioController::class, 'showPortfolioInfo']);
    Route::get('/createPortfolio', [PortfolioController::class, 'showPortfolioForm']);
    Route::post('/createPortfolio', [PortfolioController::class, 'createPortfolio']);
    Route::get('/updatePortfolio', [PortfolioController::class, 'showUpdatePortfolioForm']);
    Route::post('/updatePortfolio', [PortfolioController::class, 'updatePortfolio']);
    Route::get('/deletePortfolio', [PortfolioController::class, 'deletePortfolio']);
    Route::get('/skills', [SkillsController::class, 'showSkillForm']);
    Route::post('/skills', [SkillsController::class, 'addSkill']);
    Route::get('/updateSkills', [SkillsController::class, 'updateSkillShow']);
    Route::post('/updateSkills', [SkillsController::class, 'updateSkill']);
    Route::get('/deleteSkills', [SkillsController::class, 'deleteSkill']);
    Route::get('/addExperience', [WorkExpController::class, 'getForm']);
    Route::post('/addExperience', [WorkExpController::class, 'submitForm']);
    Route::get('/updateExperience-{id}', [WorkExpController::class, 'updateFormShow']);
    Route::post('/updateExperience-{id}', [WorkExpController::class, 'updateForm']);
    Route::get('/deleteExperience-{id}', [WorkExpController::class, 'deleteExp']);
    Route::get('/services', [ServiceController::class, 'getForm']);
    Route::post('/services', [ServiceController::class, 'submitForm']);
    Route::get('/updateServices-{id}', [ServiceController::class, 'updateFormShow']);
    Route::post('/updateServices-{id}', [ServiceController::class, 'updateForm']);
    Route::get('/deleteServices-{id}', [ServiceController::class, 'deleteForm']);
    Route::get('/cvUpload', [CVController::class, 'getForm']);
    Route::post('/cvUpload', [CVController::class, 'uploadFile']);
    Route::get('/cvDownload', [CVController::class, 'downloadFile']);
    Route::get('/cvDelete', [CVController::class, 'deleteFile']);
    Route::get('/cvUpdate', [CVController::class, 'updateFileForm']);
    Route::post('/cvUpdate', [CVController::class, 'updateFile']);
    Route::get('/deleteProfile', [ProfileController::class, 'deleteProfile']);
    Route::get('/findVacency', [JobVacencyController::class, 'getCandidateJobPost']);
    Route::get('/getVacency', [JobVacencyController::class, 'showCandidateJobPost']);
    Route::get('/applyJob-{id}', [JobVacencyController::class, 'applyVacantJob']);
    Route::get('/declineJob-{id}', [JobVacencyController::class, 'declineVacantJob']);
    Route::get('/showInterview', [InterviewProcessController::class, 'getAssessment']);
    Route::post('/submitAnswer', [InterviewProcessController::class, 'submitAssesment']);
});

//Admin routes
Route::group(['middleware' => ['preventBackLogout', 'checkLogin', 'adminRule']], function () {
    Route::get('/adminDashboard', [DashboardController::class, 'showAdmin']);
    Route::get('/showTechnical', [InterviewProcessController::class, 'showMenu']);
    Route::get('/createTechnicalForm-{id}', [InterviewProcessController::class, 'viewTechnicalInterviewForm']);
    Route::post('/createTechnicalForm-{id}', [InterviewProcessController::class, 'submitTechnicalInterviewForm']);
    Route::get('/updateTechnicalForm-{id}', [InterviewProcessController::class, 'updateTechnicalInterviewFormView']);
    Route::post('/updateTechnicalForm-{id}', [InterviewProcessController::class, 'updateTechnicalInterviewForm']);
    Route::get('/deleteTechnical-{id}', [InterviewProcessController::class, 'deleteTechnicalForm']);
    Route::get('/startInterView-{id}', [InterviewProcessController::class, 'startProcess']);
    Route::get('/proposalListView', [ProposalController::class, 'fullProposalView']);
    Route::get('/viewProposal-{id}', [ProposalController::class, 'viewProposal']);
});


//Job Provider Routes
Route::group(['middleware' => ['preventBackLogout', 'checkLogout']], function () {
    Route::get('/signUpJp', [RegistrationController::class, 'getJobProviderForm']);
    Route::post('/signUpJp', [RegistrationController::class, 'signUpJobProvider']);
});

Route::group(['middleware' => ['preventBackLogout', 'checkLogin', 'jobProviderRule']], function () {
    Route::get('/jpdashboard', [DashboardController::class, 'showJobProvider']);
    Route::get('/showJobProviderProfile', [ProfileController::class, 'showJobProviderProfile']);
    Route::get('/deleteJobProviderProfile', [DashboardController::class, 'deleteJobProvider']);
    Route::get('/updateJobProviderProfile', [DashboardController::class, 'updateJobProvider']);
    Route::get('/vacency', [JobVacencyController::class, 'get']);
    Route::get('/jobvacencyCreate', [JobVacencyController::class, 'showForm']);
    Route::post('/jobvacencyCreate', [JobVacencyController::class, 'submitForm']);
    Route::get('/jobvacency-{id}', [JobVacencyController::class, 'deletePost']);
    Route::get('/jobvacencyUpdate-{id}', [JobVacencyController::class, 'showUpdateForm']);
    Route::post('/jobvacencyUpdate-{id}', [JobVacencyController::class, 'updatePost']);
    Route::get('/manageCandidate', [JobVacencyController::class, 'manageCandidateList']);
    Route::get('/viewPortfolio-{id}', [JobVacencyController::class, 'viewCandidatePortfolio']);
    Route::get('/acceptCandidate-{id}', [JobVacencyController::class, 'acceptCandidateReq']);
    Route::get('/rejectCandidate-{id}', [JobVacencyController::class, 'rejectCandidateReq']);
    Route::get('/showInterviewProposal', [ProposalController::class, 'showProposal']);
    Route::get('/createInterviewProposal-{jvid}', [ProposalController::class, 'getForm']);
    Route::post('/createInterviewProposal-{jvid}', [ProposalController::class, 'submitForm']);
    Route::get('/updateInterviewProposal', [ProposalController::class, 'updateFormShow']);
    Route::post('/updateInterviewProposal', [ProposalController::class, 'updateForm']);
    Route::get('/deleteProposal', [ProposalController::class, 'deleteInterviewProposal']);
    Route::get('/approveTechnicalForm-{id}', [InterviewProcessController::class, 'approveProcess']);
    Route::get('/declineTechnical-{id}', [InterviewProcessController::class, 'declineProcess']);
    Route::get('/viewTechnicalFormDetails', [InterviewProcessController::class, 'viewTechnicalInterviewJP']);
    Route::get('/manageSubmission', [InterviewProcessController::class, 'showSubmissionList']);
    Route::get('/hireCandidate-{id}', [InterviewProcessController::class, 'hireInterviewCandidate']);
    Route::get('/reject-{id}', [InterviewProcessController::class, 'rejectInterviewCandidate']);
});
