<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#1e40af">
    <title>@yield('title', 'Rekap Lamaran Kerja')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        [x-cloak] { display: none !important; }
        /* Smooth scrolling on mobile */
        html { scroll-behavior: smooth; -webkit-tap-highlight-color: transparent; }
        /* Better touch targets */
        select { font-size: 16px !important; } /* Prevents iOS zoom */
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navbar --> 
    <nav class="bg-gradient-to-r from-blue-800 to-indigo-900 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center h-14 sm:h-16">
                <a href="{{ route('job-applications.index') }}" class="flex items-center space-x-2 sm:space-x-3">
                    <i class="fas fa-briefcase text-white text-lg sm:text-xl"></i>
                    <span class="text-white font-bold text-base sm:text-lg tracking-wide">Rekap Lamaran Kerja</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition>
        <div class="bg-green-50 border-l-4 border-green-500 p-3 sm:p-4 rounded-r-lg shadow-sm">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                <p class="text-green-700 text-sm font-medium">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition>
        <div class="bg-red-50 border-l-4 border-red-500 p-3 sm:p-4 rounded-r-lg shadow-sm">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                <p class="text-red-700 text-sm font-medium">{{ session('error') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-3 sm:px-4 md:px-6 lg:px-8 py-4 sm:py-6 md:py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-8 sm:mt-12 py-4 sm:py-6">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-400 text-xs sm:text-sm">
            &copy; {{ date('Y') }} Rekap Lamaran Kerja. All rights reserved.
        </div>
    </footer>
</body>
</html>
