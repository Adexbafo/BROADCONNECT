<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BroadConnect | Decentralized Social Protocol</title>
    
    <!-- Premium Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Ethers.js for Web3 -->
    <script src="https://cdn.ethers.io/lib/ethers-5.7.2.umd.min.js" type="application/javascript"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at top right, #f8fafc, #eff6ff);
            min-height: 100vh;
        }
        h1, h2, h3, .font-heading {
            font-family: 'Outfit', sans-serif;
        }
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
    @livewireStyles
</head>
<body class="text-slate-900">
    <!-- Navigation Bar -->
    <nav class="glass sticky top-0 z-50 border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex justify-between items-center">
            <!-- Logo & Brand -->
            <a href="/" class="flex items-center space-x-3 group">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl flex items-center justify-center shadow-lg group-hover:rotate-6 transition-transform">
                    <span class="text-white font-black italic text-lg">B</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-black text-xl tracking-tight uppercase leading-none">BroadConnect</span>
                    <span class="text-[9px] font-bold text-blue-600 tracking-[0.2em] uppercase">Social Protocol</span>
                </div>
            </a>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-10 text-[11px] font-black uppercase tracking-widest text-slate-500">
                <a href="/feed" class="hover:text-blue-600 transition flex items-center space-x-2">
                    <i class="fa-solid fa-rss text-[10px]"></i>
                    <span>Protocol Feed</span>
                </a>
                <a href="/agent/logs" class="hover:text-blue-600 transition flex items-center space-x-2">
                    <i class="fa-solid fa-shield-halved text-[10px]"></i>
                    <span>Transparency</span>
                </a>
            </div>

            <!-- Wallet Auth Area -->
            <div class="flex items-center">
                @livewire('wallet-auth')
            </div>
        </div>
    </nav>

    <main class="py-10">
        {{ $slot }}
    </main>

    @livewireScripts
    
    <script>
        async function connectWallet() {
            if (typeof window.ethereum !== 'undefined') {
                try {
                    const accounts = await window.ethereum.request({ method: 'eth_requestAccounts' });
                    const address = accounts[0];
                    
                    // Call Livewire login
                    window.Livewire.find(
                        document.querySelector('[wire\\:id]').getAttribute('wire:id')
                    ).call('login', address);
                    
                } catch (error) {
                    console.error("User denied account access", error);
                }
            } else {
                alert('Please install MetaMask or another Web3 wallet!');
            }
        }
    </script>
</body>
</html>