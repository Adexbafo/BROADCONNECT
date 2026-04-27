<div>
    <button wire:click="toggleConnect" 
            class="w-full font-bold py-3 rounded-xl shadow-lg transition-all active:scale-95 {{ $isFollowing ? 'bg-gray-200 text-gray-700' : 'bg-blue-600 text-white shadow-blue-200' }}">
        {{ $isFollowing ? 'CONNECTED' : 'BROADCONNECT +' }}
    </button>
</div>