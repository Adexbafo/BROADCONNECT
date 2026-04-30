<div class="fixed bottom-8 right-8 z-[60]">
    <!-- Floating Button -->
    <button wire:click="toggleChat" class="group relative w-16 h-16 bg-slate-900 rounded-2xl shadow-2xl flex items-center justify-center overflow-hidden transition-all hover:scale-110 active:scale-95">
        <div class="absolute inset-0 bg-gradient-to-tr from-blue-600 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <i class="fa-solid fa-robot text-xl text-white relative z-10 group-hover:rotate-12 transition-transform"></i>
        @if(!$isOpen)
            <div class="absolute -top-1 -right-1 w-4 h-4 bg-blue-500 border-2 border-white rounded-full animate-pulse"></div>
        @endif
    </button>

    @if($isOpen)
        <div class="absolute bottom-24 right-0 w-96 bg-white/90 backdrop-blur-xl rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.2)] border border-white/40 overflow-hidden flex flex-col h-[500px] transition-all animate-in slide-in-from-bottom-10">
            <!-- Header -->
            <div class="bg-slate-900 p-5 text-white flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                    <span class="font-black italic text-xs tracking-widest uppercase">BroaderAgent <span class="text-blue-400">v2.0</span></span>
                </div>
                <button wire:click="toggleChat" class="text-slate-400 hover:text-white transition-colors">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>
            
            <!-- Protocol Stats Bar -->
            <div class="bg-slate-100/50 px-5 py-2 border-b border-slate-200 flex justify-between items-center">
                <div class="flex items-center space-x-4 overflow-x-auto no-scrollbar">
                    <div class="flex items-center space-x-1 whitespace-nowrap">
                        <span class="text-[8px] font-black text-slate-400 uppercase">Health:</span>
                        <span class="text-[8px] font-black text-green-600">99.9%</span>
                    </div>
                    <div class="flex items-center space-x-1 whitespace-nowrap">
                        <span class="text-[8px] font-black text-slate-400 uppercase">Latency:</span>
                        <span class="text-[8px] font-black text-blue-600">12ms</span>
                    </div>
                </div>
            </div>

            <!-- Chat Messages -->
            <div class="flex-1 p-6 overflow-y-auto space-y-4 bg-gradient-to-b from-white to-slate-50/50">
                <div class="text-center mb-4">
                    <span class="px-3 py-1 bg-slate-200/50 rounded-full text-[8px] font-black text-slate-500 uppercase tracking-widest">Protocol Intelligence Core</span>
                </div>

                @foreach($chatHistory as $chat)
                    <div class="flex {{ $chat['role'] == 'user' ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[85%] {{ $chat['role'] == 'user' ? 'bg-blue-600 text-white rounded-2xl rounded-tr-none shadow-lg shadow-blue-600/20' : 'bg-white border border-slate-100 text-slate-800 rounded-2xl rounded-tl-none shadow-sm' }} p-4">
                            <p class="text-[11px] leading-relaxed font-medium">
                                {{ $chat['text'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Input Area -->
            <div class="p-4 bg-white border-t border-slate-100">
                <div class="relative flex items-center bg-slate-100 rounded-2xl px-4 py-1 group focus-within:bg-white focus-within:ring-2 focus-within:ring-blue-500/10 transition-all border border-transparent focus-within:border-blue-500/20">
                    <input 
                        wire:model="message" 
                        wire:keydown.enter="sendMessage" 
                        type="text" 
                        placeholder="Ask the protocol..." 
                        class="flex-1 bg-transparent border-none focus:ring-0 text-xs font-bold py-3 text-slate-900 placeholder:text-slate-400"
                    >
                    <button wire:click="sendMessage" class="ml-2 w-8 h-8 bg-slate-900 text-white rounded-xl flex items-center justify-center hover:bg-blue-600 transition-colors">
                        <i class="fa-solid fa-paper-plane text-[10px]"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>