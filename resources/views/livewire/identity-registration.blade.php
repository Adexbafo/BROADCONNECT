<div class="p-4 max-w-md mx-auto bg-white rounded-xl shadow-md space-y-4 border border-gray-100 mt-10">
    <div class="text-center">
        <h2 class="text-xl font-bold text-gray-800">Claim Your BCID</h2>
        <p class="text-sm text-gray-500">Registration Fee: $5 USD</p>
    </div>

    @if($message)
        <div class="p-3 bg-green-100 text-green-700 rounded-lg text-sm font-medium">
            {{ $message }}
        </div>
    @endif

    <form wire:submit.prevent="claim" class="space-y-4">
        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase">Username Handle</label>
            <input type="text" wire:model="handle" placeholder="e.g. adex" 
                   class="w-full p-3 mt-1 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            @error('handle') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-2">
            <button type="button" wire:click="$set('network', 'base')" 
                    class="p-2 rounded-lg border {{ $network == 'base' ? 'bg-blue-600 text-white' : 'bg-white text-gray-600' }}">Base</button>
            <button type="button" wire:click="$set('network', 'supra')" 
                    class="p-2 rounded-lg border {{ $network == 'supra' ? 'bg-purple-600 text-white' : 'bg-white text-gray-600' }}">Supra</button>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase">Transaction Hash ($5 Proof)</label>
            <input type="text" wire:model="tx_hash" placeholder="0x..." 
                   class="w-full p-3 mt-1 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-xs">
            @error('tx_hash') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="w-full bg-black text-white font-bold py-4 rounded-xl shadow-lg active:scale-95 transition-transform">
            MINT IDENTITY
        </button>
    </form>
</div>