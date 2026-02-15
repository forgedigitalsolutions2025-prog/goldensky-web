<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#1e293b">
    <title>@yield('title', 'Owner\'s Portal') - Golden Sky Hotel & Wellness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('head')
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'gold': '#D4AF37',
                        'gold-dark': '#B8860B',
                        'gold-light': '#F5E6C8',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                        'card': '0 1px 3px 0 rgba(0, 0, 0, 0.06), 0 1px 2px -1px rgba(0, 0, 0, 0.04)',
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        html { scroll-behavior: smooth; }
        body { font-feature-settings: 'cv02', 'cv03', 'cv04', 'cv11'; }
        @media (max-width: 1023px) {
            .admin-sidebar { transform: translateX(-100%); }
            .sidebar-open .admin-sidebar { transform: translateX(0) !important; }
            body.sidebar-open { overflow: hidden !important; }
        }
        @media (min-width: 1024px) {
            .admin-sidebar { transform: translateX(0) !important; }
        }
        .admin-sidebar { transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1); }
        .nav-link { min-height: 44px; display: flex; align-items: center; }
        .table-responsive { -webkit-overflow-scrolling: touch; }
        @media (max-width: 640px) {
            .stat-value { font-size: 1.5rem; }
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen antialiased text-gray-800">
    <!-- Top bar -->
    <header class="fixed top-0 left-0 right-0 z-40 h-14 bg-slate-800 text-white shadow-lg flex items-center justify-between px-4 sm:px-6">
        <div class="flex items-center gap-3 min-w-0">
            <button type="button" id="sidebar-toggle" class="lg:hidden flex-shrink-0 p-2.5 -ml-1 rounded-lg hover:bg-white/10 transition active:bg-white/20" aria-label="Toggle menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h1 class="text-base sm:text-lg font-semibold truncate">Owner's Portal</h1>
        </div>
        <div class="flex items-center gap-2 sm:gap-4 flex-shrink-0">
            <span class="text-xs sm:text-sm text-slate-300 hidden sm:inline truncate max-w-[120px] sm:max-w-none">Golden Sky Hotel & Wellness</span>
            <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                @csrf
                <button type="submit" class="px-3 py-2 sm:px-4 rounded-lg text-sm font-medium bg-white/10 hover:bg-white/20 transition active:bg-white/25">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <!-- Sidebar overlay (mobile) -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-30 hidden lg:hidden" aria-hidden="true"></div>

    <!-- Sidebar -->
    <aside id="admin-sidebar" class="admin-sidebar fixed top-14 left-0 bottom-0 w-64 bg-slate-800 text-white shadow-2xl z-30 flex flex-col">
        <nav class="flex-1 overflow-y-auto py-4 px-2">
            <div class="mb-6 px-2">
                <a href="{{ route('admin.dashboard') }}" class="nav-link gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-gold-dark text-white' : 'text-slate-300 hover:bg-slate-700/80 hover:text-white' }} transition">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="px-3 mb-2">
                <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Financials</p>
            </div>
            <div class="space-y-0.5 px-2">
                <a href="{{ route('admin.revenue') }}" class="nav-link gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.revenue*') ? 'bg-gold-dark text-white' : 'text-slate-300 hover:bg-slate-700/80 hover:text-white' }} transition">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Revenue</span>
                </a>
                <a href="{{ route('admin.expenses') }}" class="nav-link gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.expenses*') ? 'bg-gold-dark text-white' : 'text-slate-300 hover:bg-slate-700/80 hover:text-white' }} transition">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span>Expenses</span>
                </a>
            </div>
            <div class="px-3 mt-6 mb-2">
                <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Operations</p>
            </div>
            <div class="space-y-0.5 px-2">
                <a href="{{ route('admin.inventory-requests') }}" class="nav-link gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.inventory-requests*') ? 'bg-gold-dark text-white' : 'text-slate-300 hover:bg-slate-700/80 hover:text-white' }} transition">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <span>Inventory Requests</span>
                </a>
                <a href="{{ route('admin.stock-availability') }}" class="nav-link gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.stock-availability*') ? 'bg-gold-dark text-white' : 'text-slate-300 hover:bg-slate-700/80 hover:text-white' }} transition">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    <span>Stock Availability</span>
                </a>
                <a href="{{ route('admin.restaurant') }}" class="nav-link gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.restaurant*') ? 'bg-gold-dark text-white' : 'text-slate-300 hover:bg-slate-700/80 hover:text-white' }} transition">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                    <span>Restaurant</span>
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main content -->
    <main class="lg:ml-64 min-h-screen pt-14">
        <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
            @if(session('success'))
                <div id="alert-message" class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-medium shadow-sm" role="alert">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div id="alert-message" class="mb-4 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-sm font-medium shadow-sm" role="alert">{{ session('error') }}</div>
            @endif
            @yield('content')
        </div>
    </main>

    <script>
        (function() {
            const toggle = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const body = document.body;

            function openSidebar() {
                body.classList.add('sidebar-open');
                overlay.classList.remove('hidden');
            }
            function closeSidebar() {
                body.classList.remove('sidebar-open');
                overlay.classList.add('hidden');
            }

            if (toggle) toggle.addEventListener('click', function() {
                body.classList.contains('sidebar-open') ? closeSidebar() : openSidebar();
            });
            if (overlay) overlay.addEventListener('click', closeSidebar);
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    overlay.classList.add('hidden');
                    body.classList.remove('sidebar-open');
                }
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>
