<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompanyInfoController extends Controller
{    
    public function index()
    {
        $companyInfo = DB::table('company_info')->first();
        
        // Add logo URL for display
        if ($companyInfo && $companyInfo->logo) {
            $logoPath = 'storage/logos/' . $companyInfo->logo;
            // Always set logo_url regardless of file existence for debugging
            $companyInfo->logo_url = asset($logoPath);
            
            // Check if file exists and log for debugging
            if (!file_exists(public_path($logoPath))) {
                \Log::warning("Logo file not found: " . public_path($logoPath));
            }
        }
        
        return view('admin.company.index', compact('companyInfo'));
    }

    public function create()
    {
        return view('admin.company.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120|dimensions:max_width=2000,max_height=2000',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            
            // Clean filename - remove spaces and special characters
            $originalName = $logoFile->getClientOriginalName();
            $cleanName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $originalName);
            $logoName = time() . '_' . $cleanName;
            
            // Add detailed logging for debugging
            \Log::info('Logo upload attempt:', [
                'original_name' => $originalName,
                'cleaned_name' => $cleanName,
                'generated_name' => $logoName,
                'size' => $logoFile->getSize(),
                'mime_type' => $logoFile->getMimeType(),
                'temp_path' => $logoFile->getPathname()
            ]);
            
            try {
                $stored = $logoFile->storeAs('public/logos', $logoName);
                \Log::info('Logo stored:', ['path' => $stored, 'success' => $stored !== false]);
                
                // Verify file exists after storage
                $storagePath = storage_path('app/public/logos/' . $logoName);
                $fileExists = file_exists($storagePath);
                \Log::info('File verification:', [
                    'storage_path' => $storagePath,
                    'exists' => $fileExists,
                    'size' => $fileExists ? filesize($storagePath) : 0
                ]);
                
                if ($fileExists) {
                    // Update favicon with new logo
                    $this->updateFaviconFromLogo($storagePath);
                }
                
                $data['logo'] = $logoName;
            } catch (\Exception $e) {
                \Log::error('Logo upload failed:', ['error' => $e->getMessage()]);
                $data['logo'] = null;
            }
        } else {
            $data['logo'] = null;
        }

        DB::table('company_info')->insert([
            'company_name' => $data['company_name'],
            'address' => $data['address'],
            'phone' => $data['phone'] ?? null,
            'mobile' => $data['mobile'] ?? null,
            'email' => $data['email'] ?? null,
            'website' => $data['website'] ?? null,
            'logo' => $data['logo'] ?? null,
            'description' => $data['description'] ?? null,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.company.index')->with('success', 'Informasi perusahaan berhasil ditambahkan');
    }

    public function show($id)
    {
        $companyInfo = DB::table('company_info')->where('id', $id)->first();
        
        // Add logo URL for display
        if ($companyInfo && $companyInfo->logo) {
            $logoPath = 'storage/logos/' . $companyInfo->logo;
            // Check if file exists before creating URL
            if (file_exists(public_path($logoPath))) {
                $companyInfo->logo_url = asset($logoPath);
            } else {
                $companyInfo->logo_url = null;
                // Update database to remove invalid logo reference
                DB::table('company_info')->where('id', $companyInfo->id)->update(['logo' => null]);
                $companyInfo->logo = null;
            }
        }
        
        return view('admin.company.show', compact('companyInfo'));
    }

    public function edit($id)
    {
        $companyInfo = DB::table('company_info')->where('id', $id)->first();
        
        // Add logo URL for display
        if ($companyInfo && $companyInfo->logo) {
            $logoPath = 'storage/logos/' . $companyInfo->logo;
            // Check if file exists before creating URL
            if (file_exists(public_path($logoPath))) {
                $companyInfo->logo_url = asset($logoPath);
            } else {
                $companyInfo->logo_url = null;
                // Update database to remove invalid logo reference
                DB::table('company_info')->where('id', $companyInfo->id)->update(['logo' => null]);
                $companyInfo->logo = null;
            }
        }
        
        return view('admin.company.edit', compact('companyInfo'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120|dimensions:max_width=2000,max_height=2000',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $companyInfo = DB::table('company_info')->where('id', $id)->first();
        $data = $request->all();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($companyInfo->logo) {
                Storage::delete('public/logos/' . $companyInfo->logo);
            }

            $logoFile = $request->file('logo');
            
            // Clean filename - remove spaces and special characters
            $originalName = $logoFile->getClientOriginalName();
            $cleanName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $originalName);
            $logoName = time() . '_' . $cleanName;
            
            // Add detailed logging for debugging
            \Log::info('Logo update attempt:', [
                'original_name' => $originalName,
                'cleaned_name' => $cleanName,
                'generated_name' => $logoName,
                'size' => $logoFile->getSize(),
                'mime_type' => $logoFile->getMimeType(),
                'temp_path' => $logoFile->getPathname()
            ]);
            
            try {
                $stored = $logoFile->storeAs('public/logos', $logoName);
                \Log::info('Logo stored:', ['path' => $stored, 'success' => $stored !== false]);
                
                // Verify file exists after storage
                $storagePath = storage_path('app/public/logos/' . $logoName);
                $fileExists = file_exists($storagePath);
                \Log::info('File verification:', [
                    'storage_path' => $storagePath,
                    'exists' => $fileExists,
                    'size' => $fileExists ? filesize($storagePath) : 0
                ]);
                
                if ($fileExists) {
                    // Update favicon with new logo
                    $this->updateFaviconFromLogo($storagePath);
                }
                
                $data['logo'] = $logoName;
            } catch (\Exception $e) {
                \Log::error('Logo update failed:', ['error' => $e->getMessage()]);
                $data['logo'] = $companyInfo->logo; // Keep old logo on error
            }
        } else {
            $data['logo'] = $companyInfo->logo;
        }

        DB::table('company_info')->where('id', $id)->update([
            'company_name' => $data['company_name'],
            'address' => $data['address'],
            'phone' => $data['phone'] ?? null,
            'mobile' => $data['mobile'] ?? null,
            'email' => $data['email'] ?? null,
            'website' => $data['website'] ?? null,
            'logo' => $data['logo'],
            'description' => $data['description'] ?? null,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.company.index')->with('success', 'Informasi perusahaan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $companyInfo = DB::table('company_info')->where('id', $id)->first();
        
        // Delete logo if exists
        if ($companyInfo->logo) {
            Storage::delete('public/logos/' . $companyInfo->logo);
        }

        DB::table('company_info')->where('id', $id)->delete();

        return redirect()->route('admin.company.index')->with('success', 'Informasi perusahaan berhasil dihapus');
    }

    public function setActive($id)
    {
        // Set all company info to inactive
        DB::table('company_info')->update(['is_active' => 0]);
        
        // Set selected company info to active
        DB::table('company_info')->where('id', $id)->update(['is_active' => 1]);

        return redirect()->route('admin.company.index')->with('success', 'Informasi perusahaan berhasil diaktifkan');
    }

    /**
     * Update favicon from company logo
     */
    private function updateFaviconFromLogo($logoPath)
    {
        try {
            // Update backend favicons
            $backendFaviconIco = public_path('favicon.ico');
            $backendFaviconPng = public_path('favicon.png');
            
            copy($logoPath, $backendFaviconIco);
            copy($logoPath, $backendFaviconPng);
            
            // Update frontend favicons if directory exists
            $frontendPath = 'D:\laragon\www\LAMDAKU\accreditation-company-profile\public';
            if (is_dir($frontendPath)) {
                copy($logoPath, $frontendPath . '\favicon.ico');
                copy($logoPath, $frontendPath . '\favicon.png');
            }
            
            \Log::info('Favicon updated from company logo:', ['logo_path' => $logoPath]);
            
        } catch (\Exception $e) {
            \Log::error('Failed to update favicon:', ['error' => $e->getMessage()]);
        }
    }
}
