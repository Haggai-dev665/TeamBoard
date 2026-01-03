@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="text-center mb-8">
    <h2 class="text-3xl font-bold text-foreground tracking-tight">Create an Account</h2>
    <p class="text-muted-foreground mt-2">Join TeamBoard today</p>
</div>

<form method="POST" action="{{ route('register') }}" class="space-y-6">
    @csrf

    <!-- Name -->
    <div class="group">
        <label for="name" class="block text-sm font-medium text-foreground mb-1 transition-colors group-focus-within:text-primary">
            Full Name
        </label>
        <div class="relative">
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                class="block w-full rounded-lg border-input bg-background px-4 py-3 text-foreground shadow-sm transition-all duration-200 focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none hover:border-primary/50"
                placeholder="John Doe">
        </div>
        @error('name')
            <p class="mt-1 text-sm text-destructive animate-pulse">{{ $message }}</p>
        @enderror
    </div>

    <!-- Email Address -->
    <div class="group">
        <label for="email" class="block text-sm font-medium text-foreground mb-1 transition-colors group-focus-within:text-primary">
            Email Address
        </label>
        <div class="relative">
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                class="block w-full rounded-lg border-input bg-background px-4 py-3 text-foreground shadow-sm transition-all duration-200 focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none hover:border-primary/50"
                placeholder="john@teamboard.com">
        </div>
        @error('email')
            <p class="mt-1 text-sm text-destructive animate-pulse">{{ $message }}</p>
        @enderror
    </div>

    <!-- Password -->
    <div class="group">
        <label for="password" class="block text-sm font-medium text-foreground mb-1 transition-colors group-focus-within:text-primary">
            Password
        </label>
        <div class="relative">
            <input id="password" type="password" name="password" required
                class="block w-full rounded-lg border-input bg-background px-4 py-3 text-foreground shadow-sm transition-all duration-200 focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none hover:border-primary/50"
                placeholder="••••••••">
        </div>
        @error('password')
            <p class="mt-1 text-sm text-destructive animate-pulse">{{ $message }}</p>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="group">
        <label for="password_confirmation" class="block text-sm font-medium text-foreground mb-1 transition-colors group-focus-within:text-primary">
            Confirm Password
        </label>
        <div class="relative">
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="block w-full rounded-lg border-input bg-background px-4 py-3 text-foreground shadow-sm transition-all duration-200 focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none hover:border-primary/50"
                placeholder="••••••••">
        </div>
    </div>

    <div class="pt-2">
        <x-button type="submit" class="w-full py-6 text-base">
            Create Account
        </x-button>
    </div>

    <div class="text-center mt-6">
        <p class="text-sm text-muted-foreground">
            Already have an account? 
            <x-button href="{{ route('login') }}" variant="link" class="p-0 h-auto font-medium">
                Log in
            </x-button>
        </p>
    </div>
</form>
@endsection
