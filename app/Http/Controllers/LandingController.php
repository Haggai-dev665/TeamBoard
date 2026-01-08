<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Show the landing page.
     */
    public function index()
    {
        // If user is already authenticated, redirect to dashboard
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }

        return view('landing');
    }
}
