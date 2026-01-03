@extends('layouts.app')

@section('title', 'Employees')

@section('content')
<div class="space-y-8">
    <!-- Page Header with Animation -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 animate-fade-in">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-primary via-accent to-primary bg-clip-text text-transparent">
                Employee Directory
            </h1>
            <p class="mt-2 text-lg text-muted-foreground">Browse and search employee information</p>
        </div>
        @can('create', App\Models\Employee::class)
            <x-button href="{{ route('employees.create') }}" class="gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Add Employee
            </x-button>
        @endcan
    </div>

    <!-- Search and Filters -->
    <x-card class="animate-slide-in">
        <x-card-content class="p-6">
            <form method="GET" action="{{ route('employees.index') }}" class="flex flex-col gap-4 lg:flex-row lg:items-end">
                <div class="flex-1 space-y-2">
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="search">Search</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" id="search" placeholder="Search by name, email..." value="{{ request('search') }}"
                            class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 pl-10">
                    </div>
                </div>
                
                <div class="space-y-2 lg:w-48">
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="department">Department</label>
                    <select name="department" id="department" class="flex h-9 w-full items-center justify-between whitespace-nowrap rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-1 focus:ring-ring disabled:cursor-not-allowed disabled:opacity-50 [&>span]:line-clamp-1">
                        <option value="">All Departments</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>
                                {{ $dept }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-2">
                    <x-button type="submit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Search
                    </x-button>
                    
                    @if(request('search') || request('department'))
                        <x-button href="{{ route('employees.index') }}" variant="outline">
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

    <!-- Employees Grid -->
    @if($employees->isEmpty())
        <x-card class="animate-fade-in">
            <x-card-content class="p-12 text-center">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-muted/50 flex items-center justify-center">
                    <svg class="w-10 h-10 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <p class="text-lg font-medium text-foreground">No employees found</p>
                <p class="mt-1 text-muted-foreground">Try adjusting your search or filters</p>
            </x-card-content>
        </x-card>
    @else
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 stagger-animate">
            @foreach($employees as $employee)
                <x-card hover class="group cursor-pointer overflow-hidden" onclick="window.location='{{ route('employees.show', $employee) }}'">
                    <div class="relative">
                        <!-- Decorative background -->
                        <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-br from-primary/10 to-accent/10"></div>
                        
                        <x-card-header class="relative pt-8 text-center">
                            <div class="relative inline-block mx-auto">
                                <img src="{{ $employee->photo_url }}" alt="{{ $employee->name }}"
                                    class="h-24 w-24 rounded-full object-cover border-4 border-background shadow-lg group-hover:scale-105 transition-transform duration-300">
                                <span class="absolute bottom-1 right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-background"></span>
                            </div>
                            
                            <x-card-title class="mt-4 group-hover:text-primary transition-colors">{{ $employee->name }}</x-card-title>
                            <x-card-description>
                                <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80">{{ $employee->department }}</span>
                            </x-card-description>
                        </x-card-header>
                    </div>
                    
                    <x-card-content class="space-y-3">
                        <div class="flex items-center gap-3 text-sm text-muted-foreground group/item hover:text-foreground transition-colors">
                            <div class="p-2 rounded-lg bg-muted/50 group-hover/item:bg-primary/10 transition-colors">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="truncate">{{ $employee->email }}</span>
                        </div>
                        @if($employee->phone)
                            <div class="flex items-center gap-3 text-sm text-muted-foreground group/item hover:text-foreground transition-colors">
                                <div class="p-2 rounded-lg bg-muted/50 group-hover/item:bg-primary/10 transition-colors">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <span>{{ $employee->phone }}</span>
                            </div>
                        @endif
                    </x-card-content>
                    
                    <x-card-footer class="justify-center border-t bg-muted/50 p-4">
                        <x-button href="{{ route('employees.show', $employee) }}" variant="ghost" size="sm" class="w-full group-hover:bg-primary/10">
                            View Profile
                            <svg class="w-4 h-4 ml-1 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </x-button>
                    </x-card-footer>
                </x-card>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $employees->links() }}
        </div>
    @endif
</div>
@endsection
