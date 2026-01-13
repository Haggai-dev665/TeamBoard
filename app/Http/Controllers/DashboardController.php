<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Notice;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        // Check if user is super admin
        if (auth()->user()->isSuperAdmin()) {
            return $this->adminDashboard();
        }

        // Regular user dashboard
        return $this->employeeDashboard();
    }

    /**
     * Show super admin dashboard
     */
    private function adminDashboard()
    {
        $totalUsers = User::count();
        $totalEmployees = Employee::count();
        $totalNotices = Notice::count();
        $totalDocuments = Document::count();

        // Get users without employee records (excluding super admin)
        $unregisteredUsers = User::whereNotIn('email', function($query) {
            $query->select('email')->from('employees');
        })
        ->where('email', '!=', auth()->user()->email)
        ->get();

        $recentEmployees = Employee::latest()->take(5)->get();
        $recentNotices = Notice::latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalEmployees',
            'totalNotices',
            'totalDocuments',
            'unregisteredUsers',
            'recentEmployees',
            'recentNotices'
        ));
    }

    /**
     * Show employee dashboard
     */
    private function employeeDashboard()
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
