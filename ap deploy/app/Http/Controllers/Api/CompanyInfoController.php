<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyInfoController extends Controller
{
    public function getCompanyInfo()
    {
        try {
            $companyInfo = DB::table('company_info')->where('is_active', true)->first();
            
            if (!$companyInfo) {
                return response()->json([
                    'success' => false,
                    'message' => 'Informasi perusahaan tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $companyInfo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getContactInfo()
    {
        try {
            $companyInfo = DB::table('company_info')->where('is_active', true)->first();
            
            if (!$companyInfo) {
                return response()->json([
                    'success' => false,
                    'message' => 'Informasi kontak tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'phone' => $companyInfo->phone,
                    'mobile' => $companyInfo->mobile,
                    'email' => $companyInfo->email,
                    'address' => $companyInfo->address
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getLogo()
    {
        try {
            $companyInfo = DB::table('company_info')->where('is_active', true)->first();
            
            if (!$companyInfo || !$companyInfo->logo) {
                return response()->json([
                    'success' => false,
                    'message' => 'Logo tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'logo_url' => asset('storage/logos/' . $companyInfo->logo),
                    'logo_filename' => $companyInfo->logo
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
