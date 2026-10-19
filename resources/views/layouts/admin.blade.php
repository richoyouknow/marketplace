<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - ALLWEAR FASHION')</title>
    
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col font-sans">

    <!-- Top Admin Header -->
    <header class="bg-gray-900 text-white border-b border-gray-800 sticky top-0 z-40">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 font-bold text-lg text-white">
                        <span class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white font-black text-sm">A</span>
                        <span>ALLWEAR <span class="text-primary text-xs font-semibold px-2 py-0.5 bg-primary/20 rounded ml-1">Admin Panel</span></span>
                    </a>
                    
                    <nav class="hidden md:flex items-center gap-1 ml-6 text-sm">
                        <a href="{{ route('admin.products.index') }}" class="px-3 py-1.5 rounded-lg font-medium transition {{ request()->routeIs('admin.products.*') || request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-800/60' }}">
                            <i data-lucide="layers" class="w-4 h-4 inline mr-1 text-primary"></i> Kelola Variasi Ukuran
                        </a>
                    </nav>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-lg bg-gray-800 hover:bg-gray-700 text-gray-200 transition">
                        <i data-lucide="external-link" class="w-3.5 h-3.5 text-primary"></i>
                        <span>Lihat Toko</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Admin Content -->
    <main class="flex-1 py-8">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Toast / Session Alerts -->
            @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center gap-3 text-emerald-800 text-sm font-medium shadow-xs">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 shrink-0"></i>
                <div class="flex-1">{{ session('success') }}</div>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-center gap-3 text-red-800 text-sm font-medium shadow-xs">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 shrink-0"></i>
                <div class="flex-1">{{ session('error') }}</div>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-800 text-sm shadow-xs">
                <div class="font-bold flex items-center gap-2 mb-1">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-red-600"></i>
                    <span>Terdapat kesalahan pada input:</span>
                </div>
                <ul class="list-disc list-inside space-y-0.5 text-xs text-red-700">
                    @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 py-4 text-center text-xs text-gray-500">
        ALLWEAR FASHION — Product Size Variant Management System &copy; {{ date('Y') }}
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
        document.addEventListener('alpine:initialized', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
</body>
</html>
