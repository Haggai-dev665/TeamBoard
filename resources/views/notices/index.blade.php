@extends('layouts.app')

@section('title', 'Notices')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">Notice Board</h1>
            <p class="mt-2 text-muted-foreground">Company announcements and updates</p>
        </div>
        <x-button href="{{ route('notices.create') }}">
            Create Notice
        </x-button>
    </div>

    <!-- Filters -->
    <x-card>
        <x-card-content class="pt-6">
            <form method="GET" action="{{ route('notices.index') }}" class="flex flex-col gap-4 sm:flex-row">
                <input type="text" name="search" placeholder="Search notices..." value="{{ request('search') }}"
                    class="flex-1 rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                
                <select name="priority"
                    class="rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <option value="">All Priorities</option>
                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                </select>

                <x-button type="submit">Search</x-button>
                
                @if(request('search') || request('priority'))
                    <x-button href="{{ route('notices.index') }}" variant="outline">Clear</x-button>
                @endif
            </form>
        </x-card-content>
    </x-card>

    <!-- Notices List -->
    @if($notices->isEmpty())
        <x-card>
            <x-card-content class="py-12 text-center">
                <p class="text-muted-foreground">No notices found.</p>
            </x-card-content>
        </x-card>
    @else
        <div class="space-y-4">
            @foreach($notices as $notice)
                <x-card variant="hover">
                    <x-card-content class="pt-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('notices.show', $notice) }}" class="text-xl font-semibold text-foreground hover:text-primary">
                                        {{ $notice->title }}
                                    </a>
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $notice->priority_color }}">
                                        {{ ucfirst($notice->priority) }}
                                    </span>
                                </div>
                                <p class="mt-2 text-muted-foreground line-clamp-2">
                                    {{ $notice->content }}
                                </p>
                                <div class="mt-3 flex items-center gap-4 text-sm text-muted-foreground">
                                    <span>By {{ $notice->author->name }}</span>
                                    <span>•</span>
                                    <span>{{ $notice->created_at->format('M d, Y') }}</span>
                                    <span>•</span>
                                    <span>{{ $notice->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </x-card-content>
                </x-card>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $notices->links() }}
        </div>
    @endif
</div>
@endsection
