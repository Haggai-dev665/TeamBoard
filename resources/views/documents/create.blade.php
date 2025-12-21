@extends('layouts.app')

@section('title', 'Upload Document')

@section('content')
<div class="space-y-6">
    <!-- Back Button -->
    <x-button href="{{ route('documents.index') }}" variant="outline" size="sm">
        ← Back to Documents
    </x-button>

    <x-card>
        <x-card-header>
            <x-card-title>Upload New Document</x-card-title>
            <x-card-description>Share a file with your team</x-card-description>
        </x-card-header>
        <x-card-content>
            <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-foreground">Document Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    @error('title')
                        <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="file" class="block text-sm font-medium text-foreground">File</label>
                    <input type="file" name="file" id="file" required
                        class="mt-1 block w-full text-sm text-foreground file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-primary file:text-primary-foreground hover:file:bg-primary/90">
                    <p class="mt-1 text-sm text-muted-foreground">Maximum file size: 10MB</p>
                    @error('file')
                        <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <x-button type="submit">Upload Document</x-button>
                    <x-button href="{{ route('documents.index') }}" variant="outline" type="button">Cancel</x-button>
                </div>
            </form>
        </x-card-content>
    </x-card>
</div>
@endsection
