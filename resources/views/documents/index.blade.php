@extends('layouts.app')

@section('title', 'Documents')

@section('content')
<div class="space-y-8">
    <!-- Page Header with Animation -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 animate-fade-in">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-primary via-accent to-primary bg-clip-text text-transparent">
                Document Library
            </h1>
            <p class="mt-2 text-lg text-muted-foreground">Shared files and resources</p>
        </div>
        <x-button href="{{ route('documents.create') }}" class="gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
            </svg>
            Upload Document
        </x-button>
    </div>

    <!-- Search -->
    <x-card class="animate-slide-in">
        <x-card-content class="p-6">
            <form method="GET" action="{{ route('documents.index') }}" class="flex flex-col gap-4 sm:flex-row">
                <div class="flex-1 relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="search" placeholder="Search documents by title or filename..." value="{{ request('search') }}"
                        class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 pl-10">
                </div>
                <x-button type="submit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Search
                </x-button>
                @if(request('search'))
                    <x-button href="{{ route('documents.index') }}" variant="outline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Clear
                    </x-button>
                @endif
            </form>
        </x-card-content>
    </x-card>

    <!-- Documents Table -->
    @if($documents->isEmpty())
        <x-card class="animate-fade-in">
            <x-card-content class="p-12 text-center">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-muted/50 flex items-center justify-center">
                    <svg class="w-10 h-10 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="text-lg font-medium text-foreground">No documents found</p>
                <p class="mt-1 text-muted-foreground">Upload your first document to get started</p>
            </x-card-content>
        </x-card>
    @else
        <x-card class="animate-scale-in overflow-hidden">
            <x-table>
                <x-table-header>
                    <x-table-row>
                        <x-table-head>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Title
                            </div>
                        </x-table-head>
                        <x-table-head>Filename</x-table-head>
                        <x-table-head>Uploaded By</x-table-head>
                        <x-table-head>Date</x-table-head>
                        <x-table-head class="text-right">Actions</x-table-head>
                    </x-table-row>
                </x-table-header>
                <x-table-body>
                    @foreach($documents as $document)
                        <x-table-row class="group">
                            <x-table-cell>
                                <div class="flex items-center gap-3">
                                    <div class="p-2 rounded-lg bg-orange-100 group-hover:bg-orange-200 transition-colors">
                                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-foreground group-hover:text-primary transition-colors">{{ $document->title }}</span>
                                </div>
                            </x-table-cell>
                            <x-table-cell class="text-muted-foreground">
                                <span class="px-2 py-1 bg-muted/50 rounded text-xs font-mono">{{ $document->filename }}</span>
                            </x-table-cell>
                            <x-table-cell>
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-gradient-to-br from-primary/20 to-accent/20 flex items-center justify-center text-xs font-medium text-primary">
                                        {{ strtoupper(substr($document->uploader->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <span class="text-muted-foreground">{{ $document->uploader->name ?? 'Unknown' }}</span>
                                </div>
                            </x-table-cell>
                            <x-table-cell class="text-muted-foreground">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $document->created_at->format('M d, Y') }}
                                </div>
                            </x-table-cell>
                            <x-table-cell class="text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <x-button href="{{ route('documents.download', $document) }}" variant="ghost" size="sm" class="gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                        Download
                                    </x-button>
                                    @can('delete', $document)
                                        <form method="POST" action="{{ route('documents.destroy', $document) }}" class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this document?');">
                                            @csrf
                                            @method('DELETE')
                                            <x-button type="submit" variant="ghost" size="sm" class="text-destructive hover:text-destructive hover:bg-destructive/10">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </x-button>
                                        </form>
                                    @endcan
                                </div>
                            </x-table-cell>
                        </x-table-row>
                        
                        <!-- Feedback Row -->
                        @if(!auth()->user()->isSuperAdmin())
                            <x-table-row>
                                <x-table-cell colspan="5" class="bg-gray-50/50 p-4">
                                    <x-feedback :item="$document" type="document" />
                                </x-table-cell>
                            </x-table-row>
                        @endif
                    @endforeach
                </x-table-body>
            </x-table>
        </x-card>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $documents->links() }}
        </div>
    @endif
</div>
@endsection
