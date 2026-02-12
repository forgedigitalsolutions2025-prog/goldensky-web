<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Golden Sky Hotel & Wellness')</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'Experience luxury and tranquility at Golden Sky Hotel & Wellness in Kandy, Sri Lanka. Book your stay at our premium hotel with world-class amenities, fine dining, and wellness center.')">
    <meta name="keywords" content="Golden Sky Hotel, Golden Sky Hotel and Wellness, hotel in Kandy, luxury hotel Sri Lanka, hotel booking Kandy, wellness hotel, boutique hotel Kandy">
    <meta name="author" content="Golden Sky Hotel & Wellness">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Golden Sky Hotel & Wellness')">
    <meta property="og:description" content="@yield('description', 'Experience luxury and tranquility at Golden Sky Hotel & Wellness in Kandy, Sri Lanka.')">
    <meta property="og:image" content="{{ asset('icon.png') }}">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Golden Sky Hotel & Wellness')">
    <meta property="twitter:description" content="@yield('description', 'Experience luxury and tranquility at Golden Sky Hotel & Wellness in Kandy, Sri Lanka.')">
    <meta property="twitter:image" content="{{ asset('icon.png') }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        // Suppress Tailwind CDN warning in development
        const originalWarn = console.warn;
        console.warn = function(...args) {
            if (args[0] && typeof args[0] === 'string' && args[0].includes('cdn.tailwindcss.com')) {
                return; // Suppress Tailwind CDN warning
            }
            originalWarn.apply(console, args);
        };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'gold': '#FFD700',
                        'gold-dark': '#B8860B',
                        'gold-light': '#FDB931',
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }
        
        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }
        
        .scroll-reveal-delay-100 {
            transition-delay: 0.1s;
        }
        
        .scroll-reveal-delay-200 {
            transition-delay: 0.2s;
        }
        
        .scroll-reveal-delay-300 {
            transition-delay: 0.3s;
        }
        
        /* Subtle Gold Particles Animation */
        .particles-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
            overflow: hidden;
        }
        
        .particle {
            position: absolute;
            background: radial-gradient(circle, rgba(255, 215, 0, 0.8) 0%, rgba(255, 215, 0, 0.4) 40%, rgba(255, 215, 0, 0) 70%);
            border-radius: 50%;
            animation: float-particle linear infinite;
            opacity: 0;
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.6);
        }
        
        @keyframes float-particle {
            0% {
                transform: translateY(100vh) translateX(0) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 0.8;
            }
            100% {
                transform: translateY(-10vh) translateX(var(--drift)) rotate(360deg);
                opacity: 0;
            }
        }
        
        /* Different particle sizes and speeds */
        .particle:nth-child(1) { left: 10%; width: 8px; height: 8px; animation-duration: 20s; animation-delay: 0s; --drift: 30px; }
        .particle:nth-child(2) { left: 20%; width: 10px; height: 10px; animation-duration: 25s; animation-delay: 3s; --drift: -40px; }
        .particle:nth-child(3) { left: 30%; width: 6px; height: 6px; animation-duration: 22s; animation-delay: 7s; --drift: 50px; }
        .particle:nth-child(4) { left: 40%; width: 9px; height: 9px; animation-duration: 23s; animation-delay: 1s; --drift: -35px; }
        .particle:nth-child(5) { left: 50%; width: 7px; height: 7px; animation-duration: 24s; animation-delay: 5s; --drift: 45px; }
        .particle:nth-child(6) { left: 60%; width: 10px; height: 10px; animation-duration: 21s; animation-delay: 10s; --drift: -50px; }
        .particle:nth-child(7) { left: 70%; width: 6px; height: 6px; animation-duration: 26s; animation-delay: 2s; --drift: 40px; }
        .particle:nth-child(8) { left: 80%; width: 9px; height: 9px; animation-duration: 23s; animation-delay: 8s; --drift: -45px; }
        .particle:nth-child(9) { left: 90%; width: 7px; height: 7px; animation-duration: 25s; animation-delay: 4s; --drift: 35px; }
        .particle:nth-child(10) { left: 15%; width: 8px; height: 8px; animation-duration: 22s; animation-delay: 12s; --drift: -40px; }
        .particle:nth-child(11) { left: 25%; width: 6px; height: 6px; animation-duration: 27s; animation-delay: 6s; --drift: 50px; }
        .particle:nth-child(12) { left: 35%; width: 10px; height: 10px; animation-duration: 21s; animation-delay: 1.5s; --drift: -30px; }
        .particle:nth-child(13) { left: 45%; width: 7px; height: 7px; animation-duration: 24s; animation-delay: 9s; --drift: 45px; }
        .particle:nth-child(14) { left: 55%; width: 9px; height: 9px; animation-duration: 26s; animation-delay: 4.5s; --drift: -50px; }
        .particle:nth-child(15) { left: 65%; width: 6px; height: 6px; animation-duration: 22s; animation-delay: 11s; --drift: 40px; }
        .particle:nth-child(16) { left: 75%; width: 10px; height: 10px; animation-duration: 23s; animation-delay: 0.5s; --drift: -45px; }
        .particle:nth-child(17) { left: 85%; width: 8px; height: 8px; animation-duration: 25s; animation-delay: 7.5s; --drift: 35px; }
        .particle:nth-child(18) { left: 95%; width: 9px; height: 9px; animation-duration: 24s; animation-delay: 9.5s; --drift: -40px; }
        .particle:nth-child(19) { left: 5%; width: 7px; height: 7px; animation-duration: 21s; animation-delay: 13s; --drift: 50px; }
        .particle:nth-child(20) { left: 12%; width: 8px; height: 8px; animation-duration: 26s; animation-delay: 3.5s; --drift: -35px; }
        
        /* Page Loader Styles */
        #page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }
        
        #page-loader.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }
        
        .loader-content {
            text-align: center;
        }
        
        .loader-logo {
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            animation: pulse 2s ease-in-out infinite;
        }
        
        .loader-text {
            font-size: 24px;
            font-weight: bold;
            color: #B8860B;
            margin-bottom: 20px;
        }
        
        .loader-spinner {
            width: 50px;
            height: 50px;
            margin: 0 auto;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #FFD700;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
        }
    </style>
    @stack('styles')

