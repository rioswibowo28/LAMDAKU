<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisionMissionGoal;
use Illuminate\Http\Request;

class VisionMissionGoalController extends Controller
{
    /**
     * Display a listing of all active items grouped by type
     */
    public function index()
    {
        try {
            $groupedItems = VisionMissionGoal::getAllGrouped();
            
            return response()->json([
                'success' => true,
                'data' => $groupedItems,
                'total' => VisionMissionGoal::active()->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch vision, mission, and goals',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all items as flat list
     */
    public function list()
    {
        try {
            $items = VisionMissionGoal::active()->ordered()->get();
            
            return response()->json([
                'success' => true,
                'data' => $items
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch items list',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get items by specific type (vision, mission, goal)
     */
    public function byType($type)
    {
        try {
            if (!in_array($type, ['vision', 'mission', 'goal'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid type. Must be: vision, mission, or goal'
                ], 400);
            }

            $items = VisionMissionGoal::active()
                    ->byType($type)
                    ->ordered()
                    ->get();
            
            return response()->json([
                'success' => true,
                'type' => $type,
                'data' => $items,
                'count' => $items->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Failed to fetch {$type} items",
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get vision items
     */
    public function vision()
    {
        try {
            $vision = VisionMissionGoal::getVision();
            
            return response()->json([
                'success' => true,
                'data' => $vision,
                'count' => $vision->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch vision',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get mission items
     */
    public function mission()
    {
        try {
            $missions = VisionMissionGoal::getMissions();
            
            return response()->json([
                'success' => true,
                'data' => $missions,
                'count' => $missions->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch missions',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get goal items
     */
    public function goals()
    {
        try {
            $goals = VisionMissionGoal::getGoals();
            
            return response()->json([
                'success' => true,
                'data' => $goals,
                'count' => $goals->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch goals',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $item = VisionMissionGoal::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $item
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
