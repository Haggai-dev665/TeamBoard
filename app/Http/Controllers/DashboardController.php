<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Notice;
use App\Models\Document;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $stats = [
            'employees' => Employee::count(),
            'notices' => Notice::count(),
            'documents' => Document::count(),
            'high_priority_notices' => Notice::where('priority', 'high')->count(),
        ];

        $recentNotices = Notice::with('author')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recentNotices'));
    }
}