</head>
<body class="bg-white antialiased">
    <!-- Page Loader -->
    <div id="page-loader">
        <div class="loader-content">
            <img src="{{ asset('icon.png') }}" alt="Golden Sky Hotel" class="loader-logo">
            <div class="loader-text">Golden Sky</div>
            <div class="loader-spinner"></div>
        </div>
    </div>


    <!-- Subtle Gold Particles Background -->
    <div class="particles-container">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Navigation -->
    <nav class="absolute top-0 left-0 right-0 z-50 backdrop-blur-sm" x-data="{ mobileMenuOpen: false }">
        <!-- Subtle shadow for depth -->
        <div class="absolute inset-x-0 bottom-0 h-px bg-gradient-to-r from-transparent via-white/30 to-transparent"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                <!-- Logo Section -->
                <div class="flex items-center min-w-0">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 sm:space-x-3 group">
                        <div class="relative flex-shrink-0">
                            <div class="absolute inset-0 bg-white/40 rounded-full blur-lg group-hover:bg-white/60 transition duration-300"></div>
                            <img src="{{ asset('icon.png') }}" alt="Golden Sky Hotel" class="relative h-10 w-10 sm:h-12 sm:w-12 md:h-14 md:w-14 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 drop-shadow-lg">
                        </div>
                        <div class="min-w-0">
                            <span class="text-lg sm:text-xl md:text-2xl font-bold text-white drop-shadow-lg truncate block">Golden Sky</span>
                            <span class="block text-[10px] sm:text-xs text-white/90 tracking-widest uppercase font-semibold drop-shadow">Hotel & Wellness</span>
                        </div>
                    </a>
                </div>
                
                <!-- Desktop Navigation Links (hidden on mobile) -->
                <div class="hidden md:flex items-center space-x-2">
                    <a href="{{ route('home') }}" class="text-white hover:text-gold px-4 py-2 text-sm font-bold transition-all duration-300 relative group drop-shadow-md">
                        <span>Home</span>
                        <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gold transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>
                    <a href="{{ route('rooms.index') }}" class="text-white hover:text-gold px-4 py-2 text-sm font-bold transition-all duration-300 relative group drop-shadow-md">
                        <span>Rooms</span>
                        <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gold transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>
                    <a href="{{ route('spa.home') }}" target="_blank" rel="noopener noreferrer" class="text-white hover:text-gold px-4 py-2 text-sm font-bold transition-all duration-300 relative group drop-shadow-md">
                        <span>Spa</span>
                        <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gold transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>
                    <a href="{{ route('menu.index') }}" class="text-white hover:text-gold px-4 py-2 text-sm font-bold transition-all duration-300 relative group drop-shadow-md">
                        <span>Menu</span>
                        <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gold transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>
                    @auth
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open" class="flex items-center space-x-2 text-white hover:text-gold px-4 py-2 text-sm font-bold focus:outline-none transition-all duration-300 drop-shadow-md">
                                <div class="w-9 h-9 bg-gradient-to-br from-gold to-gold-dark rounded-full flex items-center justify-center shadow-lg border-2 border-white/50">
                                    <span class="text-sm font-bold text-white">{{ strtoupper(substr(explode(' ', auth()->user()->name)[0], 0, 1)) }}</span>
                                </div>
                                <span>{{ explode(' ', auth()->user()->name)[0] }}</span>
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <!-- Dropdown Card -->
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-2xl border-2 border-gold/20 z-50 overflow-hidden"
                                 style="display: none;">
                                <div class="py-2">
                                    <!-- User Info with Gold Header -->
                                    <div class="px-4 py-4 bg-gradient-to-r from-gold-dark to-gold">
                                        <p class="text-sm font-bold text-white">{{ auth()->user()->name }}</p>
                                        <p class="text-xs text-white/80 mt-1">{{ auth()->user()->email }}</p>
                                    </div>
                                    
                                    <!-- Menu Items -->
                                    <div class="px-2 py-2">
                                        <a href="{{ route('profile') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gold-light hover:text-gray-900 rounded-lg transition duration-150">
                                            <svg class="w-5 h-5 mr-3 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <span>View Profile</span>
                                        </a>
                                    </div>
                                    
                                    <!-- Logout Button -->
                                    <div class="px-2 py-2 border-t border-gray-200">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="w-full flex items-center text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 rounded-lg transition duration-150">
                                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                                </svg>
                                                <span>Logout</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-gold px-4 py-2 text-sm font-bold transition-all duration-300 relative group drop-shadow-md">
                            <span>Login</span>
                            <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gold transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                        </a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-gold to-gold-dark hover:from-gold-dark hover:to-gold text-white px-6 py-2.5 rounded-lg text-sm font-bold transition-all duration-300 transform hover:scale-105 shadow-xl border-2 border-white/30">
                            Register
                        </a>
                    @endauth
                </div>
                
                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="text-white hover:text-gold p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-gold/50" aria-label="Toggle menu">
                        <svg x-show="!mobileMenuOpen" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu panel -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden absolute top-full left-0 right-0 bg-white/95 backdrop-blur-xl border-b border-white/20 shadow-xl"
             style="display: none;">
            <div class="max-w-7xl mx-auto px-4 py-4 space-y-1">
                <a href="{{ route('home') }}" class="block text-gray-800 hover:bg-gold/10 hover:text-gold-dark px-4 py-3 rounded-lg font-semibold transition">Home</a>
                <a href="{{ route('rooms.index') }}" class="block text-gray-800 hover:bg-gold/10 hover:text-gold-dark px-4 py-3 rounded-lg font-semibold transition">Rooms</a>
                <a href="{{ route('spa.home') }}" target="_blank" rel="noopener noreferrer" class="block text-gray-800 hover:bg-gold/10 hover:text-gold-dark px-4 py-3 rounded-lg font-semibold transition">Spa</a>
                <a href="{{ route('menu.index') }}" class="block text-gray-800 hover:bg-gold/10 hover:text-gold-dark px-4 py-3 rounded-lg font-semibold transition">Menu</a>
                @auth
                    <div class="pt-2 mt-2 border-t border-gray-200">
                        <p class="px-4 py-2 text-sm text-gray-500">{{ auth()->user()->name }}</p>
                        <a href="{{ route('profile') }}" class="block text-gray-800 hover:bg-gold/10 hover:text-gold-dark px-4 py-3 rounded-lg font-semibold transition">View Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left text-red-600 hover:bg-red-50 px-4 py-3 rounded-lg font-semibold transition">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="pt-2 mt-2 border-t border-gray-200 flex flex-col gap-2">
                        <a href="{{ route('login') }}" class="block text-center text-gray-800 hover:bg-gold/10 hover:text-gold-dark px-4 py-3 rounded-lg font-semibold transition">Login</a>
                        <a href="{{ route('register') }}" class="block text-center bg-gradient-to-r from-gold to-gold-dark text-white px-4 py-3 rounded-lg font-bold transition">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 m-4 rounded">
            <p class="font-bold">Success!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('warning'))
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 m-4 rounded">
            <p class="font-bold">Warning!</p>
            <p>{{ session('warning') }}</p>
        </div>
    @endif

    <!-- Error Dialog Modal -->
    @if(session('error'))
    <div id="errorModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-data="{ show: true }" x-show="show" x-cloak @click.away="show = false" @keydown.escape.window="show = false">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 transform transition-all" @click.stop x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
            <!-- Modal Header -->
            <div class="bg-red-600 text-white px-6 py-4 rounded-t-xl flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-bold">Error</h3>
                </div>
                <button @click="show = false" class="text-white hover:text-red-200 transition-colors focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="px-6 py-4">
                <p class="text-gray-800 text-base leading-relaxed">{{ session('error') }}</p>
            </div>
            
            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 rounded-b-xl flex justify-end">
                <button @click="show = false" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    OK
                </button>
            </div>
        </div>
    </div>
    <script>
        // Auto-close error modal after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const errorModal = document.getElementById('errorModal');
                if (errorModal) {
                    const alpineData = Alpine.$data(errorModal);
                    if (alpineData && alpineData.show) {
                        alpineData.show = false;
                    }
                }
            }, 5000);
        });
    </script>
    @endif

    <!-- Main Content -->
    <main class="relative z-10">
        @yield('content')
    </main>

    <!-- AI Chatbot Widget -->
    <x-chatbot />

    <!-- Footer -->
    <footer class="bg-gradient-to-b from-gold-dark to-yellow-700 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About Section -->
                <div class="col-span-1">
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="{{ asset('icon.png') }}" alt="Golden Sky Hotel" class="h-10 w-10">
                        <h3 class="text-xl font-bold text-white">Golden Sky</h3>
                    </div>
                    <p class="text-white text-opacity-90 text-sm leading-relaxed">
                        Experience luxury and tranquility at Golden Sky Hotel & Wellness. 
                        Your perfect retreat awaits with world-class amenities and exceptional service.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="col-span-1">
                    <h3 class="text-lg font-bold text-white mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-white text-opacity-80 hover:text-white transition duration-300">Home</a></li>
                        <li><a href="{{ route('rooms.index') }}" class="text-white text-opacity-80 hover:text-white transition duration-300">Our Rooms</a></li>
                        <li><a href="{{ route('menu.index') }}" class="text-white text-opacity-80 hover:text-white transition duration-300">Restaurant Menu</a></li>
                        @auth
                            <li><a href="{{ route('profile') }}" class="text-white text-opacity-80 hover:text-white transition duration-300">My Profile</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-white text-opacity-80 hover:text-white transition duration-300">Login</a></li>
                            <li><a href="{{ route('register') }}" class="text-white text-opacity-80 hover:text-white transition duration-300">Register</a></li>
                        @endauth
                    </ul>
                </div>

                <!-- Contact Information -->
                <div class="col-span-1">
                    <h3 class="text-lg font-bold text-white mb-4">Contact Us</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-white mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-white text-opacity-80">53/1, Hanthane Housing Scheme, Hanthane, Kandy</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-white mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <a href="tel:+94714831035" class="text-white text-opacity-80 hover:text-white transition duration-300">+94 71 483 1035</a>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-white mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <a href="mailto:reservations@goldenskyhotelandwellness.com" class="text-white text-opacity-80 hover:text-white transition duration-300">reservations@goldenskyhotelandwellness.com</a>
                        </li>
                    </ul>
                </div>

                <!-- Hours & Social -->
                <div class="col-span-1">
                    <h3 class="text-lg font-bold text-white mb-4">Opening Hours</h3>
                    <ul class="space-y-2 text-sm text-white text-opacity-80 mb-6">
                        <li>Check-in: 2:00 PM - 11:00 PM</li>
                        <li>Check-out: Until 11:00 AM</li>
                        <li>Front Desk: 24/7</li>
                        <li>Restaurant: 7:00 AM - 11:00 PM</li>
                    </ul>
                    
                    <!-- Google Reviews Badge -->
                    <div class="mb-6">
                        <a href="{{ route('home') }}#reviews" class="inline-flex items-center space-x-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-lg px-4 py-3 transition-all duration-300 border border-white/20 hover:border-white/40 group">
                            <div class="flex items-center space-x-1">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 text-gold" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                            </div>
                            <div class="text-left">
                                <div class="text-sm font-bold text-white">{{ config('reviews.overall_rating', 4.9) }} rating</div>
                                <div class="text-xs text-white/80">{{ config('reviews.total_reviews', 45) }} reviews</div>
                            </div>
                            <svg class="w-4 h-4 text-white/60 group-hover:text-white group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    
                    <h3 class="text-lg font-bold text-white mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white text-opacity-80 hover:text-white transition duration-300" aria-label="Facebook">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-white text-opacity-80 hover:text-white transition duration-300" aria-label="Instagram">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-white text-opacity-80 hover:text-white transition duration-300" aria-label="Twitter">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-yellow-600 border-opacity-30 mt-6 sm:mt-8 pt-6 sm:pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 md:gap-0 text-center md:text-left">
                    <p class="text-sm text-white text-opacity-80">
                        <span id="copyright-symbol" class="cursor-pointer select-none">©</span> {{ date('Y') }} Golden Sky Hotel & Wellness. All rights reserved.
                    </p>
                    <div class="flex space-x-6 text-sm">
                        <a href="#" class="text-white text-opacity-70 hover:text-white transition duration-300">Privacy Policy</a>
                        <a href="#" class="text-white text-opacity-70 hover:text-white transition duration-300">Terms of Service</a>
                        <a href="#" class="text-white text-opacity-70 hover:text-white transition duration-300">Cancellation Policy</a>
                    </div>
                    <p class="text-xs text-white text-opacity-60">
                        Powered by <span class="text-white font-semibold">Forge Digital Solutions</span>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
    
    <!-- Page Loader - Hide after page loads -->
    <script>
        window.addEventListener('load', function() {
            const pageLoader = document.getElementById('page-loader');
            if (pageLoader) {
                // Fade out the loader
                setTimeout(function() {
                    pageLoader.classList.add('hidden');
                    // Remove from DOM after animation completes
                    setTimeout(function() {
                        pageLoader.remove();
                    }, 500);
                }, 300); // Small delay to ensure smooth transition
            }
        });
        
        // Fallback: Hide loader if page loads very quickly
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const pageLoader = document.getElementById('page-loader');
                if (pageLoader && !pageLoader.classList.contains('hidden')) {
                    // If still visible after 1 second, hide it anyway
                    setTimeout(function() {
                        if (pageLoader && !pageLoader.classList.contains('hidden')) {
                            pageLoader.classList.add('hidden');
                            setTimeout(function() {
                                if (pageLoader) pageLoader.remove();
                            }, 500);
                        }
                    }, 1000);
                }
            }, 100);
        });
    </script>
    
    <!-- Hidden Admin Panel Access -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const copyrightSymbol = document.getElementById('copyright-symbol');
            if (copyrightSymbol) {
                copyrightSymbol.addEventListener('dblclick', function() {
                    window.location.href = '{{ route('admin.login') }}';
                });
            }
        });
    </script>
    
    <!-- Subtle Scroll Reveal Animation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                    }
                });
            }, observerOptions);
            
            // Observe all scroll-reveal elements
            document.querySelectorAll('.scroll-reveal').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</body>
</html>






