<div class="flex items-center space-x-4">
    @if(session()->has('bcid_id'))
        <!-- STATE 3: FULL USER PROFILE -->
        <a href="/profile" class="flex items-center space-x-3 bg-black text-white px-4 py-2 rounded-full shadow-lg transition hover:scale-105">
            <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center text-[10px] font-black">
                {{ strtoupper(substr(session('handle'), 0, 1)) }}
            </div>
            <span class="text-xs font-black tracking-tighter italic">@ {{ session('handle') }}</span>
        </a>
    @elseif(session()->has('pending_wallet'))
        <!-- STATE 2: WALLET CONNECTED (AWAITING MINT) -->
        <div class="flex items-center space-x-2 bg-amber-50 border border-amber-200 px-4 py-2 rounded-full border-dashed">
            <div class="w-2 h-2 bg-amber-500 rounded-full animate-ping"></div>
            <span class="text-[10px] font-mono font-bold text-amber-700">
                {{ Str::limit(session('pending_wallet'), 6) }}...{{ Str::limit(session('pending_wallet'), -4) }}
            </span>
            <span class="text-[9px] font-black text-amber-500 uppercase ml-2">Pending Mint</span>
        </div>
    @else
        <!-- STATE 1: DISCONNECTED -->
        <button onclick="connectWallet()" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl font-bold text-xs hover:bg-blue-700 transition active:scale-95 flex items-center space-x-2">
            <i class="fas fa-wallet text-[10px]"></i>
            <span>CONNECT WALLET</span>
        </button>
    @endif
</div>