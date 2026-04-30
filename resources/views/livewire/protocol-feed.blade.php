<div>
    <div class="max-w-2xl mx-auto space-y-6">
        <!-- Main Input Box -->
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

        <!-- Feed List -->
        <div class="space-y-4">
            @foreach($broadcasts as $post)
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100" wire:key="post-{{ $post->id }}">
                    <!-- User Header -->
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-10 h-10 bg-black rounded-full flex items-center justify-center text-white text-xs font-bold">
                            {{ strtoupper(substr($post->bcid->handle, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-black text-gray-900 leading-none">@ {{ $post->bcid->handle }}</p>
                            <p class="text-[10px] text-blue-500 font-bold uppercase mt-1 italic">BCID-{{ $post->bcid->sequence_number }}</p>
                        </div>
                    </div>

                    <!-- Post Content -->
                    <p class="text-gray-700 leading-relaxed mb-4">{{ $post->content }}</p>

                    <!-- Action Bar Logic -->
                    @if(!$post->parent_id)
                        <div class="flex items-center space-x-8 pt-4 border-t border-gray-50 text-gray-400">
                            <!-- Like -->
                            <button wire:click="toggleLike({{ $post->id }})" class="flex items-center space-x-2 hover:text-red-500 transition">
                                <i class="fa{{ $post->likes->where('bcid_id', 1)->count() ? 's' : 'r' }} fa-heart {{ $post->likes->where('bcid_id', 1)->count() ? 'text-red-500' : '' }}"></i>
                                <span class="text-xs font-bold">{{ $post->likes->count() }}</span>
                            </button>

                            <!-- Reply -->
                            <button wire:click="setReply({{ $post->id }})" class="flex items-center space-x-2 hover:text-blue-500 transition">
                                <i class="far fa-comment"></i>
                                <span class="text-xs font-bold">{{ $post->replies->count() }}</span>
                            </button>

                            <!-- Rebroadcast -->
                            <button wire:click="rebroadcast({{ $post->id }})" class="flex items-center space-x-2 hover:text-green-500 transition">
                                <i class="fas fa-retweet"></i>
                                <span class="text-xs font-bold">{{ $post->interactions->where('type', 'rebroadcast')->count() }}</span>
                            </button>

                            <!-- Quote -->
                            <button wire:click="quote({{ $post->id }})" class="flex items-center space-x-2 hover:text-purple-500 transition">
                                <i class="fas fa-quote-left text-[10px]"></i>
                                <span class="text-xs font-bold">0</span>
                            </button>
                        </div>
                    @else
                        <!-- Minimal UI for Nested Replies -->
                        <div class="text-[10px] text-gray-400 italic pt-2 border-t border-gray-50">
                            Replying to @ {{ $post->parent->bcid->handle }}
                        </div>
                    @endif

                    <!-- Reply Input Area -->
                    @if($replyingTo == $post->id)
                        <div class="mt-4 p-4 bg-slate-50 rounded-2xl border border-blue-100">
                            <textarea 
                                wire:model="replyContent" 
                                placeholder="Write your reply..." 
                                class="w-full bg-transparent border-none focus:ring-0 text-sm"
                            ></textarea>
                            <div class="flex justify-end mt-2">
                                <button wire:click="postReply({{ $post->id }})" class="bg-blue-600 text-white px-4 py-1 rounded-full text-xs font-bold">
                                    REPLY
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Threaded Replies Display -->
                    @if($post->replies->count() > 0)
                        <div class="mt-4 ml-8 space-y-3 border-l-2 border-slate-100 pl-4">
                            @foreach($post->replies as $reply)
                                <div class="text-sm bg-gray-50 p-3 rounded-2xl" wire:key="reply-{{ $reply->id }}">
                                    <span class="font-bold text-black">@ {{ $reply->bcid->handle }}</span>
                                    <p class="text-gray-600">{{ $reply->content }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>