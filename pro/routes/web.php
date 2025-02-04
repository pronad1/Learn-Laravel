<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Translation\ArrayLoader;
//use App\Models\Job;

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use Illuminate\Contracts\Session\Session;
use Illuminate\Types\Relations\Role;
use App\Http\Controllers\Auth\LoginController;
use App\Mail\JobPosted;
use App\Models\Job;
use Illuminate\Support\Facades\Mail;
use Pest\Plugins\Only;

Route::get('test',function(){
    $job = Job::first(); // Replace 1 with the actual job ID or logic to get the job
    Mail::to('prosenjit1156@gmail.com')->send(
        new JobPosted($job)
    );
    return 'Done';
});


Route::view('/', 'home');
Route::view('/contact', 'contact');


// Route::resource('jobs', JobController::class)->Only(['index','show']);
// Route::resource('jobs', JobController::class)->except(['index','show'])->middleware('auth');


Route::controller(JobController::class)->group(function () {
    Route::get('/jobs', [JobController::class , 'index']);
    Route::get('/jobs/create', [JobController::class ,'create']);
    Route::get('/jobs/{job}', [JobController::class ,'show']);

    Route::post('/jobs', [JobController::class ,'store'])
    ->middleware('auth');

    Route::get('/jobs/{job}/edit', [JobController::class ,'edit'])
    ->middleware('auth')
    ->can('edit', 'job');

    Route::patch('/jobs/{job}', [JobController::class ,'update']);
    Route::delete('/jobs/{job}', [JobController::class ,'destroy']);
});

// Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->middleware(['auth', 'can:edit-job, job']);


//Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

// Route::get('/login', [SessionController::class,'create']);
Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class,'store']);

Route::post('/logout', [SessionController::class,'destroy'])->name('logout');
