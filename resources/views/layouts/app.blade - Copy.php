<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TeamBoard') }} - @yield('title', 'Dashboard')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/assets/logo.png?v=1">
    <link rel="shortcut icon" type="image/png" href="/assets/logo.png?v=1">
    <link rel="apple-touch-icon" href="/assets/logo.png?v=1">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Lottie Player -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!-- Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .font-display { font-family: 'Space Grotesk', sans-serif; }
        .font-body { font-family: 'Raleway', sans-serif; }
        
        /* Animated gradient background */
        .dashboard-gradient {
            background: linear-gradient(135deg, #f8fffe 0%, #f0fff4 50%, #f5fffa 100%);
        }
        
        /* Sidebar gradient */
        .sidebar-gradient {
            background: linear-gradient(180deg, #ffffff 0%, #f8fffc 100%);
        }
        
        /* Floating animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .animate-float { animation: float 6s ease-in-out infinite; }
        
        /* Slide animations */
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes slideInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .animate-slide-left { animation: slideInLeft 0.5s ease-out forwards; }
        .animate-slide-up { animation: slideInUp 0.5s ease-out forwards; }
        .animate-slide-right { animation: slideInRight 0.5s ease-out forwards; }
        
        /* Stagger delays */
        .delay-100 { animation-delay: 0.1s; opacity: 0; }
        .delay-200 { animation-delay: 0.2s; opacity: 0; }
        .delay-300 { animation-delay: 0.3s; opacity: 0; }
        .delay-400 { animation-delay: 0.4s; opacity: 0; }
        .delay-500 { animation-delay: 0.5s; opacity: 0; }
        
        /* Glow effects */
        .glow-primary {
            box-shadow: 0 0 20px rgba(134, 231, 184, 0.3);
        }
        
        .glow-primary-hover:hover {
            box-shadow: 0 0 30px rgba(134, 231, 184, 0.5);
        }
        
        /* Card hover effects */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -15px rgba(134, 231, 184, 0.3);
        }
        
        /* Sidebar link styles */
        .sidebar-nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            border-radius: 0.75rem;
            font-weight: 500;
            color: #4b5563;
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }
        
        .sidebar-nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 0;
            background: linear-gradient(180deg, #86e7b8 0%, #2d6a4f 100%);
            border-radius: 0 4px 4px 0;
            transition: height 0.2s ease;
        }
        
        .sidebar-nav-link:hover {
            background: linear-gradient(90deg, rgba(134, 231, 184, 0.1) 0%, transparent 100%);
            color: #1b4332;
        }
        
        .sidebar-nav-link:hover::before {
            height: 60%;
        }
        
        .sidebar-nav-link.active {
            background: linear-gradient(90deg, rgba(134, 231, 184, 0.2) 0%, rgba(134, 231, 184, 0.05) 100%);
            color: #1b4332;
            font-weight: 600;
        }
        
        .sidebar-nav-link.active::before {
            height: 70%;
        }
        
        .sidebar-nav-link svg {
            transition: transform 0.2s ease;
        }
        
        .sidebar-nav-link:hover svg {
            transform: scale(1.1);
        }
        
        /* Pulse animation */
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(134, 231, 184, 0.4); }
            50% { box-shadow: 0 0 0 10px rgba(134, 231, 184, 0); }
        }
        
        .animate-pulse-glow {
            animation: pulse-glow 2s infinite;
        }
        
        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #1b4332 0%, #2d6a4f 50%, #40916c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Shimmer effect */
        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        
        .shimmer {
            background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.4) 50%, transparent 100%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }
        
        /* Mobile menu animation */
        @keyframes mobileMenuIn {
            from { opacity: 0; transform: translateX(-100%); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .mobile-menu-enter {
            animation: mobileMenuIn 0.3s ease-out forwards;
        }
        
        /* Notification badge */
        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 18px;
            height: 18px;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 700;
            color: white;
            border: 2px solid white;
            animation: pulse-glow 2s infinite;
        }
        
        /* Scrollbar styling */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 3px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>
</head>
<body class="font-body antialiased dashboard-gradient">
    <div class="min-h-screen flex">
        <!-- Sidebar Overlay (Mobile) -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity cursor-pointer" onclick="toggleSidebar()"></div>
        
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-72 sidebar-gradient border-r border-gray-100 transform -translate-x-full lg:translate-x-0 lg:static lg:inset-auto transition-transform duration-300 ease-in-out flex flex-col shadow-xl lg:shadow-none">
            <!-- Logo -->
            <div class="h-20 flex items-center justify-between px-6 border-b border-gray-100">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <img src="/assets/logo.png" alt="TeamBoard Logo" class="w-12 h-12 object-contain rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-105">
                    <div>
                        <span class="font-display text-xl font-bold gradient-text">TeamBoard</span>
                        <p class="text-xs text-gray-400">Management Hub</p>
                    </div>
                </a>
                <!-- Close button for mobile -->
                <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto custom-scrollbar">
                <p class="px-3 mb-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Main Menu</p>
                
                <a href="{{ route('dashboard') }}" class="sidebar-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('employees.index') }}" class="sidebar-nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <span>Employees</span>
                </a>
                
                <a href="{{ route('notices.index') }}" class="sidebar-nav-link {{ request()->routeIs('notices.*') ? 'active' : '' }}">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-amber-100 to-amber-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                    </div>
                    <span>Notices</span>
                </a>
                
                <a href="{{ route('documents.index') }}" class="sidebar-nav-link {{ request()->routeIs('documents.*') ? 'active' : '' }}">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <span>Documents</span>
                </a>
                
                <!-- Settings for all users -->
                <div class="pt-6 mt-6 border-t border-gray-100">
                    <a href="{{ route('settings.index') }}" class="sidebar-nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <span>Settings</span>
                    </a>
                </div>
            </nav>
            
            <!-- User Section -->
            @auth
            <div class="p-4 border-t border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-full flex items-center gap-3 p-3 rounded-xl hover:bg-white hover:shadow-md transition-all duration-200 group">
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-[#86e7b8] to-[#2d6a4f] flex items-center justify-center text-white font-bold text-lg shadow-md group-hover:shadow-lg transition-shadow">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 text-left">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                         @click.away="open = false" 
                         class="absolute bottom-full left-0 right-0 mb-2 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span>Log Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endauth
        </aside>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen lg:ml-0">
            <!-- Top Navbar -->
            <header class="h-20 bg-white/80 backdrop-blur-xl border-b border-gray-100 sticky top-0 z-30 shadow-sm">
                <div class="h-full px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-4">
                    <!-- Mobile Menu Button -->
                    <button onclick="toggleSidebar()" class="lg:hidden p-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 transition-colors">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    
                    <!-- Page Title & Breadcrumb -->
                    <div class="hidden lg:flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#86e7b8]/20 to-[#2d6a4f]/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-[#2d6a4f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="font-display text-lg font-bold text-gray-900">@yield('title', 'Dashboard')</h1>
                            <p class="text-xs text-gray-500">Welcome back, {{ auth()->user()->name ?? 'User' }}</p>
                        </div>
                    </div>
                    
                    <!-- Search Bar -->
                    <div class="flex-1 max-w-xl mx-4 hidden md:block">
                        <div class="relative group">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 group-focus-within:text-[#2d6a4f] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" placeholder="Search employees, notices, documents..." 
                                class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:border-[#86e7b8] focus:ring-4 focus:ring-[#86e7b8]/10 focus:outline-none transition-all duration-300 text-sm">
                            <kbd class="absolute right-4 top-1/2 -translate-y-1/2 hidden lg:inline-flex items-center gap-1 px-2 py-1 text-xs text-gray-400 bg-gray-100 rounded-md border border-gray-200">
                                <span>⌘</span><span>K</span>
                            </kbd>
                        </div>
                    </div>
                    
                    <!-- Right Actions -->
                    <div class="flex items-center gap-2 sm:gap-3">
                        <!-- Mobile Search -->
                        <button class="md:hidden p-2.5 rounded-xl hover:bg-gray-100 transition-colors">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                        
                        <!-- Notifications -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="relative p-2.5 rounded-xl hover:bg-gray-100 transition-all duration-200 group">
                                <svg class="w-6 h-6 text-gray-600 group-hover:text-gray-900 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                @php
                                    $unreadCount = auth()->user()->unreadNotificationsCount();
                                @endphp
                                @if($unreadCount > 0)
                                    <span class="notification-badge">{{ $unreadCount }}</span>
                                @endif
                            </button>

                            <!-- Notifications Dropdown -->
                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                                 @click.away="open = false"
                                 class="absolute right-0 mt-2 w-96 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden">
                                <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
                                    <h3 class="font-semibold text-gray-900">Notifications</h3>
                                    @if($unreadCount > 0)
                                        <form action="{{ route('notifications.mark-all-read') }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-xs text-primary hover:text-primary/80 font-medium">Mark all read</button>
                                        </form>
                                    @endif
                                </div>
                                <div class="max-h-96 overflow-y-auto">
                                    @forelse(auth()->user()->notifications()->take(10)->get() as $notification)
                                        <a href="{{ $notification->link ?? '#' }}" 
                                           onclick="event.preventDefault(); markAsRead({{ $notification->id }}, '{{ $notification->link ?? '#' }}')"
                                           class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 transition-colors {{ $notification->read ? 'opacity-60' : 'bg-blue-50/30' }} border-b border-gray-50 last:border-b-0">
                                            <div class="text-2xl mt-1">{{ $notification->icon }}</div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 mb-1">{{ $notification->title }}</p>
                                                <p class="text-xs text-gray-600 line-clamp-2">{{ $notification->message }}</p>
                                                <p class="text-xs text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                            </div>
                                            @if(!$notification->read)
                                                <div class="w-2 h-2 rounded-full bg-primary mt-2"></div>
                                            @endif
                                        </a>
                                    @empty
                                        <div class="px-4 py-8 text-center text-gray-500">
                                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                            </svg>
                                            <p class="text-sm">No notifications yet</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        
                        <!-- Quick Add -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#2d6a4f] to-[#40916c] text-white font-medium hover:shadow-lg hover:shadow-[#86e7b8]/30 hover:-translate-y-0.5 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span class="hidden sm:inline">Create</span>
                            </button>
                            
                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                                 @click.away="open = false"
                                 class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden py-2">
                                <a href="{{ route('notices.create') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-[#86e7b8]/10 transition-colors">
                                    <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium">New Notice</span>
                                </a>
                                <a href="{{ route('documents.create') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-[#86e7b8]/10 transition-colors">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Upload Document</span>
                                </a>
                                @auth
                                    @if(auth()->user()->isAdmin())
                                        <div class="border-t border-gray-100 my-2"></div>
                                        <a href="{{ route('employees.create') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-[#86e7b8]/10 transition-colors">
                                            <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                                </svg>
                                            </div>
                                            <span class="font-medium">Add Employee</span>
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @if(session('success'))
                    <div data-success-message class="mb-6 rounded-xl bg-[#86e7b8]/20 border border-[#86e7b8]/30 p-4 animate-slide-up" onclick="triggerConfetti()">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-[#86e7b8]/30 flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#2d6a4f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-[#1b4332]">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4 animate-slide-up">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
            
            <!-- Footer -->
            <footer class="py-6 px-6 border-t border-gray-100 bg-white/50 backdrop-blur-sm">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-gray-500">
                        &copy; {{ date('Y') }} TeamBoard. Built with <span class="text-red-500">♥</span> for teams.
                    </p>
                    <div class="flex items-center gap-4">
                        <a href="#" class="text-sm text-gray-500 hover:text-[#2d6a4f] transition-colors">Privacy</a>
                        <a href="#" class="text-sm text-gray-500 hover:text-[#2d6a4f] transition-colors">Terms</a>
                        <a href="#" class="text-sm text-gray-500 hover:text-[#2d6a4f] transition-colors">Support</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>
        // Toggle sidebar for mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0', 'mobile-menu-enter');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0', 'mobile-menu-enter');
                overlay.classList.add('hidden');
            }
        }
        
        // Confetti animation
        function triggerConfetti() {
            confetti({
                particleCount: 100,
                spread: 70,
                origin: { y: 0.6 },
                colors: ['#86e7b8', '#b2ffa8', '#d0ffb7', '#2d6a4f', '#40916c']
            });
        }
        
        // Mark notification as read
        function markAsRead(notificationId, link) {
            fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(() => {
                if (link && link !== '#') {
                    window.location.href = link;
                } else {
                    window.location.reload();
                }
            });
        }
        
        // Auto-trigger confetti on success message
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.querySelector('[data-success-message]');
            if (successMessage) {
                setTimeout(triggerConfetti, 300);
            }
        });
    </script>
</body>
</html>