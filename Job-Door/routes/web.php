<?php

use App\Http\Controllers\AppliedJobController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CompanyInfocontroller;
use App\Http\Controllers\CVController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\InterviewHistoryController;
use App\Http\Controllers\InterviewProcessController;
use App\Http\Controllers\JobVacencyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManageCandidateController;
use App\Http\Controllers\PasswordResetController;
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
use Illuminate\Support\Facades\Auth;
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
    Route::get('/', [LoginController::class, 'getForm'])->name('getlogin');
    Route::get('/login', [LoginController::class, 'getForm'])->name('getlogin');
    Route::post('/login', [LoginController::class, 'signIn'])->name('login');

    Route::get('/forgot-password', [PasswordResetController::class, 'get'])
        ->name('password.request');

    Route::post('/forgot-password', [PasswordResetController::class, 'submit'])
        ->name('password.email');

    Route::get('/reset-password/{token}', function ($token) {
        return view('resetPassForm', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', [PasswordResetController::class, 'submitPassReset'])
        ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
});
/**
    Grouping similar routes with middleware makes code cleaner
    
    handle roles : use to redirect to specific dashboard based on roles
    
 */
Route::group(['middleware' => ['preventBackLogout']], function () {
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
Route::group(['middleware' => ['auth', 'checkLogin', 'verified', 'preventBackLogout', 'jobSeekerRule']], function () {
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
    Route::get('/viewApplied', [AppliedJobController::class, 'getView']);
    Route::get('/showHistory', [InterviewHistoryController::class, 'get']);
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

Route::group(['middleware' => ['auth', 'checkLogin', 'verified', 'preventBackLogout', 'jobProviderRule']], function () {
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
    // Route::get('/manageCandidate', [JobVacencyController::class, 'manageCandidateList']);
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
    Route::get('/showCandidateList', [ManageCandidateController::class, 'getView']);
    Route::get('/showInterviewHistory', [InterviewHistoryController::class, 'get']);
    Route::get('/companyinfo', [CompanyInfocontroller::class, 'getCompanyinfo']);
    Route::post('/companyinfo', [CompanyInfocontroller::class, 'updateCompanyifo']);
    Route::get('/companyinfo', [CompanyInfocontroller::class, 'DeleteCompanyinfo']);
    Route::get('/companyinfo', [CompanyInfocontroller::class, 'updateCompanyifo']);
});


Route::get('/example', function () {
    return view('example');
});


/*

Email routes
*/

Route::get('/getView', [EmailController::class, 'show']);
Route::post('/sendmail', [EmailController::class, 'sendMail']);
