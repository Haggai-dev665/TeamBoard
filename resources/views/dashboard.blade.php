@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h1 class="text-3xl font-bold text-foreground">Dashboard</h1>
        <p class="mt-2 text-muted-foreground">Welcome back, {{ auth()->user()->name }}!</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Employees -->
        <x-card>
            <x-card-header>
                <x-card-description>Total Employees</x-card-description>
                <x-card-title class="text-3xl">{{ $stats['employees'] }}</x-card-title>
            </x-card-header>
        </x-card>

        <!-- Total Notices -->
        <x-card>
            <x-card-header>
                <x-card-description>Total Notices</x-card-description>
                <x-card-title class="text-3xl">{{ $stats['notices'] }}</x-card-title>
            </x-card-header>
        </x-card>

        <!-- Total Documents -->
        <x-card>
            <x-card-header>
                <x-card-description>Total Documents</x-card-description>
                <x-card-title class="text-3xl">{{ $stats['documents'] }}</x-card-title>
            </x-card-header>
        </x-card>

        <!-- High Priority Notices -->
        <x-card>
            <x-card-header>
                <x-card-description>High Priority</x-card-description>
                <x-card-title class="text-3xl text-destructive">{{ $stats['high_priority_notices'] }}</x-card-title>
            </x-card-header>
        </x-card>
    </div>

    <!-- Recent Notices -->
    <x-card>
        <x-card-header>
            <div class="flex items-center justify-between">
                <div>
                    <x-card-title>Recent Notices</x-card-title>
                    <x-card-description>Latest announcements and updates</x-card-description>
                </div>
                <x-button href="{{ route('notices.index') }}" variant="outline" size="sm">
                    View All
                </x-button>
            </div>
        </x-card-header>
        <x-card-content>
            @if($recentNotices->isEmpty())
                <p class="text-muted-foreground">No notices available.</p>
            @else
                <div class="space-y-4">
                    @foreach($recentNotices as $notice)
                        <div class="flex items-start justify-between border-b border-border pb-4 last:border-0 last:pb-0">
                            <div class="flex-1">
                                <a href="{{ route('notices.show', $notice) }}" class="font-medium text-foreground hover:text-primary">
                                    {{ $notice->title }}
                                </a>
                                <p class="mt-1 text-sm text-muted-foreground line-clamp-2">
                                    {{ Str::limit($notice->content, 100) }}
                                </p>
                                <div class="mt-2 flex items-center gap-2 text-xs text-muted-foreground">
                                    <span>By {{ $notice->author->name }}</span>
                                    <span>•</span>
                                    <span>{{ $notice->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <span class="ml-4 inline-flex items-center rounded-full px-2 py-1 text-xs font-medium {{ $notice->priority_color }}">
                                {{ ucfirst($notice->priority) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </x-card-content>
    </x-card>

    <!-- Quick Actions -->
    <x-card>
        <x-card-header>
            <x-card-title>Quick Actions</x-card-title>
            <x-card-description>Common tasks and shortcuts</x-card-description>
        </x-card-header>
        <x-card-content>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <x-button href="{{ route('notices.create') }}" class="w-full">
                    Create Notice
                </x-button>
                <x-button href="{{ route('documents.create') }}" variant="secondary" class="w-full">
                    Upload Document
                </x-button>
                <x-button href="{{ route('employees.index') }}" variant="outline" class="w-full">
                    View Employees
                </x-button>
            </div>
        </x-card-content>
    </x-card>
</div>
@endsection
