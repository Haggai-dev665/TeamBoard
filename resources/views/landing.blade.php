<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TeamBoard - Modern Team Management Platform</title>
    <meta name="description" content="TeamBoard is a powerful team management platform for managing employees, notices, and documents efficiently.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Lottie Player -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    
    <!-- Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-display { font-family: 'Space Grotesk', sans-serif; }
        .font-body { font-family: 'Raleway', sans-serif; }
        
        .gradient-text {
            background: linear-gradient(135deg, #86e7b8 0%, #4ade80 50%, #22c55e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #f2f5de 0%, #d6ffd8 25%, #b2ffa8 50%, #d0ffb7 75%, #86e7b8 100%);
        }
        
        .card-gradient {
            background: linear-gradient(145deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.7) 100%);
            backdrop-filter: blur(20px);
        }
        
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        .float-animation-delayed {
            animation: float 6s ease-in-out infinite;
            animation-delay: -3s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(134, 231, 184, 0.4); }
            50% { box-shadow: 0 0 40px rgba(134, 231, 184, 0.8); }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        
        .animate-fade-in-left {
            animation: fadeInLeft 0.8s ease-out forwards;
        }
        
        .animate-fade-in-right {
            animation: fadeInRight 0.8s ease-out forwards;
        }
        
        .animate-scale-in {
            animation: scaleIn 0.6s ease-out forwards;
        }
        
        .animate-pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }
        
        .delay-100 { animation-delay: 0.1s; opacity: 0; }
        .delay-200 { animation-delay: 0.2s; opacity: 0; }
        .delay-300 { animation-delay: 0.3s; opacity: 0; }
        .delay-400 { animation-delay: 0.4s; opacity: 0; }
        .delay-500 { animation-delay: 0.5s; opacity: 0; }
        .delay-600 { animation-delay: 0.6s; opacity: 0; }
        
        .blob {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation: blob 8s ease-in-out infinite;
        }
        
        @keyframes blob {
            0%, 100% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
            25% { border-radius: 58% 42% 75% 25% / 76% 46% 54% 24%; }
            50% { border-radius: 50% 50% 33% 67% / 55% 27% 73% 45%; }
            75% { border-radius: 33% 67% 58% 42% / 63% 68% 32% 37%; }
        }
        
        .feature-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .feature-card:hover {
            transform: translateY(-8px) scale(1.02);
        }
        
        .nav-blur {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="font-body antialiased bg-background overflow-x-hidden">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 nav-blur bg-white/70 border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary to-accent flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-110 animate-pulse-glow">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-foreground tracking-tight font-display">TeamBoard</span>
                </a>
                
                <!-- Nav Links -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-muted-foreground hover:text-foreground transition-colors font-medium">Features</a>
                    <a href="#how-it-works" class="text-muted-foreground hover:text-foreground transition-colors font-medium">How it Works</a>
                    <a href="#notice-system" class="text-muted-foreground hover:text-foreground transition-colors font-medium">Notice System</a>
                </div>
                
                <!-- Auth Buttons -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-foreground hover:text-primary transition-colors font-medium hidden sm:block">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl text-sm font-semibold transition-all duration-300 bg-primary text-primary-foreground shadow-lg hover:shadow-xl hover:bg-primary/90 h-10 px-6 hover:-translate-y-0.5">
                        Get Started
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen hero-gradient pt-24 overflow-hidden">
        <!-- Animated Blobs -->
        <div class="absolute top-20 left-10 w-72 h-72 bg-primary/30 rounded-full blur-3xl blob"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-accent/40 rounded-full blur-3xl blob" style="animation-delay: -4s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-tea-green/50 rounded-full blur-3xl"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="text-center lg:text-left">
                    <div class="animate-fade-in-up delay-100">
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/60 backdrop-blur-sm text-sm font-medium text-foreground border border-white/50 shadow-sm mb-6">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            Trusted by 10,000+ teams worldwide
                        </span>
                    </div>
                    
                    <h1 class="animate-fade-in-up delay-200 text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold font-display leading-tight mb-6">
                        Manage Your
                        <span class="gradient-text block">Team Smarter</span>
                        Not Harder
                    </h1>
                    
                    <p class="animate-fade-in-up delay-300 text-lg sm:text-xl text-muted-foreground mb-8 max-w-xl mx-auto lg:mx-0">
                        TeamBoard brings together employee management, company announcements, and document sharing in one beautiful, intuitive platform.
                    </p>
                    
                    <div class="animate-fade-in-up delay-400 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}" onclick="triggerConfetti()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl text-base font-semibold transition-all duration-300 bg-primary text-primary-foreground shadow-lg hover:shadow-2xl hover:bg-primary/90 h-14 px-8 hover:-translate-y-1 animate-pulse-glow">
                            Start Free Trial
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                        <a href="#how-it-works" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl text-base font-semibold transition-all duration-300 bg-white/80 backdrop-blur-sm text-foreground shadow-lg hover:shadow-xl border border-white/50 h-14 px-8 hover:-translate-y-1">
                            <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"></path>
                            </svg>
                            Watch Demo
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="animate-fade-in-up delay-500 grid grid-cols-3 gap-8 mt-12 pt-8 border-t border-white/30">
                        <div class="text-center lg:text-left">
                            <p class="text-3xl sm:text-4xl font-bold font-display gradient-text">10K+</p>
                            <p class="text-sm text-muted-foreground mt-1">Active Teams</p>
                        </div>
                        <div class="text-center lg:text-left">
                            <p class="text-3xl sm:text-4xl font-bold font-display gradient-text">99.9%</p>
                            <p class="text-sm text-muted-foreground mt-1">Uptime SLA</p>
                        </div>
                        <div class="text-center lg:text-left">
                            <p class="text-3xl sm:text-4xl font-bold font-display gradient-text">4.9★</p>
                            <p class="text-sm text-muted-foreground mt-1">User Rating</p>
                        </div>
                    </div>
                </div>
                
                <!-- Right Content - Lottie Animation -->
                <div class="animate-fade-in-right delay-300 relative">
                    <div class="relative float-animation">
                        <lottie-player 
                            src="https://assets2.lottiefiles.com/packages/lf20_v1yudlrx.json"
                            background="transparent"
                            speed="1"
                            style="width: 100%; height: 500px;"
                            loop
                            autoplay>
                        </lottie-player>
                    </div>
                    
                    <!-- Floating Cards -->
                    <div class="absolute top-10 -left-4 card-gradient rounded-2xl p-4 shadow-xl border border-white/50 animate-fade-in-left delay-500 float-animation">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-foreground">50 Employees</p>
                                <p class="text-xs text-muted-foreground">Added this month</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="absolute bottom-20 -right-4 card-gradient rounded-2xl p-4 shadow-xl border border-white/50 animate-fade-in-right delay-600 float-animation-delayed">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-foreground">All Tasks Done!</p>
                                <p class="text-xs text-muted-foreground">Great job team 🎉</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Wave Divider -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="w-full h-20 sm:h-32">
                <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
            </svg>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 lg:py-32 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 text-sm font-medium text-primary mb-4">
                    ✨ Powerful Features
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold font-display text-foreground mb-4">
                    Everything You Need to
                    <span class="gradient-text">Manage Your Team</span>
                </h2>
                <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                    From employee directories to company-wide announcements, TeamBoard has all the tools you need.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card card-gradient rounded-3xl p-8 border border-white/50 shadow-xl">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold font-display text-foreground mb-3">Employee Directory</h3>
                    <p class="text-muted-foreground leading-relaxed">
                        Keep track of all team members with detailed profiles, contact info, departments, and more. Search and filter with ease.
                    </p>
                </div>
                
                <!-- Feature 2 -->
                <div class="feature-card card-gradient rounded-3xl p-8 border border-white/50 shadow-xl">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold font-display text-foreground mb-3">Notice Board</h3>
                    <p class="text-muted-foreground leading-relaxed">
                        Share important announcements with priority levels. Keep everyone informed with company-wide or department-specific notices.
                    </p>
                </div>
                
                <!-- Feature 3 -->
                <div class="feature-card card-gradient rounded-3xl p-8 border border-white/50 shadow-xl">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold font-display text-foreground mb-3">Document Sharing</h3>
                    <p class="text-muted-foreground leading-relaxed">
                        Upload, organize, and share important documents securely. Control access and keep everything in one central location.
                    </p>
                </div>
                
                <!-- Feature 4 -->
                <div class="feature-card card-gradient rounded-3xl p-8 border border-white/50 shadow-xl">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold font-display text-foreground mb-3">Secure & Private</h3>
                    <p class="text-muted-foreground leading-relaxed">
                        Enterprise-grade security with role-based access control. Your data is encrypted and protected at all times.
                    </p>
                </div>
                
                <!-- Feature 5 -->
                <div class="feature-card card-gradient rounded-3xl p-8 border border-white/50 shadow-xl">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-500 to-pink-600 flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold font-display text-foreground mb-3">Mobile Friendly</h3>
                    <p class="text-muted-foreground leading-relaxed">
                        Access TeamBoard from any device. Fully responsive design that works beautifully on desktop, tablet, and mobile.
                    </p>
                </div>
                
                <!-- Feature 6 -->
                <div class="feature-card card-gradient rounded-3xl p-8 border border-white/50 shadow-xl">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500 to-cyan-600 flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold font-display text-foreground mb-3">Lightning Fast</h3>
                    <p class="text-muted-foreground leading-relaxed">
                        Built for speed and performance. Instant search, real-time updates, and smooth animations for a delightful experience.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-20 lg:py-32 bg-gradient-to-b from-white to-background relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent/10 rounded-full blur-3xl"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 text-sm font-medium text-primary mb-4">
                    🚀 Getting Started
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold font-display text-foreground mb-4">
                    Up and Running in
                    <span class="gradient-text">Minutes</span>
                </h2>
                <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                    Get your team organized in just three simple steps.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8 lg:gap-12">
                <!-- Step 1 -->
                <div class="relative text-center">
                    <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-primary to-accent flex items-center justify-center mx-auto mb-6 shadow-2xl">
                        <span class="text-3xl font-bold text-white font-display">1</span>
                    </div>
                    <h3 class="text-xl font-bold font-display text-foreground mb-3">Create Your Account</h3>
                    <p class="text-muted-foreground">Sign up in seconds with just your email. No credit card required to start.</p>
                    
                    <!-- Connector Line -->
                    <div class="hidden md:block absolute top-10 left-[60%] w-[80%] h-0.5 bg-gradient-to-r from-primary/50 to-transparent"></div>
                </div>
                
                <!-- Step 2 -->
                <div class="relative text-center">
                    <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-primary to-accent flex items-center justify-center mx-auto mb-6 shadow-2xl">
                        <span class="text-3xl font-bold text-white font-display">2</span>
                    </div>
                    <h3 class="text-xl font-bold font-display text-foreground mb-3">Add Your Team</h3>
                    <p class="text-muted-foreground">Invite team members and organize them by departments. Import from CSV or add manually.</p>
                    
                    <!-- Connector Line -->
                    <div class="hidden md:block absolute top-10 left-[60%] w-[80%] h-0.5 bg-gradient-to-r from-primary/50 to-transparent"></div>
                </div>
                
                <!-- Step 3 -->
                <div class="relative text-center">
                    <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-primary to-accent flex items-center justify-center mx-auto mb-6 shadow-2xl">
                        <span class="text-3xl font-bold text-white font-display">3</span>
                    </div>
                    <h3 class="text-xl font-bold font-display text-foreground mb-3">Start Collaborating</h3>
                    <p class="text-muted-foreground">Share notices, upload documents, and keep everyone connected and informed.</p>
                </div>
            </div>
            
            <!-- Interactive Animation Section -->
            <div class="mt-20 relative">
                <!-- Center Lottie Animation -->
                <div class="flex justify-center relative z-10">
                    <lottie-player 
                        src="https://assets9.lottiefiles.com/packages/lf20_xyadoh9h.json"
                        background="transparent"
                        speed="1"
                        style="width: 500px; height: 400px;"
                        loop
                        autoplay>
                    </lottie-player>
                </div>
                
                <!-- Floating Feature Pills Around Animation -->
                <div class="absolute top-12 left-[10%] animate-fade-in-left delay-200 float-animation">
                    <div class="card-gradient rounded-full px-6 py-3 shadow-xl border border-white/50 flex items-center gap-3 hover:scale-105 transition-transform duration-300">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="font-semibold text-foreground whitespace-nowrap">Quick Setup</span>
                    </div>
                </div>
                
                <div class="absolute top-24 right-[12%] animate-fade-in-right delay-400 float-animation-delayed">
                    <div class="card-gradient rounded-full px-6 py-3 shadow-xl border border-white/50 flex items-center gap-3 hover:scale-105 transition-transform duration-300">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <span class="font-semibold text-foreground whitespace-nowrap">Team Ready</span>
                    </div>
                </div>
                
                <div class="absolute bottom-20 left-[15%] animate-fade-in-up delay-600 float-animation">
                    <div class="card-gradient rounded-full px-6 py-3 shadow-xl border border-white/50 flex items-center gap-3 hover:scale-105 transition-transform duration-300">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="font-semibold text-foreground whitespace-nowrap">Instant Access</span>
                    </div>
                </div>
                
                <div class="absolute bottom-16 right-[18%] animate-fade-in-up delay-800 float-animation-delayed">
                    <div class="card-gradient rounded-full px-6 py-3 shadow-xl border border-white/50 flex items-center gap-3 hover:scale-105 transition-transform duration-300">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <span class="font-semibold text-foreground whitespace-nowrap">Secure Setup</span>
                    </div>
                </div>
                
                <!-- Additional Corner Animations -->
                <div class="absolute -top-8 -right-8 animate-fade-in-right">
                    <lottie-player 
                        src="https://assets4.lottiefiles.com/packages/lf20_touohxv0.json"
                        background="transparent"
                        speed="0.8"
                        style="width: 120px; height: 120px;"
                        loop
                        autoplay>
                    </lottie-player>
                </div>
                
                <div class="absolute -bottom-8 -left-8 animate-fade-in-left">
                    <lottie-player 
                        src="https://assets2.lottiefiles.com/packages/lf20_y2hcf1zz.json"
                        background="transparent"
                        speed="0.8"
                        style="width: 140px; height: 140px;"
                        loop
                        autoplay>
                    </lottie-player>
                </div>
                
                <!-- Stats Counter Below Animation -->
                <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto">
                    <div class="text-center">
                        <div class="text-4xl font-bold font-display gradient-text mb-2">2min</div>
                        <div class="text-sm text-muted-foreground">Average Setup Time</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold font-display gradient-text mb-2">3</div>
                        <div class="text-sm text-muted-foreground">Simple Steps</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold font-display gradient-text mb-2">0</div>
                        <div class="text-sm text-muted-foreground">Credit Card Required</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold font-display gradient-text mb-2">100%</div>
                        <div class="text-sm text-muted-foreground">Free to Start</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Notice System Showcase Section -->
    <section id="notice-system" class="py-20 lg:py-32 bg-background relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Left Content -->
                <div>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-purple-100 text-sm font-medium text-purple-700 mb-6">
                        📢 Notice System
                    </span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold font-display text-foreground mb-6">
                        Keep Your Team
                        <span class="gradient-text block">Informed & Aligned</span>
                    </h2>
                    <p class="text-lg text-muted-foreground mb-8 leading-relaxed">
                        TeamBoard's powerful notice system ensures critical information reaches the right people at the right time. Say goodbye to endless email chains and missed announcements.
                    </p>
                    
                    <!-- Features List -->
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-foreground mb-2">Priority Levels</h3>
                                <p class="text-muted-foreground">Mark notices as high, medium, or low priority so urgent messages stand out and get immediate attention.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-foreground mb-2">Department Targeting</h3>
                                <p class="text-muted-foreground">Send announcements to specific departments or broadcast to the entire organization with a single click.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-foreground mb-2">Read Receipts</h3>
                                <p class="text-muted-foreground">Track who has viewed important notices and get real-time confirmation that your message was received.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-foreground mb-2">Smart Notifications</h3>
                                <p class="text-muted-foreground">Automatic alerts ensure no one misses critical updates, with customizable notification preferences.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-10">
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-gradient-to-r from-primary to-accent text-white font-semibold shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                            Try Notice System Now
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Right Illustration -->
                <div class="relative">
                    <!-- Main Lottie Animation -->
                    <div class="relative z-10 float-animation">
                        <lottie-player 
                            src="https://assets10.lottiefiles.com/packages/lf20_z9ed2jna.json"
                            background="transparent"
                            speed="1"
                            style="width: 100%; height: 500px;"
                            loop
                            autoplay>
                        </lottie-player>
                    </div>
                    
                    <!-- Floating Notice Cards -->
                    <div class="absolute top-12 -left-8 card-gradient rounded-2xl p-4 shadow-2xl border border-white/50 max-w-xs animate-fade-in-left delay-200 float-animation">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="inline-block px-2 py-0.5 text-xs font-semibold text-red-700 bg-red-100 rounded-full mb-2">HIGH PRIORITY</span>
                                <p class="text-sm font-semibold text-foreground">Emergency Team Meeting</p>
                                <p class="text-xs text-muted-foreground mt-1">Scheduled for 3 PM today</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="absolute top-1/2 -right-8 card-gradient rounded-2xl p-4 shadow-2xl border border-white/50 max-w-xs animate-fade-in-right delay-400 float-animation-delayed">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="inline-block px-2 py-0.5 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full mb-2">INFO</span>
                                <p class="text-sm font-semibold text-foreground">New Benefits Package</p>
                                <p class="text-xs text-muted-foreground mt-1">Review by end of week</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="absolute bottom-12 left-12 card-gradient rounded-2xl p-4 shadow-2xl border border-white/50 max-w-xs animate-fade-in-up delay-600 float-animation">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="inline-block px-2 py-0.5 text-xs font-semibold text-green-700 bg-green-100 rounded-full mb-2">COMPLETED</span>
                                <p class="text-sm font-semibold text-foreground">Q4 Goals Achieved! 🎉</p>
                                <p class="text-xs text-muted-foreground mt-1">Great work team!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 lg:py-32 bg-gradient-to-br from-primary via-accent to-primary relative overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-10 left-10 w-40 h-40 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-60 h-60 bg-white rounded-full blur-3xl"></div>
        </div>
        
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold font-display text-white mb-6">
                Ready to Transform Your Team Management?
            </h2>
            <p class="text-xl text-white/80 mb-10 max-w-2xl mx-auto">
                Join thousands of teams already using TeamBoard to stay organized and connected.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" onclick="triggerConfetti()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl text-base font-semibold transition-all duration-300 bg-white text-primary shadow-2xl hover:shadow-3xl h-14 px-10 hover:-translate-y-1">
                    Get Started for Free
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl text-base font-semibold transition-all duration-300 bg-white/20 backdrop-blur-sm text-white border-2 border-white/50 h-14 px-10 hover:-translate-y-1 hover:bg-white/30">
                    Login to Dashboard
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-foreground text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12">
                <!-- Brand -->
                <div class="col-span-2 md:col-span-1">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary to-accent flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold tracking-tight font-display">TeamBoard</span>
                    </div>
                    <p class="text-white/60 text-sm leading-relaxed">
                        Modern team management platform for growing businesses.
                    </p>
                </div>
                
                <!-- Links -->
                <div>
                    <h4 class="font-semibold mb-4">Product</h4>
                    <ul class="space-y-3 text-sm text-white/60">
                        <li><a href="#features" class="hover:text-white transition-colors">Features</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Pricing</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Integrations</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Updates</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Company</h4>
                    <ul class="space-y-3 text-sm text-white/60">
                        <li><a href="#" class="hover:text-white transition-colors">About</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Legal</h4>
                    <ul class="space-y-3 text-sm text-white/60">
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-white/10 mt-12 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-sm text-white/60">
                    &copy; {{ date('Y') }} TeamBoard. All rights reserved.
                </p>
                <div class="flex items-center gap-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Trigger confetti on CTA clicks
        function triggerConfetti() {
            confetti({
                particleCount: 100,
                spread: 70,
                origin: { y: 0.6 },
                colors: ['#86e7b8', '#d6ffd8', '#b2ffa8', '#d0ffb7', '#22c55e']
            });
        }
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.feature-card').forEach(card => {
            observer.observe(card);
        });
    </script>
</body>
</html>
