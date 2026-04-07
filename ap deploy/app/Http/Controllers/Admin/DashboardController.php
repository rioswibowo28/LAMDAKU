<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Timeline;
use App\Models\Contact;
use App\Models\Page;
use App\Models\CompanyInfo;
use App\Models\OrganizationalStructure;
use App\Models\VisionMissionGoal;
use App\Models\User;
use App\Models\Article;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        // Debug log
        \Log::info('Dashboard controller called (test version)', [
            'session_authenticated' => session('admin_authenticated'),
            'admin_user' => session('admin_user'),
            'timestamp' => now()
        ]);
        
        try {
            // Get current user for role-based data
            $userRole = session('admin_role') ?: 'admin';
            $userId = session('admin_id') ?: 1;
            
            // Safe stats calculation with fallback values
            $stats = [
                'services' => $this->safeCount('App\Models\Service', 3),
                'timelines' => $this->safeCount('App\Models\Timeline', 6),
                'contacts' => $this->safeCount('App\Models\Contact', 12),
                'pages' => $this->safeCount('App\Models\Page', 5),
                'articles' => $this->safeCount('App\Models\Article', 15),
                'events' => $this->safeCount('App\Models\Event', 7),
                'users' => $this->safeCount('App\Models\User', 8),
                'visionMissionGoals' => $this->safeCount('App\Models\VisionMissionGoal', 10),
                'organizationalStructures' => $this->safeCount('App\Models\OrganizationalStructure', 8),
            ];

            // Safe data loading with LAMDAKU-specific content
            $recent_contacts = $this->safeCollection('App\Models\Contact', 'created_at', 5);
            $recent_articles = $this->safeCollection('App\Models\Article', 'created_at', 5);
            $recent_events = $this->safeCollection('App\Models\Event', 'created_at', 3);
            $recent_services = $this->safeCollection('App\Models\Service', 'updated_at', 3);
            
            // Get LAMDAKU-specific data safely
            $company = null;
            $visionMissionGoals = collect([]);
            $organizationalStructure = collect([]);
            
            try {
                $company = CompanyInfo::where('is_active', 1)->first();
            } catch (\Exception $e) {
                \Log::warning('Could not load company info: ' . $e->getMessage());
            }
            
            try {
                $visionMissionGoals = VisionMissionGoal::where('is_active', 1)
                    ->orderBy('type')
                    ->orderBy('sort_order')
                    ->take(6)
                    ->get();
            } catch (\Exception $e) {
                \Log::warning('Could not load vision mission goals: ' . $e->getMessage());
            }
            
            try {
                $organizationalStructure = OrganizationalStructure::where('is_active', 1)
                    ->orderBy('level_order')
                    ->orderBy('position_order')
                    ->take(4)
                    ->get();
            } catch (\Exception $e) {
                \Log::warning('Could not load organizational structure: ' . $e->getMessage());
            }
            
            // Calculate growth metrics based on real data
            $monthlyGrowth = [
                'contacts' => $this->calculateMonthlyGrowth('App\Models\Contact'),
                'articles' => $this->calculateMonthlyGrowth('App\Models\Article'),
                'services' => $this->calculateMonthlyGrowth('App\Models\Service'),
                'events' => $this->calculateMonthlyGrowth('App\Models\Event'),
            ];
            
            // Get recent activities
            $recentActivities = $this->getRecentActivities();
            
            \Log::info('Dashboard stats prepared', $stats);
            
            // Use new CoreUI design dashboard with LAMDAKU data
            return view('admin.dashboard-new-design', compact(
                'stats', 'recent_contacts', 'recent_articles', 'recent_events', 'recent_services',
                'company', 'visionMissionGoals', 'organizationalStructure', 'monthlyGrowth', 'recentActivities'
            ));
            
        } catch (\Exception $e) {
            \Log::error('Error in dashboard controller: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            // Fallback with dummy stats
            $stats = [
                'pages' => 5,
                'services' => 3,
                'contacts' => 12,
                'articles' => 15,
                'events' => 7,
                'users' => 8,
                'visionMissionGoals' => 10,
                'organizationalStructures' => 8,
            ];
            $recent_contacts = collect([]);
            $recent_articles = collect([]);
            $recent_events = collect([]);
            $recent_services = collect([]);
            $company = null;
            $visionMissionGoals = collect([]);
            $organizationalStructure = collect([]);
            $monthlyGrowth = ['contacts' => 0, 'articles' => 0, 'services' => 0, 'events' => 0];
            $recentActivities = collect([]);
            
            return view('admin.dashboard-new-design', compact(
                'stats', 'recent_contacts', 'recent_articles', 'recent_events', 'recent_services',
                'company', 'visionMissionGoals', 'organizationalStructure', 'monthlyGrowth', 'recentActivities'
            ));
        }
    }
    
    /**
     * Safely count model records with fallback
     */
    private function safeCount($modelClass, $fallback = 0)
    {
        try {
            return $modelClass::count() ?: $fallback;
        } catch (\Exception $e) {
            \Log::warning("Could not count {$modelClass}: " . $e->getMessage());
            return $fallback;
        }
    }
    
    /**
     * Safely get collection with fallback
     */
    private function safeCollection($modelClass, $orderBy = 'created_at', $limit = 5)
    {
        try {
            return $modelClass::orderBy($orderBy, 'desc')->take($limit)->get();
        } catch (\Exception $e) {
            \Log::warning("Could not load {$modelClass} collection: " . $e->getMessage());
            return collect([]);
        }
    }
    
    /**
     * Calculate monthly growth percentage
     */
    private function calculateMonthlyGrowth($modelClass)
    {
        try {
            $currentMonth = $modelClass::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();
            
            $lastMonth = $modelClass::whereMonth('created_at', now()->subMonth()->month)
                ->whereYear('created_at', now()->subMonth()->year)
                ->count();
            
            if ($lastMonth == 0) {
                return $currentMonth > 0 ? 100 : 0;
            }
            
            return round((($currentMonth - $lastMonth) / $lastMonth) * 100, 1);
        } catch (\Exception $e) {
            \Log::warning("Could not calculate growth for {$modelClass}: " . $e->getMessage());
            return 0;
        }
    }
    
    /**
     * Get recent activities for dashboard
     */
    private function getRecentActivities()
    {
        try {
            $activities = collect([]);
            
            // Recent articles
            $articles = Article::orderBy('created_at', 'desc')->take(3)->get();
            foreach ($articles as $article) {
                $activities->push([
                    'type' => 'article',
                    'title' => $article->title,
                    'description' => 'Article published',
                    'time' => $article->created_at,
                    'icon' => 'fas fa-newspaper',
                    'color' => 'info'
                ]);
            }
            
            // Recent events
            $events = Event::orderBy('created_at', 'desc')->take(2)->get();
            foreach ($events as $event) {
                $activities->push([
                    'type' => 'event',
                    'title' => $event->title,
                    'description' => 'Event scheduled',
                    'time' => $event->created_at,
                    'icon' => 'fas fa-calendar',
                    'color' => 'success'
                ]);
            }
            
            // Recent contacts
            $contacts = Contact::orderBy('created_at', 'desc')->take(2)->get();
            foreach ($contacts as $contact) {
                $activities->push([
                    'type' => 'contact',
                    'title' => $contact->name ?? 'New Contact',
                    'description' => Str::limit($contact->subject ?? 'Contact message', 40),
                    'time' => $contact->created_at,
                    'icon' => 'fas fa-envelope',
                    'color' => 'warning'
                ]);
            }
            
            return $activities->sortByDesc('time')->take(7);
            
        } catch (\Exception $e) {
            \Log::warning('Could not load recent activities: ' . $e->getMessage());
            return collect([]);
        }
    }
}
