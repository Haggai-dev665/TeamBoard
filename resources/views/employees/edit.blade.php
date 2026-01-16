@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')
<div class="space-y-6">
    <!-- Back Button -->
    <x-button href="{{ route('employees.show', $employee) }}" variant="outline" size="sm">
        ← Back to Employee
    </x-button>

    <x-card>
        <x-card-header>
            <x-card-title>Edit Employee</x-card-title>
            <x-card-description>Update employee information</x-card-description>
        </x-card-header>
        <x-card-content>
            <form method="POST" action="{{ route('employees.update', $employee) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-medium text-foreground">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $employee->name) }}" required
                            placeholder="Enter your name"
                            class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        @error('name')
                            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-foreground">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $employee->email) }}" required
                            placeholder="Enter your email"
                            class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        @error('email')
                            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="department" class="block text-sm font-medium text-foreground">Department</label>
                        <input type="text" name="department" id="department" value="{{ old('department', $employee->department) }}" required
                            class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        @error('department')
                            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-foreground">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $employee->phone) }}"
                            class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        @error('phone')
                            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="photo" class="block text-sm font-medium text-foreground">Photo</label>
                    @if($employee->photo)
                        <div class="mt-2 mb-2">
                            <img src="{{ $employee->photo_url }}" alt="{{ $employee->name }}" class="h-20 w-20 rounded-full object-cover">
                        </div>
                    @endif
                    <input type="file" name="photo" id="photo" accept="image/*"
                        class="mt-1 block w-full text-sm text-foreground file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-primary file:text-primary-foreground hover:file:bg-primary/90">
                    @error('photo')
                        <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="bio" class="block text-sm font-medium text-foreground">Bio</label>
                    <textarea name="bio" id="bio" rows="4"
                        class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">{{ old('bio', $employee->bio) }}</textarea>
                    @error('bio')
                        <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <x-button type="submit">Update Employee</x-button>
                    <x-button href="{{ route('employees.show', $employee) }}" variant="outline" type="button">Cancel</x-button>
                </div>
            </form>
        </x-card-content>
    </x-card>
</div>
@endsection
