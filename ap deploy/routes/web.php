<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\TimelineController as AdminTimelineController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\FileUploadController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\OrganizationalStructureController;
use App\Http\Controllers\Admin\CompanyInfoController;
use App\Http\Controllers\Admin\VisionMissionGoalController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\MediaController;

Route::get('/', function () {
    return redirect('/admin/login');
});

// Admin Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Add fallback login route for Laravel's default auth system
Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');

// Admin Routes (Protected)
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('pages', AdminPageController::class);
    Route::resource('services', AdminServiceController::class);
    Route::resource('timelines', AdminTimelineController::class);
    Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
    
    Route::patch('contacts/{contact}/mark-as-read', [AdminContactController::class, 'markAsRead'])
        ->name('contacts.mark-as-read');
    Route::get('contacts/unread', [AdminContactController::class, 'unread'])
        ->name('contacts.unread');
    
    // File upload routes
    Route::post('upload', [FileUploadController::class, 'upload'])->name('upload');
    Route::delete('upload', [FileUploadController::class, 'delete'])->name('upload.delete');
});

// Company Info routes  
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::resource('company', CompanyInfoController::class);
    Route::patch('company/{company}/set-active', [CompanyInfoController::class, 'setActive'])->name('company.set-active');
      // Organizational Structure routes
    Route::resource('organizational-structure', OrganizationalStructureController::class);
    Route::patch('organizational-structure/{organizationalStructure}/toggle-active', [OrganizationalStructureController::class, 'toggleActive'])->name('organizational-structure.toggle-active');
      // Vision Mission Goal routes
    Route::resource('vision-mission-goal', VisionMissionGoalController::class);
    Route::patch('vision-mission-goal/{visionMissionGoal}/toggle-active', [VisionMissionGoalController::class, 'toggleActive'])->name('vision-mission-goal.toggle-active');      // User Management routes (Admin only)
    Route::middleware('admin.role:admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    });    // Article Management routes (Admin & Penulis)
    Route::resource('articles', ArticleController::class);
    Route::patch('articles/{article}/toggle-featured', [ArticleController::class, 'toggleFeatured'])->name('articles.toggle-featured');
    Route::patch('articles/{article}/change-status', [ArticleController::class, 'changeStatus'])->name('articles.change-status');
    Route::post('articles/bulk-action', [ArticleController::class, 'bulkAction'])->name('articles.bulk-action');
    
    // Test route for article form
    Route::get('articles/test-form', function () {
        return view('admin.articles.test-form');
    })->name('articles.test-form');
    
    // Event Management routes (Admin & Penulis)
    Route::resource('events', EventController::class);
    Route::patch('events/{event}/toggle-featured', [EventController::class, 'toggleFeatured'])->name('events.toggle-featured');
    Route::patch('events/{event}/change-status', [EventController::class, 'changeStatus'])->name('events.change-status');
    Route::post('events/bulk-action', [EventController::class, 'bulkAction'])->name('events.bulk-action');
    
    // Media Management routes
    Route::prefix('media')->name('media.')->group(function () {
        Route::post('upload', [MediaController::class, 'upload'])->name('upload');
        Route::get('browse', [MediaController::class, 'browse'])->name('browse');
        Route::delete('delete', [MediaController::class, 'delete'])->name('delete');
    });
});
