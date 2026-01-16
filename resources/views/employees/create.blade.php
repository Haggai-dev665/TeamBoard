@extends('layouts.app')

@section('title', 'Add Employee')

@section('content')
<div class="space-y-6">
    <!-- Back Button -->
    <x-button href="{{ route('employees.index') }}" variant="outline" size="sm">
        ← Back to Employees
    </x-button>

    <x-card>
        <x-card-header>
            <x-card-title>Add New Employee</x-card-title>
            <x-card-description>Create a new employee profile</x-card-description>
        </x-card-header>
        <x-card-content>
            <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-medium text-foreground">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $prefill['name'] ?? '') }}" required
                            placeholder="Enter your name"
                            class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        @error('name')
                            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-foreground">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $prefill['email'] ?? '') }}" required
                            placeholder="Enter your email"
                            class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        @error('email')
                            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="department" class="block text-sm font-medium text-foreground">Department</label>
                        <input type="text" name="department" id="department" value="{{ old('department') }}" required
                            class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        @error('department')
                            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-foreground">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        @error('phone')
                            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="photo" class="block text-sm font-medium text-foreground">Photo</label>
                    <input type="file" name="photo" id="photo" accept="image/*"
                        class="mt-1 block w-full text-sm text-foreground file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-primary file:text-primary-foreground hover:file:bg-primary/90">
                    @error('photo')
                        <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="bio" class="block text-sm font-medium text-foreground">Bio</label>
                    <textarea name="bio" id="bio" rows="4"
                        class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">{{ old('bio') }}</textarea>
                    @error('bio')
                        <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <x-button type="submit">Create Employee</x-button>
                    <x-button href="{{ route('employees.index') }}" variant="outline" type="button">Cancel</x-button>
                </div>
            </form>
        </x-card-content>
    </x-card>
</div>
@endsection
