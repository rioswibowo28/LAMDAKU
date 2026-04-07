<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisionMissionGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisionMissionGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = VisionMissionGoal::ordered()->get();
        $groupedItems = VisionMissionGoal::getAllGrouped();
        return view('admin.vision-mission-goal.index', compact('items', 'groupedItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = VisionMissionGoal::getTypes();
        return view('admin.vision-mission-goal.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:vision,mission,goal',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'description' => 'nullable|string',
            'icon_class' => 'nullable|string|max:100',
            'background_color' => 'nullable|string|max:7',
            'sort_order' => 'integer|min:1'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        
        // Set default values
        $data['background_color'] = $data['background_color'] ?: $this->getDefaultColor($data['type']);
        $data['icon_class'] = $data['icon_class'] ?: $this->getDefaultIcon($data['type']);
        $data['sort_order'] = $data['sort_order'] ?: 1;
        $data['is_active'] = $request->has('is_active');

        VisionMissionGoal::create($data);

        return redirect()->route('admin.vision-mission-goal.index')
                        ->with('success', 'Item berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(VisionMissionGoal $visionMissionGoal)
    {
        return view('admin.vision-mission-goal.show', compact('visionMissionGoal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisionMissionGoal $visionMissionGoal)
    {
        $types = VisionMissionGoal::getTypes();
        return view('admin.vision-mission-goal.edit', compact('visionMissionGoal', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VisionMissionGoal $visionMissionGoal)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:vision,mission,goal',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'description' => 'nullable|string',
            'icon_class' => 'nullable|string|max:100',
            'background_color' => 'nullable|string|max:7',
            'sort_order' => 'integer|min:1'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        
        // Set default values
        $data['background_color'] = $data['background_color'] ?: $this->getDefaultColor($data['type']);
        $data['icon_class'] = $data['icon_class'] ?: $this->getDefaultIcon($data['type']);
        $data['sort_order'] = $data['sort_order'] ?: 1;
        $data['is_active'] = $request->has('is_active');

        $visionMissionGoal->update($data);

        return redirect()->route('admin.vision-mission-goal.index')
                        ->with('success', 'Item berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisionMissionGoal $visionMissionGoal)
    {
        $visionMissionGoal->delete();

        return redirect()->route('admin.vision-mission-goal.index')
                        ->with('success', 'Item berhasil dihapus');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(VisionMissionGoal $visionMissionGoal)
    {
        $visionMissionGoal->update([
            'is_active' => !$visionMissionGoal->is_active
        ]);

        $status = $visionMissionGoal->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->back()
                        ->with('success', "Item berhasil {$status}");
    }

    /**
     * Get default color based on type
     */
    private function getDefaultColor($type)
    {
        return match($type) {
            'vision' => '#4285f4',
            'mission' => '#34a853',
            'goal' => '#fbbc04',
            default => '#e3f2fd'
        };
    }

    /**
     * Get default icon based on type
     */
    private function getDefaultIcon($type)
    {
        return match($type) {
            'vision' => 'fas fa-eye',
            'mission' => 'fas fa-check-circle',
            'goal' => 'fas fa-bullseye',
            default => 'fas fa-info-circle'
        };
    }
}
