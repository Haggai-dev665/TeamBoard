@extends('layouts.app')

@section('title', 'Edit Notice')

@section('content')
<div class="space-y-6">
    <!-- Back Button -->
    <x-button href="{{ route('notices.show', $notice) }}" variant="outline" size="sm">
        ← Back to Notice
    </x-button>

    <x-card>
        <x-card-header>
            <x-card-title>Edit Notice</x-card-title>
            <x-card-description>Update notice information</x-card-description>
        </x-card-header>
        <x-card-content>
            <form method="POST" action="{{ route('notices.update', $notice) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="title" class="block text-sm font-medium text-foreground">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $notice->title) }}" required
                        class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    @error('title')
                        <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="priority" class="block text-sm font-medium text-foreground">Priority</label>
                    <select name="priority" id="priority" required
                        class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="low" {{ old('priority', $notice->priority) == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('priority', $notice->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('priority', $notice->priority) == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                    @error('priority')
                        <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-foreground">Content</label>
                    <textarea name="content" id="content" rows="8" required
                        class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">{{ old('content', $notice->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <x-button type="submit">Update Notice</x-button>
                    <x-button href="{{ route('notices.show', $notice) }}" variant="outline" type="button">Cancel</x-button>
                </div>
            </form>
        </x-card-content>
    </x-card>
</div>
@endsection
