<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    /**
     * Handle file upload for services, timelines, etc.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'required|string|in:service,timeline,page'
        ]);

        try {
            $file = $request->file('file');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads/' . $request->type, $fileName, 'public');
            
            return response()->json([
                'success' => true,
                'file_path' => Storage::url($filePath),
                'file_url' => asset('storage/' . $filePath),
                'message' => 'File uploaded successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload file: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete uploaded file
     */
    public function delete(Request $request)
    {
        $request->validate([
            'file_path' => 'required|string'
        ]);

        try {
            // Extract the storage path from the URL
            $filePath = str_replace('/storage/', '', $request->file_path);
            
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
                return response()->json([
                    'success' => true,
                    'message' => 'File deleted successfully'
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'File not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete file: ' . $e->getMessage()
            ], 500);
        }
    }
}
