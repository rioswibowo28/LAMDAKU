<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::active()->ordered()->get();
        return response()->json($services);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:services,slug',
            'description' => 'required|string',
            'content' => 'required|string',
            'icon' => 'nullable|string',
            'image' => 'nullable|string',
            'price' => 'nullable|numeric',
            'is_active' => 'boolean',
            'sort_order' => 'integer'
        ]);

        $service = Service::create($request->all());
        return response()->json($service, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:services,slug,' . $id,
            'description' => 'required|string',
            'content' => 'required|string',
            'icon' => 'nullable|string',
            'image' => 'nullable|string',
            'price' => 'nullable|numeric',
            'is_active' => 'boolean',
            'sort_order' => 'integer'
        ]);

        $service->update($request->all());
        return response()->json($service);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
