<?php
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\TimelineController;
use App\Http\Controllers\Api\CompanyInfoController;
use App\Http\Controllers\Api\OrganizationalStructureController;
use App\Http\Controllers\Api\VisionMissionGoalController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API routes for frontend
Route::prefix('v1')->group(function () {
    // Pages routes
    Route::apiResource('pages', PageController::class);
    
    // Services routes
    Route::apiResource('services', ServiceController::class);
    
    // Timeline routes
    Route::apiResource('timelines', TimelineController::class);
    
    // Contact routes
    Route::apiResource('contacts', ContactController::class);
    Route::patch('contacts/{contact}/mark-as-read', [ContactController::class, 'markAsRead']);
    
    // Organizational Structure routes
    Route::get('organizational-structure', [OrganizationalStructureController::class, 'index']);
    Route::get('organizational-structure/list', [OrganizationalStructureController::class, 'list']);
    Route::get('organizational-structure/chart', [OrganizationalStructureController::class, 'chart']);
    Route::get('organizational-structure/level/{level}', [OrganizationalStructureController::class, 'byLevel']);
    Route::get('organizational-structure/{id}', [OrganizationalStructureController::class, 'show']);
    
    // Vision Mission Goal routes
    Route::get('vision-mission-goal', [VisionMissionGoalController::class, 'index']);
    Route::get('vision-mission-goal/list', [VisionMissionGoalController::class, 'list']);
    Route::get('vision-mission-goal/vision', [VisionMissionGoalController::class, 'vision']);
    Route::get('vision-mission-goal/mission', [VisionMissionGoalController::class, 'mission']);
    Route::get('vision-mission-goal/goals', [VisionMissionGoalController::class, 'goals']);
    Route::get('vision-mission-goal/type/{type}', [VisionMissionGoalController::class, 'byType']);
    Route::get('vision-mission-goal/{id}', [VisionMissionGoalController::class, 'show']);
    
    // Company Info routes
    Route::get('company-info', [CompanyInfoController::class, 'getCompanyInfo']);
    Route::get('company-info/contact', [CompanyInfoController::class, 'getContactInfo']);
    Route::get('company-info/logo', [CompanyInfoController::class, 'getLogo']);
    
    // Articles routes
    Route::get('articles', [ArticleController::class, 'index']);
    Route::get('articles/featured', [ArticleController::class, 'featured']);
    Route::get('articles/latest', [ArticleController::class, 'latest']);
    Route::get('articles/popular', [ArticleController::class, 'popular']);
    Route::get('articles/search', [ArticleController::class, 'search']);
    Route::get('articles/categories', [ArticleController::class, 'categories']);
    Route::get('articles/tags', [ArticleController::class, 'tags']);
    Route::get('articles/{slug}', [ArticleController::class, 'show']);
    
    // Events routes
    Route::get('events', [EventController::class, 'index']);
    Route::get('events/featured', [EventController::class, 'featured']);
    Route::get('events/upcoming', [EventController::class, 'upcoming']);
    Route::get('events/search', [EventController::class, 'search']);
    Route::get('events/categories', [EventController::class, 'categories']);
    Route::get('events/tags', [EventController::class, 'tags']);
    Route::get('events/{slug}', [EventController::class, 'show']);
});

// CMS Admin routes (will be protected with authentication later)
Route::prefix('admin')->group(function () {
    Route::apiResource('pages', PageController::class)->names([
        'index' => 'admin.pages.index',
        'store' => 'admin.pages.store',
        'show' => 'admin.pages.show',
        'update' => 'admin.pages.update',
        'destroy' => 'admin.pages.destroy',
    ]);
    
    Route::apiResource('services', ServiceController::class)->names([
        'index' => 'admin.services.index',
        'store' => 'admin.services.store',
        'show' => 'admin.services.show',
        'update' => 'admin.services.update',
        'destroy' => 'admin.services.destroy',
    ]);
    
    Route::apiResource('timelines', TimelineController::class)->names([
        'index' => 'admin.timelines.index',
        'store' => 'admin.timelines.store',
        'show' => 'admin.timelines.show',
        'update' => 'admin.timelines.update',
        'destroy' => 'admin.timelines.destroy',
    ]);
    
    Route::apiResource('contacts', ContactController::class)->names([
        'index' => 'admin.contacts.index',
        'store' => 'admin.contacts.store',
        'show' => 'admin.contacts.show',
        'update' => 'admin.contacts.update',
        'destroy' => 'admin.contacts.destroy',
    ]);
    Route::patch('contacts/{contact}/mark-as-read', [ContactController::class, 'markAsRead'])
        ->name('admin.contacts.mark-as-read');
});
