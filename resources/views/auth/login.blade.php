@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="text-center mb-8">
    <h2 class="text-3xl font-bold text-foreground tracking-tight">Welcome Back</h2>
    <p class="text-muted-foreground mt-2">Please sign in to your account</p>
</div>

<form method="POST" action="{{ route('login') }}" class="space-y-6">
    @csrf

    <!-- Email Address -->
    <div class="group">
        <label for="email" class="block text-sm font-medium text-foreground mb-1 transition-colors group-focus-within:text-primary">
            Email Address
        </label>
        <div class="relative">
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
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

    <!-- Remember Me -->
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <input id="remember" type="checkbox" name="remember" class="h-4 w-4 rounded border-input text-primary focus:ring-primary transition-colors cursor-pointer">
            <label for="remember" class="ml-2 block text-sm text-muted-foreground cursor-pointer hover:text-foreground transition-colors">
                Remember me
            </label>
        </div>
    </div>

    <div class="pt-2">
        <x-button type="submit" class="w-full py-6 text-base">
            Sign In
        </x-button>
    </div>

    <div class="text-center mt-6">
        <p class="text-sm text-muted-foreground">
            Don't have an account? 
            <x-button href="{{ route('register') }}" variant="link" class="p-0 h-auto font-medium">
                Create an account
            </x-button>
        </p>
    </div>
</form>
@endsection
