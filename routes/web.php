<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use \App\Http\MiddleWare\checkUserAuth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(UserController::class)->group(function(){
    Route::get('/login','getLoginPage')->name('login');
    Route::get('/register','getRegisterPage')->name('register');
    Route::post('/register','registerUser');
    Route::post('/login','loginUser');
    Route::get('/logout','logoutUser')->name('logout');
    Route::post('/change-password','changePassword');
    Route::get('create-users','createDummyUsers');
    Route::get('/admin-dashboard','adminDashboard')->name('adminDashboard');
});

Route::middleware('checkUserAuth')->group(function(){
    Route::controller(MainController::class)->group(function(){
        
        Route::get('/user-dashboard','getAllTickets')->name('allTickets');
        Route::get('/pending-tickets','getPendingTickets')->name('pendingTickets');
        Route::get('/closed-tickets','getClosedTickets')->name('closedTickets');
        Route::get('/my-profile','getMyProfile')->name('myProfile');
        Route::get('/create-ticket','getCreateTicket')->name('getCreateTicket');
        Route::post('/create-ticket','createTicket');
        Route::get('ticket/{id}','getTicket')->name('getTicket');
        Route::get('/ticket/edit/{id}','getEditTicketPage')->name('editTicket');
        Route::get('/ticket/close/{id}','closeTicket')->name('closeTicket');
        Route::post('/edit-ticket','editTicket');
        Route::get('/ticket/reopen/{id}','reOpenTicket')->name('reOpenTicket');
        Route::post('upload-profile-pic','uploadProfilePic');
        Route::post('/edit-profile','editProfile');
        Route::post('/update-profile','updateProfile');   
});
});    
    
Route::get('/',[MainController::class,'getHome'])->name('home');