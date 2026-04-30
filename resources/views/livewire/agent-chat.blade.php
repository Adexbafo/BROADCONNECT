<div class="fixed bottom-6 right-6 z-50">
    <!-- Floating Button -->
    <button wire:click="toggleChat" class="bg-black text-white p-4 rounded-full shadow-2xl hover:scale-110 transition active:scale-95">
        <i class="fas fa-robot text-xl"></i>
    </button>

    @if($isOpen)
        <div class="absolute bottom-20 right-0 w-80 bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden flex flex-col h-96">
            <div class="bg-black p-4 text-white font-bold italic text-sm">
                BROADER_AGENT_V1.0
            </div>
            
            <!-- Chat Messages -->
            <div class="flex-1 p-4 overflow-y-auto space-y-3 bg-gray-50">
                @foreach($chatHistory as $chat)
                    <div class="{{ $chat['role'] == 'user' ? 'text-right' : 'text-left' }}">
                        <span class="inline-block px-4 py-2 rounded-2xl text-xs {{ $chat['role'] == 'user' ? 'bg-blue-600 text-white' : 'bg-white text-gray-800 border border-gray-100' }}">
                            {{ $chat['text'] }}
                        </span>
                    </div>
                @endforeach
            </div>

            <!-- Input -->
            <div class="p-3 border-t bg-white flex">
                <input wire:model.defer="message" wire:keydown.enter="sendMessage" type="text" placeholder="Ask the protocol..." class="flex-1 border-none focus:ring-0 text-xs">
                <button wire:click="sendMessage" class="text-blue-600 px-2">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    @endif
</div>