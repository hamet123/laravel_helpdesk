<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;
use Illuminate\Support\Facades\Route;

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

// Authentication and other global routes
Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'getLoginPage')->name('login');
    Route::get('/register', 'getRegisterPage')->name('register');
    Route::post('/register', 'registerUser');
    Route::post('/login', 'loginUser');
    Route::get('/logout', 'logoutUser')->name('logout');
    Route::post('/change-password', 'changePassword');
    Route::post('/change-admin-password', 'changeAdminPassword');
    Route::post('/change-agent-password', 'changeAgentPassword');
    Route::get('create-users', 'createDummyUsers');
    Route::get('/', 'getHome')->name('home');
    Route::post('create-agent', 'createAgent');
    Route::post('/ticket-config', 'ticketConfig');
    Route::post('/add-comment', 'addComment');
});

// User Routes
Route::middleware('checkUserAuth')->group(function () {
    Route::controller(MainController::class)->group(function () {
        Route::get('/user-dashboard', 'getAllTickets')->name('userDashboard');
        Route::get('/pending-tickets', 'getPendingTickets')->name('pendingTickets');
        Route::get('/closed-tickets', 'getClosedTickets')->name('closedTickets');
        Route::get('/my-profile', 'getMyProfile')->name('myProfile');
        Route::get('/create-ticket', 'getCreateTicket')->name('getCreateTicket');
        Route::post('/create-ticket', 'createTicket');
        Route::get('/ticket/edit/{id}', 'getEditTicketPage')->name('editTicket');
        Route::get('/ticket/close/{id}', 'closeTicket')->name('closeTicket');
        Route::post('/edit-ticket', 'editTicket');
        Route::get('/ticket/reopen/{id}', 'reOpenTicket')->name('reOpenTicket');
        Route::post('upload-profile-pic', 'uploadProfilePic');
        Route::post('/edit-profile', 'editProfile');
        Route::post('/update-profile', 'updateProfile');
    });
});

// Admin Routes
Route::middleware('checkAdminAuth')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin-dashboard', 'adminDashboard')->name('adminDashboard');
        Route::get('/manage-agents', 'manageAgents')->name('manageAgents');
        Route::get('/manage-departments', 'manageDepartments')->name('manageDepartments');
        Route::get('/manage-ticket-statuses', 'manageTicketStatuses')->name('manageTicketStatuses');
        Route::get('/admin-profile', 'adminProfile')->name('adminProfile');
        Route::get('/search-agents-and-users', 'searchAgentsAndUsers')->name('searchAgentsAndUsers');
        Route::get('/search-ticket', 'getSearchTicket')->name('getSearchTicket');
        Route::post('/create-department', 'createDepartment');
        Route::get('/edit-department/{id}', 'getEditDepartment');
        Route::post('/edit-department', 'editDepartment');
        Route::get('/delete-department/{id}', 'deleteDepartment');
        Route::get('/edit-agent/{id}', 'getEditAgent');
        Route::post('/edit-agent', 'editAgent');
        Route::get('/delete-agent/{id}', 'deleteAgent');
        Route::post('/create-ticket-status', 'createTicketStatus');
        Route::post('/edit-ticket-status', 'editTicketStatus');
        Route::get('/edit-ticket-status/{id}', 'getEditTicketStatus')->name('getEditTicketStatus');
        Route::get('/delete-ticket-status/{id}', 'deleteTicketStatus')->name('deleteTicketStatus');
        Route::post('/search-ticket', 'searchTicket')->name('searchTicket');
        Route::post('/search-user', 'searchUser')->name('searchUser');
        Route::post('upload-admin-profile-pic', 'uploadAdminProfilePic');
        Route::post('/edit-admin-profile', 'editAdminProfile');
        Route::post('/update-admin-profile', 'updateAdminProfile');
    });
});

// Agent Routes
Route::middleware('checkAgentAuth')->group(function () {
    Route::controller(AgentController::class)->group(function () {
        Route::get('/agent-dashboard', 'getAgentDashboard')->name('agentDashboard');
        Route::get('/assigned-tickets', 'getAssignedTickets')->name('assignedTickets');
        Route::get('/agent-closed-tickets', 'getAgentClosedTickets')->name('agentClosedTickets');
        Route::get('/agent-profile', 'getAgentProfile')->name('agentProfile');
        Route::get('/search-users', 'searchUsers')->name('searchUsers');
        Route::get('/search-agent-tickets', 'searchAgentTickets')->name('searchAgentTickets');
        Route::get('/close-ticket-by-agent/{id}', 'closeTicketByAgent')->name('closeTicketByAgent');
        Route::get('/reopen-ticket-by-agent/{id}', 'reOpenTicketByAgent')->name('reOpenTicketByAgent');
        Route::post('upload-agent-profile-pic', 'uploadAgentProfilePic');
        Route::post('/edit-agent-profile', 'editAgentProfile');
        Route::post('/update-agent-profile', 'updateAgentProfile');
        Route::post('/search-ticket-by-agent', 'searchTicketByAgent')->name('searchTicketByAgent');
        Route::post('/search-user-by-agent', 'searchUserByAgent')->name('searchUserByAgent');
    });
});

// Miscellaneous and other Global Routes
Route::get('/ticket/{id}', [MainController::class, 'getTicket'])->name('getTicket');

Route::fallback([UserController::class, 'notFound'])->name('notFound');

// Things to be added
// Global ticket search functionality
// Homepage to be created with knowledgebase Accordian and demo videos
// Middleware for Agent pages - Done
// pagination feature in admin pages
// Main Ticket Page configuration - Done
// Ticket comments - Done
