<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganizationalStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrganizationalStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structures = OrganizationalStructure::ordered()->get();
        $groupedStructures = OrganizationalStructure::getByLevels();
        return view('admin.organizational-structure.index', compact('structures', 'groupedStructures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = OrganizationalStructure::getLevels();
        return view('admin.organizational-structure.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level_order' => 'required|integer|min:1',
            'position_order' => 'integer|min:1',
            'background_color' => 'nullable|string|max:7',
            'icon_class' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('organizational_structure/photos', $photoName, 'public');
            $data['photo'] = $photoPath;
        }
        
        // Set default values
        $data['background_color'] = $data['background_color'] ?: '#e3f2fd';
        $data['icon_class'] = $data['icon_class'] ?: 'fas fa-user';
        $data['position_order'] = $data['position_order'] ?: 1;
        $data['is_active'] = $request->has('is_active');

        OrganizationalStructure::create($data);

        return redirect()->route('admin.organizational-structure.index')
                        ->with('success', 'Struktur organisasi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(OrganizationalStructure $organizationalStructure)
    {
        return view('admin.organizational-structure.show', compact('organizationalStructure'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrganizationalStructure $organizationalStructure)
    {
        $levels = OrganizationalStructure::getLevels();
        return view('admin.organizational-structure.edit', compact('organizationalStructure', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrganizationalStructure $organizationalStructure)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level_order' => 'required|integer|min:1',
            'position_order' => 'integer|min:1',
            'background_color' => 'nullable|string|max:7',
            'icon_class' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($organizationalStructure->photo) {
                \Storage::disk('public')->delete($organizationalStructure->photo);
            }
            
            $photo = $request->file('photo');
            $photoName = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('organizational_structure/photos', $photoName, 'public');
            $data['photo'] = $photoPath;
        }
        
        // Set default values
        $data['background_color'] = $data['background_color'] ?: '#e3f2fd';
        $data['icon_class'] = $data['icon_class'] ?: 'fas fa-user';
        $data['position_order'] = $data['position_order'] ?: 1;
        $data['is_active'] = $request->has('is_active');

        $organizationalStructure->update($data);

        return redirect()->route('admin.organizational-structure.index')
                        ->with('success', 'Struktur organisasi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrganizationalStructure $organizationalStructure)
    {
        // Delete photo if exists
        if ($organizationalStructure->photo) {
            \Storage::disk('public')->delete($organizationalStructure->photo);
        }
        
        $organizationalStructure->delete();

        return redirect()->route('admin.organizational-structure.index')
                        ->with('success', 'Struktur organisasi berhasil dihapus');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(OrganizationalStructure $organizationalStructure)
    {
        $organizationalStructure->update([
            'is_active' => !$organizationalStructure->is_active
        ]);

        $status = $organizationalStructure->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->back()
                        ->with('success', "Struktur organisasi berhasil {$status}");
    }
}
