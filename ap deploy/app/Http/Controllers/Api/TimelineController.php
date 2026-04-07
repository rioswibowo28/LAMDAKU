<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Timeline;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timelines = Timeline::active()->ordered()->get();
        return response()->json($timelines);
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
            'is_active' => 'boolean',
            'sort_order' => 'integer'
        ]);

        $timeline = Timeline::create($request->all());
        return response()->json($timeline, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $timeline = Timeline::findOrFail($id);
        return response()->json($timeline);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $timeline = Timeline::findOrFail($id);
        
        $request->validate([
            'year' => 'required|integer|min:1900|max:2100',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer'
        ]);

        $timeline->update($request->all());
        return response()->json($timeline);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $timeline = Timeline::findOrFail($id);
        $timeline->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
