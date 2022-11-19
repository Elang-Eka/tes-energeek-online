<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SkillController;
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

// Skill Route
Route::controller(SkillController::class)->group(function () 
{
    Route::post('/skill', 'createSkill');
    Route::get('/skill', 'getSkill');
});

Route::controller(JobController::class)->group(function () 
{
    Route::post('/job', 'createJob');
    Route::get('/job', 'getJob');
});

Route::controller(CandidateController::class)->group(function () 
{
    Route::post('/candidate', 'createCandidate');
    Route::get('/candidate', 'getCandidate');
});
