<div class="glass p-10 rounded-[2.5rem] shadow-2xl border border-white/40 w-full max-w-lg mx-auto relative overflow-hidden">
    <!-- Decorative Gradient -->
    <div class="absolute -top-24 -right-24 w-48 h-48 bg-blue-500/10 blur-3xl rounded-full"></div>
    <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-indigo-500/10 blur-3xl rounded-full"></div>

    <div class="text-center mb-10 relative">
        <h2 class="text-3xl font-black tracking-tighter uppercase text-slate-900">Claim Your BCID</h2>
        <p class="text-slate-500 text-xs font-bold uppercase tracking-[0.2em] mt-2">Join the Decentralized Social Layer</p>
        
        <div class="flex justify-center space-x-3 mt-6">
            <div class="flex items-center space-x-1.5 bg-green-50 text-green-700 px-3 py-1 rounded-full border border-green-100">
                <div class="w-1.5 h-1.5 bg-green-500 rounded-full"></div>
                <span class="text-[9px] font-black uppercase">Identity: FREE</span>
            </div>
            <div class="flex items-center space-x-1.5 bg-blue-50 text-blue-700 px-3 py-1 rounded-full border border-blue-100">
                <div class="w-1.5 h-1.5 bg-blue-500 rounded-full"></div>
                <span class="text-[9px] font-black uppercase">Fee: $0.25</span>
            </div>
        </div>
    </div>

    <!-- INPUTS -->
    <div class="space-y-6 relative">
        <!-- Handle Input -->
        <div>
            <div class="flex justify-between items-end mb-2 px-1">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Username Handle</label>
                @if($handle && $isAvailable === true)
                    <span class="text-[9px] font-bold text-green-600 uppercase">Available</span>
                @elseif($handle && $isAvailable === false)
                    <span class="text-[9px] font-bold text-red-500 uppercase">Taken</span>
                @endif
            </div>
            <div class="relative group">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-sm">@</span>
                <input type="text" wire:model.live="handle" 
                    {{ !session()->has('pending_wallet') ? 'disabled' : '' }}
                    class="w-full pl-9 pr-4 py-4 bg-white/50 border border-slate-200 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none {{ !session()->has('pending_wallet') ? 'opacity-50 cursor-not-allowed' : '' }}"
                    placeholder="adex_vibes">
            </div>
            @error('handle') <p class="text-[10px] font-bold text-red-500 mt-2 px-1">{{ $message }}</p> @enderror
        </div>

        <!-- Network Toggle -->
        <div class="bg-slate-100/50 p-1.5 rounded-2xl flex border border-slate-200/50">
            <button wire:click="$set('network', 'Base')" class="flex-1 flex items-center justify-center space-x-2 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ $network == 'Base' ? 'bg-white text-blue-600 shadow-sm border border-slate-200' : 'text-slate-400 hover:text-slate-600' }}">
                <i class="fa-solid fa-cube text-[10px]"></i>
                <span>Base</span>
            </button>
            <button wire:click="$set('network', 'Supra')" class="flex-1 flex items-center justify-center space-x-2 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ $network == 'Supra' ? 'bg-white text-purple-600 shadow-sm border border-slate-200' : 'text-slate-400 hover:text-slate-600' }}">
                <i class="fa-solid fa-bolt text-[10px]"></i>
                <span>Supra</span>
            </button>
        </div>

        <!-- Automated Transaction Area -->
        <div class="bg-slate-900 rounded-3xl p-6 text-white overflow-hidden relative group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <i class="fa-solid fa-terminal text-4xl"></i>
            </div>
            
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                <span class="text-[9px] font-mono font-bold uppercase tracking-widest text-blue-400">Payment Processor</span>
            </div>

            @if(!$tx_hash)
                <button 
                    onclick="payPlatformFee()"
                    {{ !session()->has('pending_wallet') || !$isAvailable ? 'disabled' : '' }}
                    class="w-full bg-blue-600 hover:bg-blue-500 disabled:opacity-30 disabled:cursor-not-allowed py-4 rounded-xl font-black text-[10px] uppercase tracking-widest transition-all flex items-center justify-center space-x-3"
                >
                    <i class="fa-solid fa-credit-card"></i>
                    <span>Authorize $0.25 Fee</span>
                </button>
            @else
                <div class="space-y-2">
                    <p class="text-[9px] font-mono text-slate-400 uppercase">TX Confirmation Received</p>
                    <p class="text-[10px] font-mono text-green-400 break-all bg-black/40 p-3 rounded-lg border border-green-900/30">
                        {{ $tx_hash }}
                    </p>
                </div>
            @endif
        </div>
    </div>

    <!-- MINT BUTTON -->
    <button wire:click="claim" 
        {{ !$tx_hash || $isProcessing ? 'disabled' : '' }}
        class="w-full mt-10 bg-gradient-to-r from-slate-900 to-slate-800 text-white py-6 rounded-[1.5rem] font-black text-xs uppercase tracking-[0.2em] hover:shadow-2xl hover:shadow-blue-500/20 transition-all active:scale-95 disabled:opacity-30 disabled:grayscale disabled:cursor-not-allowed group"
    >
        <span class="group-hover:scale-110 transition-transform inline-block">
            {{ $isProcessing ? 'Processing...' : 'Mint Protocol Identity' }}
        </span>
    </button>

    <script>
        async function payPlatformFee() {
            if (!window.ethereum) return alert('No wallet found');
            
            try {
                const provider = new ethers.providers.Web3Provider(window.ethereum);
                const signer = provider.getSigner();
                
                // Small amount (approx $0.25 in ETH)
                const amount = ethers.utils.parseEther("0.0001"); 
                const treasury = "0x0000000000000000000000000000000000000000"; // Replace with real treasury
                
                const tx = await signer.sendTransaction({
                    to: treasury,
                    value: amount
                });
                
                // Update Livewire component with hash
                @this.set('tx_hash', tx.hash);
                
            } catch (error) {
                console.error("Payment failed", error);
                alert("Payment cancelled or failed.");
            }
        }
    </script>
</div>