<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\CandidateController;



// Authentication Routes
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/', [LoginController::class, 'show'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');




// Dashboards
Route::get('/employer/dashboard', function () {
    return view('dashboard.employer');
})->middleware('auth')->name('employer.dashboard');




// Show all job posts for the employer (GET)
Route::get('/employer/job-post', [JobPostController::class, 'showAll'])
    ->middleware('auth')
    ->name('employer.job-post');

    
// Store the job post (POST)
Route::middleware(['auth'])->prefix('employer')->name('employer.')->group(function () {
    Route::post('/job-post', [JobPostController::class, 'store'])->name('job-post.store');
});



// Candidate dashboard
Route::get('/candidate/dashboard', function () {
    return view('dashboard.candidate');
})->middleware('auth')->name('candidate.dashboard');


// Show all job posts (GET)
Route::get('/employer/job-post', [JobPostController::class, 'showAll'])->middleware('auth')->name('employer.job-post');

// Create new job post (POST)
Route::post('/employer/job-post', [JobPostController::class, 'store'])->middleware('auth')->name('employer.job-post.store');

// Show form to edit a job post
Route::get('/employer/job-post/{jobPost}/edit', [JobPostController::class, 'edit'])
    ->middleware('auth')
    ->name('employer.job-post.edit');

// Update the job post (PUT)
Route::put('/employer/job-post/{jobPost}', [JobPostController::class, 'update'])
    ->middleware('auth')
    ->name('employer.job-post.update');



Route::delete('/employer/job-post/{jobPost}', [JobPostController::class, 'destroy'])->name('job-post.destroy');


Route::get('/candidate/job-search', [JobPostController::class, 'search'])->middleware('auth')->name('candidate.job-search');


// candidate apply
Route::middleware(['auth'])->prefix('candidate')->name('candidate.')->group(function () {
    Route::get('/candidate/job-search', [CandidateController::class, 'searchJobs'])->name('candidate.job.search');
    Route::post('/candidate/apply/{jobPost}', [CandidateController::class, 'apply'])->name('candidate.job.apply');
});


// Candidate Routes (grouped properly)
Route::middleware(['auth'])->prefix('candidate')->name('candidate.')->group(function () {
    // Job search (GET)
   // Route::get('/job-search', [CandidateController::class, 'searchJobs'])->name('job.search');

    // Show apply form (GET)
    Route::get('/apply/{jobPost}', [CandidateController::class, 'showApplyForm'])->name('job.apply.form');

    // Submit apply form (POST)
    Route::post('/apply/{jobPost}', [CandidateController::class, 'submitApplication'])->name('job.apply');
});




// Show search results for jobs
// Route::get('/candidate/job-search', [CandidateController::class, 'searchJobs'])->name('candidate.job.search');

// // Show the apply form for a specific job
// Route::get('/candidate/apply/{jobPost}', [CandidateController::class, 'showApplyForm'])->name('candidate.job.apply.form');

// // Handle the job application submission
// Route::post('/candidate/apply/{jobPost}', [CandidateController::class, 'submitApplication'])->name('candidate.job.apply');


Route::get('/job/{id}', [CandidateController::class, 'view'])->name('job.details');


// Route::get('/', function () {
//     return view('welcome');
// });
