@extends('layouts.app')

@section('title', 'Notices')

@section('content')
<div class="space-y-8">
    <!-- Page Header with Animation -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 animate-fade-in">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-primary via-accent to-primary bg-clip-text text-transparent">
                Notice Board
            </h1>
            <p class="mt-2 text-lg text-muted-foreground">Company announcements and updates</p>
        </div>
        <x-button href="{{ route('notices.create') }}" class="gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create Notice
        </x-button>
    </div>

    <!-- Filters -->
    <x-card class="animate-slide-in">
        <x-card-content class="p-6">
            <form method="GET" action="{{ route('notices.index') }}" class="flex flex-col gap-4 lg:flex-row lg:items-end">
                <div class="flex-1 space-y-2">
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="search">Search</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" id="search" placeholder="Search notices..." value="{{ request('search') }}"
                            class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 pl-10">
                    </div>
                </div>
                
                <div class="space-y-2 lg:w-48">
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="priority">Priority</label>
                    <select name="priority" id="priority" class="flex h-9 w-full items-center justify-between whitespace-nowrap rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-1 focus:ring-ring disabled:cursor-not-allowed disabled:opacity-50 [&>span]:line-clamp-1">
                        <option value="">All Priorities</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>🟢 Low</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>🔴 High</option>
                    </select>
                </div>

                <div class="flex gap-2">
                    <x-button type="submit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Search
                    </x-button>
                    
                    @if(request('search') || request('priority'))
                        <x-button href="{{ route('notices.index') }}" variant="outline">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Clear
                        </x-button>
                    @endif
                </div>
            </form>
        </x-card-content>
    </x-card>

    <!-- Notices List -->
    @if($notices->isEmpty())
        <x-card class="animate-fade-in">
            <x-card-content class="p-12 text-center">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-muted/50 flex items-center justify-center">
                    <svg class="w-10 h-10 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </div>
                <p class="text-lg font-medium text-foreground">No notices found</p>
                <p class="mt-1 text-muted-foreground">Try adjusting your search or create a new notice</p>
            </x-card-content>
        </x-card>
    @else
        <div class="space-y-4 stagger-animate">
            @foreach($notices as $notice)
                <x-card hover class="group cursor-pointer" onclick="window.location='{{ route('notices.show', $notice) }}'">
                    <x-card-content class="p-6">
                        <div class="flex items-start gap-4">
                            <!-- Priority indicator -->
                            <div class="flex-shrink-0 hidden sm:block">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center {{ $notice->priority === 'high' ? 'bg-red-100' : ($notice->priority === 'medium' ? 'bg-yellow-100' : 'bg-green-100') }}">
                                    <svg class="w-6 h-6 {{ $notice->priority === 'high' ? 'text-red-600' : ($notice->priority === 'medium' ? 'text-yellow-600' : 'text-green-600') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($notice->priority === 'high')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                        @elseif($notice->priority === 'medium')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        @endif
                                    </svg>
                                </div>
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex flex-wrap items-center gap-3">
                                    <a href="{{ route('notices.show', $notice) }}" class="text-xl font-semibold text-foreground group-hover:text-primary transition-colors">
                                        {{ $notice->title }}
                                    </a>
                                    <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent {{ $notice->priority === 'high' ? 'bg-destructive text-destructive-foreground hover:bg-destructive/80' : ($notice->priority === 'medium' ? 'bg-yellow-500 text-white hover:bg-yellow-600' : 'bg-green-500 text-white hover:bg-green-600') }}">
                                        {{ ucfirst($notice->priority) }}
                                    </span>
                                </div>
                                <p class="mt-2 text-muted-foreground line-clamp-2">
                                    {{ Str::limit($notice->content, 200) }}
                                </p>
                                <div class="mt-4 flex flex-wrap items-center gap-4 text-sm text-muted-foreground">
                                    <span class="flex items-center gap-1.5">
                                        <div class="w-6 h-6 rounded-full bg-gradient-to-br from-primary/20 to-accent/20 flex items-center justify-center text-xs font-medium text-primary">
                                            {{ strtoupper(substr($notice->author->name ?? 'A', 0, 1)) }}
                                        </div>
                                        {{ $notice->author->name ?? 'Unknown' }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $notice->created_at->format('M d, Y') }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $notice->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Arrow indicator -->
                            <div class="hidden sm:flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </x-card-content>
                </x-card>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $notices->links() }}
        </div>
    @endif
</div>
@endsection
