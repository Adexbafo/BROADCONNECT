<div class="bg-white p-8 rounded-3xl shadow-2xl border border-gray-100 w-full max-w-md mx-auto">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-black tracking-tighter uppercase">Claim Your BCID</h2>
        <div class="flex justify-center space-x-2 mt-1">
            <span class="text-[10px] font-bold bg-green-100 text-green-700 px-2 py-0.5 rounded-full uppercase">Registration: FREE</span>
            <span class="text-[10px] font-bold bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full uppercase">Fee: $0.25</span>
        </div>
    </div>

    <!-- WALLET STATUS INDICATOR -->
    @if(session()->has('pending_wallet'))
        <div class="mb-6 flex items-center justify-between bg-amber-50 border border-amber-100 p-3 rounded-xl">
            <div class="flex items-center space-x-2">
                <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
                <span class="text-[10px] font-mono text-amber-800">{{ Str::limit(session('pending_wallet'), 12) }}</span>
            </div>
            <span class="text-[9px] font-black text-amber-600 uppercase">Awaiting Proof</span>
        </div>
    @endif

    <!-- INPUTS -->
    <div class="space-y-4">
        <div>
            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Username Handle</label>
            <input type="text" wire:model="handle" 
                {{ !session()->has('pending_wallet') ? 'disabled' : '' }}
                class="w-full p-4 mt-1 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold focus:ring-2 focus:ring-blue-500 transition-all {{ !session()->has('pending_wallet') ? 'opacity-50 cursor-not-allowed' : '' }}"
                placeholder="e.g. adex">
        </div>

        <div class="flex bg-gray-100 p-1 rounded-xl">
            <button wire:click="$set('network', 'Base')" class="flex-1 py-2 rounded-lg text-xs font-bold transition {{ $network == 'Base' ? 'bg-blue-600 text-white shadow-md' : 'text-gray-500' }}">Base</button>
            <button wire:click="$set('network', 'Supra')" class="flex-1 py-2 rounded-lg text-xs font-bold transition {{ $network == 'Supra' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500' }}">Supra</button>
        </div>

        <div>
            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Transaction Hash ($0.25 Proof)</label>
            <input type="text" wire:model="tx_hash" 
                {{ !session()->has('pending_wallet') ? 'disabled' : '' }}
                class="w-full p-4 mt-1 bg-gray-50 border border-gray-200 rounded-2xl text-[10px] font-mono {{ !session()->has('pending_wallet') ? 'opacity-50 cursor-not-allowed' : '' }}"
                placeholder="0x...">
        </div>
    </div>

    <!-- MINT BUTTON -->
    <button wire:click="claim" 
        {{ !session()->has('pending_wallet') ? 'disabled' : '' }}
        class="w-full mt-8 bg-black text-white py-5 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-gray-900 transition-all active:scale-95 shadow-2xl {{ !session()->has('pending_wallet') ? 'opacity-50 grayscale cursor-not-allowed' : '' }}">
        Mint Identity
    </button>
</div>