<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrganizationalStructure;
use Illuminate\Http\Request;

class OrganizationalStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     * Get all active organizational structures grouped by level
     */
    public function index()
    {
        try {
            $structures = OrganizationalStructure::getByLevels();
            
            return response()->json([
                'success' => true,
                'data' => $structures,
                'total' => OrganizationalStructure::active()->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch organizational structure',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get organizational structure as flat list
     */
    public function list()
    {
        try {
            $structures = OrganizationalStructure::active()
                         ->ordered()
                         ->get();
            
            return response()->json([
                'success' => true,
                'data' => $structures
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch organizational structure list',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get structures by specific level
     */
    public function byLevel($level)
    {
        try {
            $structures = OrganizationalStructure::active()
                         ->byLevel($level)
                         ->orderBy('position_order')
                         ->get();
            
            return response()->json([
                'success' => true,
                'level' => (int)$level,
                'data' => $structures,
                'count' => $structures->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch structures for level ' . $level,
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
            $structure = OrganizationalStructure::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $structure
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Organizational structure not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Get organizational chart data formatted for frontend display
     */
    public function chart()
    {
        try {
            $groupedStructures = OrganizationalStructure::getByLevels();
            
            // Format data for organizational chart
            $chartData = [];
            foreach ($groupedStructures as $level => $structures) {
                $chartData[] = [
                    'level' => $level,
                    'positions' => $structures->map(function ($structure) {
                        return [
                            'id' => $structure->id,
                            'name' => $structure->name,
                            'position' => $structure->position,
                            'description' => $structure->description,
                            'background_color' => $structure->background_color,
                            'icon_class' => $structure->icon_class,
                            'position_order' => $structure->position_order
                        ];
                    })
                ];
            }
            
            return response()->json([
                'success' => true,
                'data' => $chartData,
                'levels_count' => count($chartData)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate organizational chart data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
