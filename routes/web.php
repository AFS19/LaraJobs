<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\UserController;

// ! All jobs
Route::get('/', [JobsController::class, 'index'])->name('jobs.index');

// ! Manage Jobs
Route::get('/jobs/manage', [JobsController::class, 'manageJobs'])->name('manage')->middleware('auth');

// ! resources [index, create, show, edit, update, delete]
Route::resource('jobs', JobsController::class)->middleware('auth');

// ! Create a job
// Route::get('createJob', [JobsController::class, 'create'])->name('jobs.create');

// ! Store job info
// Route::post('/jobs', [JobsController::class, 'store']);

// ! Show Job
// Route::get('/jobs/{job}', [JobsController::class, 'show']);

// ? User authentication
// ! logout user
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// ! user resources
Route::resource('users', UserController::class)->middleware('guest');


// ! Show register form
// Route::get('/user/register', [UserController::class, 'create'])->name('user.register');

// Route::post('/users', [UserController::class, 'store'])->name('user.store');

// ! Show login form
Route::get('/user/loggedIn', [UserController::class, 'login'])->name('user.login')->middleware('guest');

// ! user authenticate
Route::post('/user/authenticate', [UserController::class, 'authenticate'])->name('user.authenticate');
