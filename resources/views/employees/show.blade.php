@extends('layouts.app')

@section('title', $employee->name)

@section('content')
<div class="space-y-6">
    <!-- Back Button -->
    <x-button href="{{ route('employees.index') }}" variant="outline" size="sm">
        ← Back to Employees
    </x-button>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Employee Info Card -->
        <div class="lg:col-span-1">
            <x-card>
                <x-card-content class="pt-6 text-center">
                    <img src="{{ $employee->photo_url }}" alt="{{ $employee->name }}"
                        class="mx-auto h-32 w-32 rounded-full object-cover">
                    <h2 class="mt-4 text-2xl font-bold text-foreground">{{ $employee->name }}</h2>
                    <p class="text-muted-foreground">{{ $employee->department }}</p>
                    
                    <div class="mt-6 space-y-4 text-left">
                        <div>
                            <label class="text-sm font-medium text-muted-foreground">Email</label>
                            <a href="mailto:{{ $employee->email }}" class="block text-foreground hover:text-primary">
                                {{ $employee->email }}
                            </a>
                        </div>
                        
                        @if($employee->phone)
                            <div>
                                <label class="text-sm font-medium text-muted-foreground">Phone</label>
                                <a href="tel:{{ $employee->phone }}" class="block text-foreground hover:text-primary">
                                    {{ $employee->phone }}
                                </a>
                            </div>
                        @endif

                        <div>
                            <label class="text-sm font-medium text-muted-foreground">Member Since</label>
                            <p class="text-foreground">{{ $employee->created_at->format('F Y') }}</p>
                        </div>
                    </div>

                    @can('update', $employee)
                        <div class="mt-6 flex gap-2">
                            <x-button href="{{ route('employees.edit', $employee) }}" variant="outline" class="flex-1">
                                Edit
                            </x-button>
                            <form method="POST" action="{{ route('employees.destroy', $employee) }}" class="flex-1"
                                onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                @csrf
                                @method('DELETE')
                                <x-button type="submit" variant="destructive" class="w-full">
                                    Delete
                                </x-button>
                            </form>
                        </div>
                    @endcan
                </x-card-content>
            </x-card>
        </div>

        <!-- Bio and Details -->
        <div class="lg:col-span-2">
            <x-card>
                <x-card-header>
                    <x-card-title>About</x-card-title>
                </x-card-header>
                <x-card-content>
                    @if($employee->bio)
                        <p class="text-foreground whitespace-pre-wrap">{{ $employee->bio }}</p>
                    @else
                        <p class="text-muted-foreground">No bio available.</p>
                    @endif
                </x-card-content>
            </x-card>
        </div>
    </div>
</div>
@endsection
