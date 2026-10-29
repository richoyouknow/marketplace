<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ALLWEAR FASHION — brand fashion resmi untuk menemukan koleksi pakaian modern berkualitas dengan harga terbaik.">
    <title>@yield('title', 'ALLWEAR FASHION - Premium E-Commerce')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Fallback icons script in case lucide bundle fails or takes time -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-[#f9fafb] text-[#171717] min-h-screen flex flex-col font-sans" x-data="{ mobileMenuOpen: false, cartDrawerOpen: false }">
    
    @include('components.header')
    @include('components.navigation')
    
    <main class="flex-grow pt-4 pb-12">
        @yield('content')
    </main>

    @include('components.footer')

    <!-- Toast Notifications -->
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
         class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-3 z-50">
        <i data-lucide="check-circle" class="w-5 h-5"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif
    
    @if(session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
         class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-3 z-50">
        <i data-lucide="alert-circle" class="w-5 h-5"></i>
        <span>{{ session('error') }}</span>
    </div>
    @endif
    
    <script>
        // Re-initialize Lucide icons when Alpine modifies the DOM if needed
        document.addEventListener('alpine:initialized', () => {
            if(window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
</body>
</html>
