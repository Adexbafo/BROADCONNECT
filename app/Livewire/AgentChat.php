<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class AgentChat extends Component
{
    public $isOpen = false;
    public $message = '';
    public $chatHistory = [];

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function sendMessage()
    {
        if (empty($this->message)) return;

        // Add user message to history
        $this->chatHistory[] = ['role' => 'user', 'text' => $this->message];

        try {
            // Talk to the Python Bridge
            $response = Http::get('http://127.0.0.1:8001/agent/ask', [
                'question' => $this->message,
                'bcid' => 1 // Temporary until we finish Wallet Auth
            ]);

            if ($response->successful()) {
                $this->chatHistory[] = ['role' => 'agent', 'text' => $response->json()['answer']];
            }
        } catch (\Exception $e) {
            $this->chatHistory[] = ['role' => 'agent', 'text' => 'My connection to the core is unstable. Check bridge.py!'];
        }

        $this->message = '';
    }

    public function render()
    {
        return view('livewire.agent-chat');
    }
}