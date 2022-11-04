<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\WorkExpController;
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
    Route::post('/login', [LoginController::class, 'signIn']);

    Route::get('/', function () {
        return view('welcome');
    });
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
Route::group(['middleware' => ['preventBackLogout', 'checkLogin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'show']);
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::get('/updateprofile', [ProfileController::class, 'updateProfile']);
    Route::post('/updateprofile', [ProfileController::class, 'update']);
    Route::get('/portfolio', [PortfolioController::class, 'showPortfolioInfo']);
    Route::get('/createPortfolio', [PortfolioController::class, 'showPortfolioForm']);
    Route::post('/createPortfolio', [PortfolioController::class, 'createPortfolio']);
    Route::get('/updatePortfolio', [PortfolioController::class, 'showUpdatePortfolioForm']);
    Route::post('/updatePortfolio', [PortfolioController::class, 'updatePortfolio']);
    Route::delete('/deletePortfolio', [PortfolioController::class, 'deletePortfolio']);
    Route::get('/skills', [SkillsController::class, 'showSkillForm']);
    Route::post('/skills', [SkillsController::class, 'addSkill']);
    Route::get('/updateSkills', [SkillsController::class, 'updateSkillShow']);
    Route::post('/updateSkills', [SkillsController::class, 'updateSkill']);
    Route::delete('/deleteSkills', [SkillsController::class, 'deleteSkill']);
    Route::get('/addExperience', [WorkExpController::class, 'getForm']);
    Route::post('/addExperience', [WorkExpController::class, 'submitForm']);
    Route::get('/updateExperience-{id}', [WorkExpController::class, 'updateFormShow']);
    Route::post('/updateExperience-{id}', [WorkExpController::class, 'updateForm']);
    Route::get('/deleteExperience-{id}', [WorkExpController::class, 'deleteExp']);
});
