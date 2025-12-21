@extends('layouts.app')

@section('title', 'Employees')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">Employee Directory</h1>
            <p class="mt-2 text-muted-foreground">Browse and search employee information</p>
        </div>
        @can('create', App\Models\Employee::class)
            <x-button href="{{ route('employees.create') }}">
                Add Employee
            </x-button>
        @endcan
    </div>

    <!-- Search and Filters -->
    <x-card>
        <x-card-content class="pt-6">
            <form method="GET" action="{{ route('employees.index') }}" class="flex flex-col gap-4 sm:flex-row">
                <input type="text" name="search" placeholder="Search employees..." value="{{ request('search') }}"
                    class="flex-1 rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                
                <select name="department"
                    class="rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <option value="">All Departments</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>
                            {{ $dept }}
                        </option>
                    @endforeach
                </select>

                <x-button type="submit">
                    Search
                </x-button>
                
                @if(request('search') || request('department'))
                    <x-button href="{{ route('employees.index') }}" variant="outline">
                        Clear
                    </x-button>
                @endif
            </form>
        </x-card-content>
    </x-card>

    <!-- Employees Grid -->
    @if($employees->isEmpty())
        <x-card>
            <x-card-content class="py-12 text-center">
                <p class="text-muted-foreground">No employees found.</p>
            </x-card-content>
        </x-card>
    @else
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($employees as $employee)
                <x-card variant="hover">
                    <x-card-header class="text-center">
                        <img src="{{ $employee->photo_url }}" alt="{{ $employee->name }}"
                            class="mx-auto h-24 w-24 rounded-full object-cover">
                        <x-card-title class="mt-4">{{ $employee->name }}</x-card-title>
                        <x-card-description>{{ $employee->department }}</x-card-description>
                    </x-card-header>
                    <x-card-content class="space-y-2 text-sm">
                        <div class="flex items-center text-muted-foreground">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            {{ $employee->email }}
                        </div>
                        @if($employee->phone)
                            <div class="flex items-center text-muted-foreground">
                                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                {{ $employee->phone }}
                            </div>
                        @endif
                    </x-card-content>
                    <x-card-footer>
                        <x-button href="{{ route('employees.show', $employee) }}" variant="outline" size="sm" class="w-full">
                            View Profile
                        </x-button>
                    </x-card-footer>
                </x-card>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $employees->links() }}
        </div>
    @endif
</div>
@endsection
