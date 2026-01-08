<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TeamBoard') }} - Register</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Lottie Player -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!-- Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-display { font-family: 'Space Grotesk', sans-serif; }
        .font-body { font-family: 'Raleway', sans-serif; }
        
        /* Animated gradient background */
        .auth-gradient {
            background: linear-gradient(-45deg, #b2ffa8, #d0ffb7, #86e7b8, #d6ffd8, #f2f5de);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Floating animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-float-delayed { animation: float 6s ease-in-out 2s infinite; }
        .animate-float-slow { animation: float 8s ease-in-out infinite; }
        
        /* Text reveal animation */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-slide-up {
            animation: slideUp 0.8s ease-out forwards;
            opacity: 0;
        }
        
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }
        
        /* Glowing orbs */
        .glow-orb {
            filter: blur(40px);
            opacity: 0.6;
        }
        
        /* Card hover effects */
        .feature-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px -12px rgba(134, 231, 184, 0.25);
        }
        
        /* Input focus glow */
        .input-glow:focus {
            box-shadow: 0 0 0 4px rgba(134, 231, 184, 0.15), 0 0 20px rgba(134, 231, 184, 0.1);
        }
        
        /* Button shimmer */
        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        
        .btn-shimmer {
            background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.2) 50%, transparent 100%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }
        
        /* Particle animation */
        @keyframes particle {
            0% { transform: translate(0, 0) scale(1); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translate(var(--tx), var(--ty)) scale(0); opacity: 0; }
        }
        
        .particle {
            position: absolute;
            width: 8px;
            height: 8px;
            background: #b2ffa8;
            border-radius: 50%;
            animation: particle 3s infinite;
        }
        
        /* Bounce animation for icons */
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .animate-bounce-slow {
            animation: bounce 2s ease-in-out infinite;
        }
        
        /* Password strength indicator */
        .strength-bar {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="font-body antialiased">
    <div class="min-h-screen flex">
        <!-- Left Side - Animation & Branding -->
        <div class="hidden lg:flex lg:w-1/2 auth-gradient relative overflow-hidden">
            <!-- Animated background orbs -->
            <div class="absolute top-32 right-20 w-64 h-64 bg-[#b2ffa8] rounded-full glow-orb animate-float"></div>
            <div class="absolute bottom-20 left-20 w-48 h-48 bg-[#86e7b8] rounded-full glow-orb animate-float-delayed"></div>
            <div class="absolute top-1/3 right-1/4 w-32 h-32 bg-[#d6ffd8] rounded-full glow-orb animate-float-slow"></div>
            
            <!-- Floating particles -->
            <div class="particle" style="top: 15%; left: 40%; --tx: 60px; --ty: -90px; animation-delay: 0s;"></div>
            <div class="particle" style="top: 35%; left: 70%; --tx: -40px; --ty: -50px; animation-delay: 0.6s;"></div>
            <div class="particle" style="top: 65%; left: 30%; --tx: 50px; --ty: -120px; animation-delay: 1.2s;"></div>
            <div class="particle" style="top: 45%; left: 15%; --tx: 70px; --ty: -30px; animation-delay: 1.8s;"></div>
            <div class="particle" style="top: 75%; left: 60%; --tx: -30px; --ty: -70px; animation-delay: 2.4s;"></div>
            
            <!-- Content container -->
            <div class="relative z-10 flex flex-col justify-center items-center w-full p-12">
                <!-- Logo -->
                <a href="{{ route('landing') }}" class="absolute top-8 left-8 flex items-center gap-3 group">
                    <div class="bg-white/90 backdrop-blur-sm p-3 rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-105">
                        <svg class="w-8 h-8 text-[#2d6a4f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <span class="font-display text-2xl font-bold text-[#1b4332]">TeamBoard</span>
                </a>
                
                <!-- Lottie Animation -->
                <div class="w-72 h-72 mb-6 animate-float">
                    <lottie-player
                        src="https://lottie.host/21a48c2e-7c18-4b84-ae38-20f7f3f96cb2/4HKnk8D5r6.json"
                        background="transparent"
                        speed="1"
                        loop
                        autoplay>
                    </lottie-player>
                </div>
                
                <!-- Animated Text -->
                <div class="text-center max-w-md">
                    <h2 class="font-display text-4xl font-bold text-[#1b4332] mb-4 animate-slide-up">
                        Join Our Team!
                    </h2>
                    <p class="text-lg text-[#2d6a4f] animate-slide-up delay-100">
                        Start your journey with TeamBoard today
                    </p>
                    
                    <!-- Benefits list -->
                    <div class="mt-8 space-y-4">
                        <div class="flex items-center gap-3 bg-white/40 backdrop-blur-sm rounded-xl p-4 animate-slide-up delay-200 feature-card">
                            <div class="w-10 h-10 bg-[#86e7b8] rounded-lg flex items-center justify-center animate-bounce-slow">
                                <svg class="w-5 h-5 text-[#1b4332]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-[#1b4332]">Free to get started</span>
                        </div>
                        
                        <div class="flex items-center gap-3 bg-white/40 backdrop-blur-sm rounded-xl p-4 animate-slide-up delay-300 feature-card">
                            <div class="w-10 h-10 bg-[#b2ffa8] rounded-lg flex items-center justify-center" style="animation: bounce 2s ease-in-out 0.2s infinite;">
                                <svg class="w-5 h-5 text-[#1b4332]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-[#1b4332]">Secure & private</span>
                        </div>
                        
                        <div class="flex items-center gap-3 bg-white/40 backdrop-blur-sm rounded-xl p-4 animate-slide-up delay-400 feature-card">
                            <div class="w-10 h-10 bg-[#d0ffb7] rounded-lg flex items-center justify-center" style="animation: bounce 2s ease-in-out 0.4s infinite;">
                                <svg class="w-5 h-5 text-[#1b4332]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-[#1b4332]">Lightning fast setup</span>
                        </div>
                    </div>
                    
                    <!-- Stats -->
                    <div class="mt-8 flex justify-center gap-8 animate-slide-up delay-500">
                        <div class="text-center">
                            <div class="font-display text-2xl font-bold text-[#1b4332]">10k+</div>
                            <div class="text-sm text-[#2d6a4f]">Teams</div>
                        </div>
                        <div class="text-center">
                            <div class="font-display text-2xl font-bold text-[#1b4332]">50k+</div>
                            <div class="text-sm text-[#2d6a4f]">Users</div>
                        </div>
                        <div class="text-center">
                            <div class="font-display text-2xl font-bold text-[#1b4332]">99%</div>
                            <div class="text-sm text-[#2d6a4f]">Uptime</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 lg:p-12 bg-white relative overflow-y-auto">
            <!-- Mobile logo -->
            <a href="{{ route('landing') }}" class="lg:hidden flex items-center gap-3 mb-6">
                <div class="bg-[#86e7b8]/20 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-[#2d6a4f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <span class="font-display text-2xl font-bold text-[#1b4332]">TeamBoard</span>
            </a>

            <div class="w-full max-w-md">
                <!-- Header -->
                <div class="mb-6">
                    <h1 class="font-display text-3xl lg:text-4xl font-bold text-gray-900 mb-2">
                        Create your account
                    </h1>
                    <p class="text-gray-500">
                        Fill in your details to get started
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5" id="registerForm">
                    @csrf

                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-semibold text-gray-700">
                            Full Name
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-[#2d6a4f] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                class="block w-full pl-12 pr-4 py-3.5 text-gray-900 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-[#86e7b8] focus:outline-none transition-all duration-300 input-glow"
                                placeholder="John Doe">
                        </div>
                        @error('name')
                            <p class="text-sm text-red-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-semibold text-gray-700">
                            Email Address
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-[#2d6a4f] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                class="block w-full pl-12 pr-4 py-3.5 text-gray-900 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-[#86e7b8] focus:outline-none transition-all duration-300 input-glow"
                                placeholder="john@teamboard.com">
                        </div>
                        @error('email')
                            <p class="text-sm text-red-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-semibold text-gray-700">
                            Password
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-[#2d6a4f] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required
                                class="block w-full pl-12 pr-12 py-3.5 text-gray-900 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-[#86e7b8] focus:outline-none transition-all duration-300 input-glow"
                                placeholder="••••••••"
                                oninput="checkPasswordStrength(this.value)">
                            <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                <svg id="eyeIconPassword" class="w-5 h-5 text-gray-400 hover:text-[#2d6a4f] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        <!-- Password strength indicator -->
                        <div class="flex gap-1 mt-2">
                            <div id="strength1" class="h-1 flex-1 rounded-full bg-gray-200 strength-bar"></div>
                            <div id="strength2" class="h-1 flex-1 rounded-full bg-gray-200 strength-bar"></div>
                            <div id="strength3" class="h-1 flex-1 rounded-full bg-gray-200 strength-bar"></div>
                            <div id="strength4" class="h-1 flex-1 rounded-full bg-gray-200 strength-bar"></div>
                        </div>
                        <p id="strengthText" class="text-xs text-gray-400"></p>
                        @error('password')
                            <p class="text-sm text-red-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">
                            Confirm Password
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-[#2d6a4f] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                class="block w-full pl-12 pr-12 py-3.5 text-gray-900 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-[#86e7b8] focus:outline-none transition-all duration-300 input-glow"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                <svg id="eyeIconConfirm" class="w-5 h-5 text-gray-400 hover:text-[#2d6a4f] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="flex items-start gap-3">
                        <input id="terms" type="checkbox" required
                            class="mt-1 w-5 h-5 rounded border-gray-300 text-[#2d6a4f] focus:ring-[#86e7b8] transition-colors cursor-pointer">
                        <label for="terms" class="text-sm text-gray-600 cursor-pointer">
                            I agree to the 
                            <a href="#" class="text-[#2d6a4f] hover:underline font-medium">Terms of Service</a>
                            and 
                            <a href="#" class="text-[#2d6a4f] hover:underline font-medium">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                        class="relative w-full py-4 px-6 bg-gradient-to-r from-[#2d6a4f] to-[#40916c] text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 overflow-hidden group">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <span>Create Account</span>
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                        </span>
                        <div class="absolute inset-0 btn-shimmer"></div>
                    </button>
                </form>

                <!-- Divider -->
                <div class="mt-6 flex items-center">
                    <div class="flex-1 border-t border-gray-200"></div>
                    <span class="px-4 text-sm text-gray-400">or</span>
                    <div class="flex-1 border-t border-gray-200"></div>
                </div>

                <!-- Login Link -->
                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-semibold text-[#2d6a4f] hover:text-[#40916c] transition-colors hover:underline">
                            Sign in
                        </a>
                    </p>
                </div>

                <!-- Back to home -->
                <div class="mt-6 text-center">
                    <a href="{{ route('landing') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#2d6a4f] transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to home
                    </a>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-8 lg:absolute lg:bottom-8 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} TeamBoard. All rights reserved.
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(fieldId === 'password' ? 'eyeIconPassword' : 'eyeIconConfirm');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
            }
        }
        
        // Password strength checker
        function checkPasswordStrength(password) {
            const strength1 = document.getElementById('strength1');
            const strength2 = document.getElementById('strength2');
            const strength3 = document.getElementById('strength3');
            const strength4 = document.getElementById('strength4');
            const strengthText = document.getElementById('strengthText');
            
            // Reset all bars
            [strength1, strength2, strength3, strength4].forEach(bar => {
                bar.className = 'h-1 flex-1 rounded-full bg-gray-200 strength-bar';
            });
            
            if (password.length === 0) {
                strengthText.textContent = '';
                return;
            }
            
            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^a-zA-Z\d]/.test(password)) strength++;
            
            const colors = {
                1: 'bg-red-400',
                2: 'bg-orange-400',
                3: 'bg-yellow-400',
                4: 'bg-green-400'
            };
            
            const texts = {
                1: 'Weak password',
                2: 'Fair password',
                3: 'Good password',
                4: 'Strong password'
            };
            
            for (let i = 1; i <= strength; i++) {
                document.getElementById('strength' + i).className = `h-1 flex-1 rounded-full ${colors[strength]} strength-bar`;
            }
            
            strengthText.textContent = texts[strength] || '';
            strengthText.className = `text-xs ${strength <= 2 ? 'text-red-500' : strength === 3 ? 'text-yellow-600' : 'text-green-600'}`;
        }
        
        // Form submit animation with confetti
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            button.innerHTML = `
                <span class="flex items-center justify-center gap-2">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Creating account...</span>
                </span>
            `;
            
            // Trigger confetti
            confetti({
                particleCount: 100,
                spread: 70,
                origin: { y: 0.6 },
                colors: ['#86e7b8', '#b2ffa8', '#d0ffb7', '#2d6a4f']
            });
        });
    </script>
</body>
</html>
