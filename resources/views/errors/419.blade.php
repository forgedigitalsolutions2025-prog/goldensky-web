<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Expired - Golden Sky Hotel & Wellness</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-8 text-center">
        <div class="text-6xl mb-4">⏱️</div>
        <h1 class="text-xl font-bold text-gray-800 mb-2">Session expired</h1>
        <p class="text-gray-600 mb-6">Your session has expired for security. Refresh the page and try again. If you were signing in, please log in again.</p>
        <p class="text-sm text-gray-500 mb-4">If this happens every time on the hosted site, set <strong>APP_URL</strong> to your exact site URL and <strong>SESSION_DOMAIN</strong> to <code class="bg-gray-100 px-1 rounded">.yourdomain.com</code> in your host's environment variables, then redeploy.</p>
        <div class="space-y-3">
            <a href="javascript:window.location.reload()" class="block w-full py-3 px-4 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg transition">
                Refresh this page
            </a>
            <a href="{{ url('/') }}" class="block w-full py-3 px-4 border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium rounded-lg transition">
                Go to home
            </a>
            @if(request()->is('admin*'))
                <a href="{{ route('admin.login') }}" class="block w-full py-3 px-4 border border-amber-600 text-amber-700 hover:bg-amber-50 font-medium rounded-lg transition">
                    Admin login
                </a>
            @endif
        </div>
    </div>
</body>
</html>
