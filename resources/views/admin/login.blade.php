<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Access - Golden Sky Hotel & Wellness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'gold': '#FFD700',
                        'gold-dark': '#B8860B',
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat relative" style="background-image: url('{{ asset('images/kandy/sri-lanka-city.jpeg') }}');">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <div class="max-w-md w-full mx-4 relative z-10 min-w-0">
        <div class="bg-white rounded-lg shadow-2xl p-6 sm:p-8">
            <!-- Logo/Title -->
            <div class="text-center mb-8">
                <div class="inline-block p-4 bg-gold rounded-full mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">Admin Access</h1>
                <p class="text-gray-600 text-sm mt-2">Golden Sky Hotel & Wellness</p>
            </div>

            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                    <p class="font-semibold">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Admin Password</label>
                    <input type="password" name="password" required autofocus
                           class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-gold focus:border-gold transition">
                </div>

                <button type="submit" class="w-full bg-gold hover:bg-gold-dark text-white font-bold py-3 px-6 rounded-lg transition duration-300 flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Access Dashboard</span>
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-gold">
                    ← Back to Website
                </a>
            </div>
        </div>

        <p class="text-center text-gray-500 text-xs mt-6">
            Authorized personnel only
        </p>
    </div>
</body>
</html>

