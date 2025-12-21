@extends('layouts.app')

@section('title', 'Documents')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">Document Library</h1>
            <p class="mt-2 text-muted-foreground">Shared files and resources</p>
        </div>
        <x-button href="{{ route('documents.create') }}">
            Upload Document
        </x-button>
    </div>

    <!-- Search -->
    <x-card>
        <x-card-content class="pt-6">
            <form method="GET" action="{{ route('documents.index') }}" class="flex gap-4">
                <input type="text" name="search" placeholder="Search documents..." value="{{ request('search') }}"
                    class="flex-1 rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                <x-button type="submit">Search</x-button>
                @if(request('search'))
                    <x-button href="{{ route('documents.index') }}" variant="outline">Clear</x-button>
                @endif
            </form>
        </x-card-content>
    </x-card>

    <!-- Documents Table -->
    @if($documents->isEmpty())
        <x-card>
            <x-card-content class="py-12 text-center">
                <p class="text-muted-foreground">No documents found.</p>
            </x-card-content>
        </x-card>
    @else
        <x-card>
            <x-card-content class="pt-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="border-b border-border">
                            <tr>
                                <th class="pb-3 text-left text-sm font-medium text-muted-foreground">Title</th>
                                <th class="pb-3 text-left text-sm font-medium text-muted-foreground">Filename</th>
                                <th class="pb-3 text-left text-sm font-medium text-muted-foreground">Uploaded By</th>
                                <th class="pb-3 text-left text-sm font-medium text-muted-foreground">Date</th>
                                <th class="pb-3 text-right text-sm font-medium text-muted-foreground">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border">
                            @foreach($documents as $document)
                                <tr class="hover:bg-muted/50">
                                    <td class="py-3 text-foreground">{{ $document->title }}</td>
                                    <td class="py-3 text-muted-foreground">{{ $document->filename }}</td>
                                    <td class="py-3 text-muted-foreground">{{ $document->uploader->name }}</td>
                                    <td class="py-3 text-muted-foreground">{{ $document->created_at->format('M d, Y') }}</td>
                                    <td class="py-3 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <x-button href="{{ route('documents.download', $document) }}" variant="outline" size="sm">
                                                Download
                                            </x-button>
                                            @can('delete', $document)
                                                <form method="POST" action="{{ route('documents.destroy', $document) }}" class="inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this document?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-button type="submit" variant="destructive" size="sm">
                                                        Delete
                                                    </x-button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card-content>
        </x-card>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $documents->links() }}
        </div>
    @endif
</div>
@endsection
