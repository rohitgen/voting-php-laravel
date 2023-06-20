<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\User;
use App\Http\Controllers;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [App\Http\Controllers\UserDashboardController::class, 'checkElectionTime'])
    ->middleware(['auth'])->name('dashboard');

Route::post('/vote', [App\Http\Controllers\UserController::class, 'voteForCandidate'])->name('voteForCandidate');

Route::get('/candidate-election-details',
    [App\Http\Controllers\UserController::class, 'candidateElectionDetails'])->name('candidateElectionDetails');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'getLogin'])->name('adminLogin');
    Route::post('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
    Route::post('/logout', [App\Http\Controllers\Admin\AdminAuthController::class, 'adminLogout'])->name('adminLogout');
//    Route::group(['middleware' => 'AdminAuthenticated'], function () {
//        Route::get('/', function () {
//            return view('welcome');
//        }, [AdminController::class, 'dashboard'])->name('adminDashboard');
//    });
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('adminDashboard');

    Route::get('/candidates/add',
        [App\Http\Controllers\AdminController::class, 'addCandidateForm'])->name('adminAddCandidateForm');

    Route::post('/candidates',
        [App\Http\Controllers\AdminController::class, 'addCandidate'])->name('adminAddCandidate');

    Route::get('/election-details/add',
        [App\Http\Controllers\AdminController::class, 'addElectionDetailsForm'])->name('adminAddElectionDetailsForm');
    Route::post('/election-details',
        [App\Http\Controllers\AdminController::class, 'addElectionDetails'])->name('adminAddElectionDetails');

    Route::get('/add-election-day',
        [App\Http\Controllers\AdminController::class, 'addElectionDayForm'])->name('adminAddElectionDayForm');

    Route::post('/add-election-day',
        [App\Http\Controllers\AdminController::class, 'addElectionDay'])->name('adminAddElectionDay');

    Route::delete('/deleteCandidate/{candidate}', [App\Http\Controllers\AdminController::class, 'deleteCandidate'])->name('deleteCandidate');

    Route::post('/updateCandidate/{candidate}',[App\Http\Controllers\AdminController::class, 'updateCandidate'])->name('updateCandidate');
});

Route::get('/results', [App\Http\Controllers\ResultsController::class, 'index'])->name('results');

require __DIR__ . '/auth.php';
