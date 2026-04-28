<div class="max-w-2xl mx-auto space-y-6">
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
        <textarea 
            wire:model="content" 
            placeholder="What's the vibe on the protocol?" 
            class="w-full p-4 border-none focus:ring-0 text-lg resize-none"
            rows="3"
        ></textarea>
        <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-50">
            <span class="text-xs text-gray-400 font-medium italic">Verified Citizens Only</span>
            <button 
                wire:click="postVibe"
                class="bg-black text-white px-6 py-2 rounded-full font-bold hover:bg-gray-800 transition active:scale-95"
            >
                BROADCAST
            </button>
        </div>
    </div>

    <div class="space-y-4">
        @foreach($broadcasts as $post)
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 mb-4">
        <div class="flex items-center space-x-3 mb-3">
            <div class="w-10 h-10 bg-black rounded-full flex items-center justify-center text-white text-xs font-bold">
                {{ strtoupper(substr($post->bcid->handle, 0, 1)) }}
            </div>
            <div>
                <p class="font-black text-gray-900 leading-none">@ {{ $post->bcid->handle }}</p>
                <p class="text-[10px] text-blue-500 font-bold uppercase mt-1 italic">BCID-{{ $post->bcid->sequence_number }}</p>
            </div>
        </div>

        <p class="text-gray-700 leading-relaxed mb-4">{{ $post->content }}</p>

        <div class="flex items-center space-x-8 pt-4 border-t border-gray-50 text-gray-400">
            <button wire:click="toggleLike({{ $post->id }})" class="flex items-center space-x-2 hover:text-red-500 transition">
                <i class="fa{{ $post->likes->where('bcid_id', 1)->count() ? 's' : 'r' }} fa-heart {{ $post->likes->where('bcid_id', 1)->count() ? 'text-red-500' : '' }}"></i>
                <span class="text-xs font-bold">{{ $post->likes->count() }}</span>
            </button>

            <button wire:click="rebroadcast({{ $post->id }})" 
        class="flex items-center space-x-2 hover:text-green-500 transition {{ $post->interactions->where('bcid_id', 1)->where('type', 'rebroadcast')->count() ? 'text-green-500' : '' }}">
    <i class="fas fa-retweet"></i>
    <span class="text-xs font-bold">{{ $post->interactions->where('type', 'rebroadcast')->count() }}</span>
            </button>

            <button class="flex items-center space-x-2 hover:text-blue-500 transition">
                <i class="far fa-comment"></i>
                <span class="text-xs font-bold">0</span>
            </button>
        </div>
    </div>
@endforeach
    </div>
</div>