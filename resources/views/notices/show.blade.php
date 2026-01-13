@extends('layouts.app')

@section('title', $notice->title)

@section('content')
<div class="space-y-6">
    <!-- Back Button -->
    <x-button href="{{ route('notices.index') }}" variant="outline" size="sm">
        ← Back to Notices
    </x-button>

    <x-card>
        <x-card-header>
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-3">
                        <x-card-title class="text-3xl">{{ $notice->title }}</x-card-title>
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium {{ $notice->priority_color }}">
                            {{ ucfirst($notice->priority) }}
                        </span>
                    </div>
                    <div class="mt-2 flex items-center gap-4 text-sm text-muted-foreground">
                        <span>By {{ $notice->author->name }}</span>
                        <span>•</span>
                        <span>{{ $notice->created_at->format('F d, Y \a\t g:i A') }}</span>
                    </div>
                </div>
                
                @can('update', $notice)
                    <div class="flex gap-2">
                        <x-button href="{{ route('notices.edit', $notice) }}" variant="outline" size="sm">
                            Edit
                        </x-button>
                        <form method="POST" action="{{ route('notices.destroy', $notice) }}"
                            onsubmit="return confirm('Are you sure you want to delete this notice?');">
                            @csrf
                            @method('DELETE')
                            <x-button type="submit" variant="destructive" size="sm">
                                Delete
                            </x-button>
                        </form>
                    </div>
                @endcan
            </div>
        </x-card-header>
        <x-card-content>
            <div class="prose max-w-none">
                <p class="text-foreground whitespace-pre-wrap">{{ $notice->content }}</p>
            </div>
        </x-card-content>
    </x-card>

    <!-- Feedback Section -->
    @if(!auth()->user()->isSuperAdmin())
        <x-feedback :item="$notice" type="notice" />
    @endif
</div>
@endsection
