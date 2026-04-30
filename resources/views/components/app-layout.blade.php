<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @livewireStyles
</head>
<body class="bg-slate-50 font-sans">
    <!-- Navigation Bar -->
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
            <!-- Logo & Brand -->
            <a href="/" class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-black rounded-lg flex items-center justify-center">
                    <span class="text-white font-black italic">B</span>
                </div>
                <span class="font-black text-xl tracking-tighter uppercase">BroadConnect</span>
            </a>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-8 text-xs font-bold uppercase tracking-widest text-gray-500">
                <a href="/feed" class="hover:text-black transition">Feed</a>
                <a href="/agent/logs" class="hover:text-black transition italic">Transparency Log</a>
            </div>

            <!-- Wallet Auth Area -->
            @livewire('wallet-auth')
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>