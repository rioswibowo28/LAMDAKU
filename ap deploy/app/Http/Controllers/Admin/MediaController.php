<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $file = $request->file('file');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('media/uploads', $filename, 'public');
            
            return response()->json([
                'success' => true,
                'url' => asset('storage/' . $path),
                'path' => $path,
                'filename' => $filename,
                'original_name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function browse()
    {
        try {
            $files = Storage::disk('public')->files('media/uploads');
            $mediaFiles = [];

            foreach ($files as $file) {
                $fullPath = Storage::disk('public')->path($file);
                if (file_exists($fullPath)) {
                    $mediaFiles[] = [
                        'name' => basename($file),
                        'url' => asset('storage/' . $file),
                        'path' => $file,
                        'size' => filesize($fullPath),
                        'modified' => filemtime($fullPath),
                        'type' => pathinfo($file, PATHINFO_EXTENSION),
                    ];
                }
            }

            // Sort by modified time, newest first
            usort($mediaFiles, function($a, $b) {
                return $b['modified'] - $a['modified'];
            });

            return response()->json([
                'success' => true,
                'files' => $mediaFiles,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to browse media: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
        ]);

        try {
            $path = $request->input('path');
            
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
                
                return response()->json([
                    'success' => true,
                    'message' => 'File deleted successfully',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'File not found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Delete failed: ' . $e->getMessage(),
            ], 500);
        }
    }
}
