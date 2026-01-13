@extends('layouts.app')

@section('title', 'All Feedback')

@section('content')
<div class="space-y-8">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-primary via-accent to-primary bg-clip-text text-transparent">
                Feedback Overview
            </h1>
            <p class="mt-2 text-lg text-muted-foreground">All employee feedback on notices and documents</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-card class="border-l-4 border-green-500">
            <x-card-content class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-muted-foreground">Acknowledged</p>
                        <p class="text-3xl font-bold text-foreground mt-2">{{ $stats['acknowledge'] ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
            </x-card-content>
        </x-card>

        <x-card class="border-l-4 border-red-500">
            <x-card-content class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-muted-foreground">Disagreed</p>
                        <p class="text-3xl font-bold text-foreground mt-2">{{ $stats['disagree'] ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-red-100 rounded-full">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                </div>
            </x-card-content>
        </x-card>

        <x-card class="border-l-4 border-amber-500">
            <x-card-content class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-muted-foreground">Concerns</p>
                        <p class="text-3xl font-bold text-foreground mt-2">{{ $stats['concern'] ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-amber-100 rounded-full">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </div>
            </x-card-content>
        </x-card>

        <x-card class="border-l-4 border-blue-500">
            <x-card-content class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-muted-foreground">Total</p>
                        <p class="text-3xl font-bold text-foreground mt-2">{{ $feedbackList->total() }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                </div>
            </x-card-content>
        </x-card>
    </div>

    <!-- Filter Tabs -->
    <x-card>
        <x-card-content class="p-6">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('feedback.index') }}" 
                   class="px-4 py-2 rounded-lg font-medium transition-colors {{ !request('type') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    All Feedback
                </a>
                <a href="{{ route('feedback.index', ['type' => 'acknowledge']) }}" 
                   class="px-4 py-2 rounded-lg font-medium transition-colors {{ request('type') == 'acknowledge' ? 'bg-green-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Acknowledged
                </a>
                <a href="{{ route('feedback.index', ['type' => 'disagree']) }}" 
                   class="px-4 py-2 rounded-lg font-medium transition-colors {{ request('type') == 'disagree' ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Disagreed
                </a>
                <a href="{{ route('feedback.index', ['type' => 'concern']) }}" 
                   class="px-4 py-2 rounded-lg font-medium transition-colors {{ request('type') == 'concern' ? 'bg-amber-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Concerns
                </a>
            </div>
        </x-card-content>
    </x-card>

    <!-- Feedback List -->
    @if($feedbackList->isEmpty())
        <x-card>
            <x-card-content class="p-12 text-center">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-muted/50 flex items-center justify-center">
                    <svg class="w-10 h-10 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                </div>
                <p class="text-lg font-medium text-foreground">No feedback found</p>
                <p class="mt-1 text-muted-foreground">Employee feedback will appear here</p>
            </x-card-content>
        </x-card>
    @else
        <div class="space-y-4">
            @foreach($feedbackList as $feedback)
                <x-card class="border-l-4 {{ $feedback->type == 'concern' ? 'border-amber-500 bg-amber-50/50' : ($feedback->type == 'disagree' ? 'border-red-500' : 'border-green-500') }}">
                    <x-card-content class="p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <!-- Header -->
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary/20 to-accent/20 flex items-center justify-center text-sm font-medium text-primary">
                                        {{ strtoupper(substr($feedback->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-foreground">{{ $feedback->user->name }}</p>
                                        <p class="text-sm text-muted-foreground">{{ $feedback->user->email }}</p>
                                    </div>
                                    <div class="ml-auto">
                                        @if($feedback->type == 'acknowledge')
                                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Acknowledged
                                            </span>
                                        @elseif($feedback->type == 'disagree')
                                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                                Disagreed
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-sm font-medium">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                </svg>
                                                Concern
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Content Info -->
                                <div class="bg-white rounded-lg p-4 mb-3 border border-gray-200">
                                    <div class="flex items-center gap-2 mb-2">
                                        @if($feedback->feedbackable_type == 'App\\Models\\Notice')
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                            </svg>
                                            <span class="text-sm font-medium text-gray-500">Notice:</span>
                                        @else
                                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <span class="text-sm font-medium text-gray-500">Document:</span>
                                        @endif
                                        <span class="font-semibold text-foreground">{{ $feedback->feedbackable->title }}</span>
                                    </div>
                                </div>

                                <!-- Message (for concerns) -->
                                @if($feedback->message)
                                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-3">
                                        <p class="text-sm font-medium text-amber-900 mb-2">Concern Details:</p>
                                        <p class="text-gray-700 whitespace-pre-wrap">{{ $feedback->message }}</p>
                                    </div>
                                @endif

                                <!-- Attachment -->
                                @if($feedback->attachment)
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                        </svg>
                                        <a href="{{ asset('storage/' . $feedback->attachment) }}" target="_blank" 
                                           class="text-sm text-primary hover:underline">
                                            View Attachment
                                        </a>
                                    </div>
                                @endif

                                <!-- Timestamp -->
                                <div class="mt-3 text-xs text-muted-foreground">
                                    {{ $feedback->created_at->diffForHumans() }} • {{ $feedback->created_at->format('M d, Y g:i A') }}
                                </div>
                            </div>
                        </div>
                    </x-card-content>
                </x-card>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $feedbackList->links() }}
        </div>
    @endif
</div>
@endsection
