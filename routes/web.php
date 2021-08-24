<?php

use App\Http\Controllers\AddPhlebotomistController;
use App\Http\Controllers\AddTestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddUserController;
use App\Http\Controllers\TestsController;


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
});

// Route::get('/admin', function () {
//     return view('admin.dashboard');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth','admin']], function (){

    route::get('/dashboard', function(){
        return view('admin.dashboard');
    });

    // route::get('/adduser', function(){
    //     return view('admin.adduser');
    // });
    Route::get('/adduser', [AddUserController::class, 'index']);
    Route::post('/adduser/send', [AddUserController::class, 'send']);

    Route::get('/addphlebotomist', [AddPhlebotomistController::class, 'index']);
    Route::post('/addphlebotomist/send', [AddPhlebotomistController::class, 'send']);

    Route::get('/addtest', [AddTestController::class, 'index']);
    Route::post('/addtest/send', [AddTestController::class, 'send']);

    Route::get('/newtests', [TestsController::class, 'newtest']);
    Route::get('/testdetails/{id}', [TestsController::class, 'view']);
    Route::post('/testdetails/assignto', [TestsController::class, 'assign']);

    Route::get('/assignedtests', [TestsController::class, 'assigned']);
    Route::post('/testdetails/update', [TestsController::class, 'updatestatus']);

    Route::get('/otwsamples', [TestsController::class, 'otwforsamples']);
    Route::get('/collected', [TestsController::class, 'collected']);
    Route::get('/sentlab', [TestsController::class, 'sentlab']);
    Route::get('/reportready', [TestsController::class, 'reportok']);
    Route::get('/alltest', [TestsController::class, 'alltests']);

    Route::get('/download/{file}', [TestsController::class, 'reportdownload']);

    //users and phlebotomists
    Route::get('/viewusers', [AddUserController::class, 'allusers']);
    Route::get('/view-admin-profile', [AddUserController::class, 'adminprofile']);
    Route::get('/view-password-change', [AddUserController::class, 'showpasswordchange']);
    Route::post('/password-change/update', [AddUserController::class, 'changepassword'])->name('profile.change.password');
    
    Route::get('/editUser/{id}', [AddUserController::class, 'editUser']);
    Route::post('/editUser/update', [AddUserController::class, 'updateUser']);

    Route::get('/viewphlebotomists', [AddPhlebotomistController::class, 'allphlebotomists']);
    Route::get('/editPhlebotomist/{id}', [AddPhlebotomistController::class, 'editPhlebotomist']);
    Route::post('/editPhlebotomist/update', [AddPhlebotomistController::class, 'updatePhlebotomist']);

    //DashBoard Values
    Route::get('/dashboard', [TestsController::class, 'dashboad_details']);
});

