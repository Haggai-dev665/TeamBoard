@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<form method="POST" action="{{ route('login') }}" class="space-y-6">
    @csrf

    <!-- Email Address -->
    <div>
        <label for="email" class="block text-sm font-medium text-foreground">
            Email
        </label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
            class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
        @error('email')
            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
        @enderror
    </div>

    <!-- Password -->
    <div>
        <label for="password" class="block text-sm font-medium text-foreground">
            Password
        </label>
        <input id="password" type="password" name="password" required
            class="mt-1 block w-full rounded-md border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
        @error('password')
            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
        @enderror
    </div>

    <!-- Remember Me -->
    <div class="flex items-center">
        <input id="remember" type="checkbox" name="remember" class="rounded border-input text-primary focus:ring-primary">
        <label for="remember" class="ml-2 block text-sm text-foreground">
            Remember me
        </label>
    </div>

    <div>
        <x-button type="submit" class="w-full">
            Log in
        </x-button>
    </div>
</form>
@endsection
