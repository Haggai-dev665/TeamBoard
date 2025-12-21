@extends('layouts.app')

@section('title', 'Create Notice')

@section('content')
<div class="space-y-6">
    <!-- Back Button -->
    <x-button href="{{ route('notices.index') }}" variant="outline" size="sm">
        ← Back to Notices
    </x-button>

    <x-card>
        <x-card-header>
            <x-card-title>Create New Notice</x-card-title>
            <x-card-description>Post a new announcement to the notice board</x-card-description>
        </x-card-header>
        <x-card-content>
            <form method="POST" action="{{ route('notices.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-foreground">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    @error('title')
                        <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="priority" class="block text-sm font-medium text-foreground">Priority</label>
                    <select name="priority" id="priority" required
                        class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('priority') == 'medium' || !old('priority') ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                    @error('priority')
                        <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-foreground">Content</label>
                    <textarea name="content" id="content" rows="8" required
                        class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <x-button type="submit">Create Notice</x-button>
                    <x-button href="{{ route('notices.index') }}" variant="outline" type="button">Cancel</x-button>
                </div>
            </form>
        </x-card-content>
    </x-card>
</div>
@endsection
