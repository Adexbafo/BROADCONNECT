<div class="flex items-center space-x-4">
    @if(session()->has('bcid_id'))
        <!-- STATE 3: FULL USER PROFILE -->
        <div class="flex items-center space-x-3 bg-white/50 backdrop-blur-md border border-slate-200 px-4 py-2 rounded-2xl shadow-sm hover:shadow-md transition-all">
            <div class="w-8 h-8 bg-gradient-to-tr from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center text-white text-[10px] font-black shadow-inner">
                {{ strtoupper(substr(session('handle'), 0, 1)) }}
            </div>
            <div class="flex flex-col">
                <span class="text-[10px] font-black text-slate-900 tracking-tighter italic leading-none">@ {{ session('handle') }}</span>
                <span class="text-[8px] font-bold text-blue-600 uppercase tracking-widest mt-1">Citizen</span>
            </div>
            <button wire:click="logout" class="ml-2 text-slate-400 hover:text-red-500 transition-colors">
                <i class="fa-solid fa-arrow-right-from-bracket text-[10px]"></i>
            </button>
        </div>
    @elseif(session()->has('pending_wallet'))
        <!-- STATE 2: WALLET CONNECTED (AWAITING MINT) -->
        <div class="flex items-center space-x-3 bg-amber-50/80 backdrop-blur-sm border border-amber-200 px-4 py-2 rounded-2xl animate-pulse">
            <div class="relative">
                <div class="w-2 h-2 bg-amber-500 rounded-full"></div>
                <div class="absolute inset-0 w-2 h-2 bg-amber-500 rounded-full animate-ping"></div>
            </div>
            <span class="text-[10px] font-mono font-bold text-amber-800">
                {{ Str::limit(session('pending_wallet'), 6) }}...{{ Str::limit(session('pending_wallet'), -4) }}
            </span>
            <span class="text-[8px] font-black text-amber-600 uppercase tracking-widest px-2 py-0.5 bg-amber-100 rounded-full">Awaiting Mint</span>
        </div>
    @else
        <!-- STATE 1: DISCONNECTED -->
        <button onclick="connectWallet()" class="group relative flex items-center space-x-3 bg-slate-900 text-white px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-[0.15em] hover:bg-blue-600 transition-all active:scale-95 shadow-xl shadow-blue-900/10">
            <i class="fa-solid fa-wallet group-hover:rotate-12 transition-transform"></i>
            <span>Connect Wallet</span>
        </button>
    @endif
</div>