<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // If already authenticated, redirect to dashboard
        if (session('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }
        
        // Get active company information for login page branding
        $company = CompanyInfo::where('is_active', 1)->first();
        
        return view('admin.auth.login-simple', compact('company'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Try to find user by username or email
        $user = User::where(function($query) use ($request) {
            $query->where('username', $request->username)
                  ->orWhere('email', $request->username);
        })->where('is_active', true)->first();

        // Check if user exists and password is correct
        if ($user && Hash::check($request->password, $user->password)) {
            // Update last login
            $user->update(['last_login_at' => now()]);
            
            // Set session
            session([
                'admin_authenticated' => true,
                'admin_user_id' => $user->id,
                'admin_user' => $user->name,
                'admin_role' => $user->role
            ]);
            
            Log::info('User login successful', [
                'user_id' => $user->id,
                'username' => $user->username,
                'role' => $user->role,
                'login_time' => now()
            ]);
            
            return redirect()->route('admin.dashboard')->with('success', "Selamat datang, {$user->name}!");
        }

        // Fallback untuk kredensial hardcoded lama (untuk kompatibilitas)
        if ($request->username === 'admin' && $request->password === 'admin123') {
            session([
                'admin_authenticated' => true,
                'admin_user_id' => 0, // ID 0 untuk admin hardcoded
                'admin_user' => 'Administrator',
                'admin_role' => 'admin'
            ]);
            
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Administrator!');
        }

        return back()->withErrors(['credentials' => 'Username/Email atau password salah, atau akun tidak aktif.']);
    }

    public function logout(Request $request)
    {
        session()->forget(['admin_authenticated', 'admin_user_id', 'admin_user', 'admin_role']);
        return redirect('/admin/login')->with('success', 'Anda telah logout berhasil.');
    }

    /**
     * Get current authenticated admin user
     */
    public static function getCurrentUser()
    {
        $userId = session('admin_user_id');
        if ($userId && $userId > 0) {
            return User::find($userId);
        }
        return null;
    }

    /**
     * Check if current user has specific role
     */
    public static function hasRole($role)
    {
        return session('admin_role') === $role;
    }

    /**
     * Check if current user is admin
     */
    public static function isAdmin()
    {
        return session('admin_role') === 'admin';
    }
}
