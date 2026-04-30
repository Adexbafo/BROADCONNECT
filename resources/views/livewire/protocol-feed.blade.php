<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Sidebar (Stats) -->
        <div class="hidden lg:block lg:col-span-3 space-y-6">
            <div class="glass p-6 rounded-[2rem] border border-white/40 sticky top-28">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white">
                        <i class="fa-solid fa-chart-line text-xs"></i>
                    </div>
                    <h3 class="font-black text-xs uppercase tracking-widest text-slate-900">Protocol Activity</h3>
                </div>

                <div class="space-y-6">
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Treasury</p>
                        <p class="text-xl font-black text-slate-900">$314.25</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Verified Citizens</p>
                        <p class="text-xl font-black text-slate-900">1,204</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Network Health</p>
                        <div class="flex items-center space-x-2">
                            <span class="text-xl font-black text-green-600">99.9%</span>
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-slate-100">
                    <button class="w-full py-3 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 transition-colors">
                        View Analytics
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Feed -->
        <div class="lg:col-span-6 space-y-6">
            <!-- Main Input Box -->
            <div class="glass p-6 rounded-[2rem] border border-white/40 shadow-sm transition-all focus-within:shadow-xl focus-within:shadow-blue-500/5">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-tr from-slate-800 to-slate-900 rounded-2xl flex-shrink-0 flex items-center justify-center text-white text-lg font-black shadow-lg">
                        {{ strtoupper(substr(session('handle', 'B'), 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <textarea 
                            wire:model="content" 
                            placeholder="Broadcast a vibe to the protocol..." 
                            class="w-full bg-transparent border-none focus:ring-0 text-base font-medium text-slate-900 placeholder:text-slate-400 resize-none min-h-[100px]"
                        ></textarea>
                    </div>
                </div>
                <div class="flex justify-between items-center mt-4 pt-4 border-t border-slate-100">
                    <div class="flex items-center space-x-4 text-slate-400">
                        <button class="hover:text-blue-600 transition-colors"><i class="fa-regular fa-image"></i></button>
                        <button class="hover:text-blue-600 transition-colors"><i class="fa-regular fa-face-smile"></i></button>
                        <button class="hover:text-blue-600 transition-colors"><i class="fa-solid fa-code text-xs"></i></button>
                    </div>
                    <button 
                        wire:click="postVibe"
                        {{ !session()->has('bcid_id') ? 'disabled' : '' }}
                        class="bg-blue-600 text-white px-8 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-blue-700 transition-all active:scale-95 disabled:opacity-50 disabled:grayscale"
                    >
                        BROADCAST
                    </button>
                </div>
            </div>

            <!-- Feed List -->
            <div class="space-y-6">
                @foreach($broadcasts as $post)
                    <div class="glass p-8 rounded-[2.5rem] border border-white/40 shadow-sm hover:shadow-md transition-all group" wire:key="post-{{ $post->id }}">
                        <!-- User Header -->
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-slate-900 text-sm font-black shadow-sm border border-slate-100 group-hover:scale-110 transition-transform">
                                    {{ strtoupper(substr($post->bcid->handle, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="flex items-center space-x-2">
                                        <p class="font-black text-slate-900 tracking-tight leading-none">@ {{ $post->bcid->handle }}</p>
                                        <i class="fa-solid fa-circle-check text-blue-500 text-[10px]"></i>
                                    </div>
                                    <p class="text-[9px] text-slate-400 font-bold uppercase mt-1.5 tracking-widest">BCID-{{ str_pad($post->bcid->sequence_number, 4, '0', STR_PAD_LEFT) }} • {{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <button class="text-slate-300 hover:text-slate-600 transition-colors">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                        </div>

                        <!-- Post Content -->
                        <p class="text-slate-700 text-base leading-relaxed mb-8 font-medium">{{ $post->content }}</p>

                        <!-- Action Bar -->
                        <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                            <div class="flex items-center space-x-10">
                                <!-- Like -->
                                <button wire:click="toggleLike({{ $post->id }})" class="flex items-center space-x-2.5 transition-all {{ $post->likes->where('bcid_id', session('bcid_id'))->count() ? 'text-red-500' : 'text-slate-400 hover:text-red-500' }}">
                                    <div class="relative">
                                        <i class="fa-{{ $post->likes->where('bcid_id', session('bcid_id'))->count() ? 'solid' : 'regular' }} fa-heart"></i>
                                        @if($post->likes->where('bcid_id', session('bcid_id'))->count())
                                            <div class="absolute inset-0 bg-red-500 blur-md opacity-20 scale-150"></div>
                                        @endif
                                    </div>
                                    <span class="text-[10px] font-black uppercase tracking-widest">{{ $post->likes->count() }}</span>
                                </button>

                                <!-- Reply -->
                                <button wire:click="setReply({{ $post->id }})" class="flex items-center space-x-2.5 text-slate-400 hover:text-blue-500 transition-all">
                                    <i class="fa-regular fa-comment"></i>
                                    <span class="text-[10px] font-black uppercase tracking-widest">{{ $post->replies->count() }}</span>
                                </button>

                                <!-- Rebroadcast -->
                                <button wire:click="rebroadcast({{ $post->id }})" class="flex items-center space-x-2.5 text-slate-400 hover:text-green-500 transition-all">
                                    <i class="fa-solid fa-retweet"></i>
                                    <span class="text-[10px] font-black uppercase tracking-widest">{{ $post->interactions->where('type', 'rebroadcast')->count() }}</span>
                                </button>
                            </div>

                            <button class="text-slate-400 hover:text-indigo-600 transition-all">
                                <i class="fa-regular fa-bookmark"></i>
                            </button>
                        </div>

                        <!-- Reply Input -->
                        @if($replyingTo == $post->id)
                            <div class="mt-6 p-6 bg-slate-50 rounded-3xl border border-slate-100 animate-in slide-in-from-top-4">
                                <textarea 
                                    wire:model="replyContent" 
                                    placeholder="Write your reply..." 
                                    class="w-full bg-transparent border-none focus:ring-0 text-sm font-medium text-slate-900"
                                    rows="2"
                                ></textarea>
                                <div class="flex justify-end mt-4">
                                    <button wire:click="postReply({{ $post->id }})" class="bg-slate-900 text-white px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-blue-600 transition-all">
                                        REPLY
                                    </button>
                                </div>
                            </div>
                        @endif

                        <!-- Replies Display -->
                        @if($post->replies->count() > 0)
                            <div class="mt-6 space-y-4 pl-6 border-l-2 border-slate-100">
                                @foreach($post->replies->take(3) as $reply)
                                    <div class="flex items-start space-x-3 text-sm" wire:key="reply-{{ $reply->id }}">
                                        <div class="w-6 h-6 bg-slate-100 rounded-lg flex-shrink-0 flex items-center justify-center text-[8px] font-black">
                                            {{ strtoupper(substr($reply->bcid->handle, 0, 1)) }}
                                        </div>
                                        <div>
                                            <span class="font-black text-slate-900 text-xs">@ {{ $reply->bcid->handle }}</span>
                                            <p class="text-slate-600 mt-1 text-xs">{{ $reply->content }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $broadcasts->links() }}
            </div>
        </div>

        <!-- Right Sidebar (Trending) -->
        <div class="hidden lg:block lg:col-span-3 space-y-6">
            <div class="glass p-6 rounded-[2rem] border border-white/40 sticky top-28">
                <h3 class="font-black text-xs uppercase tracking-widest text-slate-900 mb-6 flex items-center space-x-2">
                    <i class="fa-solid fa-fire text-orange-500"></i>
                    <span>Trending Vibes</span>
                </h3>
                
                <div class="space-y-6">
                    <div class="group cursor-pointer">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">#BaseSocial</p>
                        <p class="text-xs font-bold text-slate-900 group-hover:text-blue-600 transition-colors">4.2k Broadcasts</p>
                    </div>
                    <div class="group cursor-pointer">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">#SupraSpeed</p>
                        <p class="text-xs font-bold text-slate-900 group-hover:text-purple-600 transition-colors">1.8k Broadcasts</p>
                    </div>
                    <div class="group cursor-pointer">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">#ProofOfVibe</p>
                        <p class="text-xs font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">842 Broadcasts</p>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-slate-100">
                    <p class="text-[9px] font-bold text-slate-400 leading-relaxed">
                        BroadConnect Protocol v1.0.4<br>
                        Decentralized & Secured by Base.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>