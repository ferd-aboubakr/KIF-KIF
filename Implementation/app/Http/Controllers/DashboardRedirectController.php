<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardRedirectController extends Controller
{
    public function redirect(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('particulier')) {
                return redirect()->route('particulier.dashboard');
            } elseif ($user->hasRole('entreprise')) {
                return redirect()->route('entreprise.dashboard');
            }
        }
        
        return redirect()->route('login');
    }
}
