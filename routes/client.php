<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\ClientAuthController;
use App\Http\Controllers\Client\ClientController;

// Route::prefix('client')->group(function () {
//     Route::get('login', [AuthController::class, 'showLoginForm'])->name('client.login');
//     Route::post('login', [AuthController::class, 'login']);
//     Route::post('logout', [AuthController::class, 'logout'])->name('client.logout');

//     Route::middleware('auth:client')->group(function () {
//         Route::get('dashboard', [DashboardController::class, 'index'])->name('client.dashboard');
//         Route::get('projects', [DashboardController::class, 'projects'])->name('client.projects');
//         Route::get('feedback', [DashboardController::class, 'feedback'])->name('client.feedback');
//         Route::get('maintenance', [DashboardController::class, 'maintenance'])->name('client.maintenance');
//         Route::get('reports', [DashboardController::class, 'reports'])->name('client.reports');
//     });
// });

Route::prefix('client')->name('client.')->group(function () {
    Route::get('/login', [ClientAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [ClientAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [ClientAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:client')->group(function () {
        Route::get('/', [ClientAuthController::class, 'dashboard'])->name('dashboard');
        Route::get('/dashboard', [ClientAuthController::class, 'dashboard'])->name('dashboard');

        // Optional stub routes
        // Route::get('/projects', fn () => view('client.projects'))->name('projects');//old projects controler
        Route::get('/projects', [ClientController::class, 'projects'])->name('projects');
        Route::get('/active-projects', [ClientController::class, 'activeProjects'])->name('active_projects');
        Route::get('/onHold-projects', [ClientController::class, 'ProjectsonHold'])->name('ProjectsonHold');
        Route::get('/project-modules', [ClientController::class, 'projectModules'])->name('projectModules');
        Route::get('/completed-projects', [ClientController::class, 'completedProjects'])->name('CompletedProjects');
        Route::get('/project-details/{id}', [ClientController::class, 'ProjectDetails'])->name('ProjectDetails');
        Route::get('/module-details/{id}', [ClientController::class, 'ModuleDetails'])->name('ModuleDetails');
        Route::get('/payments', fn () => view('client.payments'))->name('payments');
        Route::get('/maintenance', fn () => view('client.maintenance'))->name('maintenance');
        Route::get('/feedback', fn () => view('client.feedback'))->name('feedback');
        Route::get('/reports', fn () => view('client.reports'))->name('reports');
    });
});



Route::get('test', function () {
    return 'Client route is working!';
});
