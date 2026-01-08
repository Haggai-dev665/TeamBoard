@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stats Grid - Compact -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Employees Card -->
        <a href="{{ route('employees.index') }}" class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-[#86e7b8]/50 transition-all duration-300 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['employees'] }}</p>
                    <p class="text-sm text-gray-500">Employees</p>
                </div>
            </div>
        </a>

        <!-- Total Notices Card -->
        <a href="{{ route('notices.index') }}" class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-[#86e7b8]/50 transition-all duration-300 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center shadow-lg shadow-amber-500/20 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['notices'] }}</p>
                    <p class="text-sm text-gray-500">Notices</p>
                </div>
            </div>
        </a>

        <!-- Total Documents Card -->
        <a href="{{ route('documents.index') }}" class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-[#86e7b8]/50 transition-all duration-300 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/20 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['documents'] }}</p>
                    <p class="text-sm text-gray-500">Documents</p>
                </div>
            </div>
        </a>

        <!-- High Priority Card -->
        <a href="{{ route('notices.index') }}?priority=high" class="group relative bg-gradient-to-br from-red-50 to-white rounded-2xl border border-red-200 shadow-sm hover:shadow-lg hover:border-red-300 transition-all duration-300 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center shadow-lg shadow-red-500/20 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-red-600">{{ $stats['high_priority_notices'] }}</p>
                    <p class="text-sm text-gray-500">Urgent</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Recent Notices - Takes 2 columns -->
        <div class="xl:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-gray-100 bg-gradient-to-r from-[#86e7b8]/10 via-[#b2ffa8]/10 to-transparent">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center shadow-lg shadow-amber-500/20">
                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                </svg>
                            </div>
                            <h3 class="font-display text-lg font-bold text-gray-900">Recent Notices</h3>
                        </div>
                        <a href="{{ route('notices.index') }}" class="text-sm font-medium text-[#2d6a4f] hover:text-[#40916c] transition-colors">
                            View All →
                        </a>
                    </div>
                </div>
                <div class="p-6">
                    @if($recentNotices->isEmpty())
                        <div class="text-center py-12">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            </div>
                            <p class="text-gray-900 font-semibold mb-1">No notices available</p>
                            <p class="text-sm text-gray-500 mb-4">Create your first notice to get started</p>
                            <a href="{{ route('notices.create') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-[#2d6a4f] to-[#40916c] rounded-xl hover:shadow-lg transition-all duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Create Notice
                            </a>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($recentNotices as $index => $notice)
                                <div class="group flex items-start gap-4 p-4 rounded-xl hover:bg-gray-50 transition-all duration-200 cursor-pointer border border-transparent hover:border-gray-200" 
                                     style="animation: slideInUp 0.5s ease-out {{ $index * 0.1 }}s forwards; opacity: 0;">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-[#86e7b8] to-[#2d6a4f] flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
                                        <span class="text-sm font-bold text-white">{{ strtoupper(substr($notice->author->name ?? 'A', 0, 1)) }}</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2">
                                            <div class="flex-1">
                                                <a href="{{ route('notices.show', $notice) }}" class="font-semibold text-gray-900 hover:text-[#2d6a4f] transition-colors line-clamp-1">
                                                    {{ $notice->title }}
                                                </a>
                                                <p class="mt-1 text-sm text-gray-500 line-clamp-2">
                                                    {{ Str::limit($notice->content, 120) }}
                                                </p>
                                            </div>
                                            <span class="flex-shrink-0 inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $notice->priority === 'high' ? 'bg-red-100 text-red-700' : ($notice->priority === 'medium' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-700') }}">
                                                {{ ucfirst($notice->priority) }}
                                            </span>
                                        </div>
                                        <div class="mt-3 flex flex-wrap items-center gap-3 text-xs text-gray-400">
                                            <span class="flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                {{ $notice->author->name ?? 'Unknown' }}
                                            </span>
                                            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                            <span class="flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ $notice->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Sidebar - Quick Actions Only -->
        <div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-gray-100 bg-gradient-to-r from-[#b2ffa8]/10 to-transparent">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center shadow-lg shadow-purple-500/20">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="font-display font-bold text-gray-900">Quick Actions</h3>
                    </div>
                </div>
                <div class="p-4 space-y-3">
                    <a href="{{ route('notices.create') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gradient-to-r from-[#2d6a4f] to-[#40916c] text-white font-medium hover:shadow-lg transition-all duration-300 group">
                        <div class="w-9 h-9 rounded-lg bg-white/20 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <span>Create Notice</span>
                    </a>

                    <a href="{{ route('documents.create') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-gray-100 text-gray-900 font-medium transition-all duration-300 border border-gray-100">
                        <div class="w-9 h-9 rounded-lg bg-emerald-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                        </div>
                        <span>Upload Document</span>
                    </a>

                    <a href="{{ route('employees.create') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-gray-100 text-gray-900 font-medium transition-all duration-300 border border-gray-100">
                        <div class="w-9 h-9 rounded-lg bg-blue-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <span>Add Employee</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection