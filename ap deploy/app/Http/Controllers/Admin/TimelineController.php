<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timelines = Timeline::orderBy('year', 'desc')->get();
        return view('admin.timelines.index', compact('timelines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.timelines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|min:1900|max:2100',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'sort_order' => 'integer'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        Timeline::create($data);

        return redirect()->route('admin.timelines.index')
            ->with('success', 'Timeline created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Timeline $timeline)
    {
        return view('admin.timelines.show', compact('timeline'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Timeline $timeline)
    {
        return view('admin.timelines.edit', compact('timeline'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Timeline $timeline)
    {
        $request->validate([
            'year' => 'required|integer|min:1900|max:2100',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'sort_order' => 'integer'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $timeline->update($data);

        return redirect()->route('admin.timelines.index')
            ->with('success', 'Timeline updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timeline $timeline)
    {
        $timeline->delete();

        return redirect()->route('admin.timelines.index')
            ->with('success', 'Timeline deleted successfully.');
    }
}
