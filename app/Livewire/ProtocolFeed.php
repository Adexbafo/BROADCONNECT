<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Broadcast;
use App\Models\Interaction;
use Illuminate\Support\Facades\Session;

class ProtocolFeed extends Component
{
    public $content = '';

    protected $rules = [
        'content' => 'required|max:280',
    ];

    public function postVibe()
    {
        $this->validate();

        Broadcast::create([
            'bcid_id' => 1, // Simulated current user
            'content' => $this->content,
        ]);

        $this->content = '';
        session()->flash('message', 'Broadcast sent!');
    }

    public function toggleLike($broadcastId)
    {
        $userId = 1; // Simulated current user

        $existing = Interaction::where('bcid_id', $userId)
            ->where('broadcast_id', $broadcastId)
            ->where('type', 'like')
            ->first();

        if ($existing) {
            $existing->delete();
        } else {
            Interaction::create([
                'bcid_id' => $userId,
                'broadcast_id' => $broadcastId,
                'type' => 'like'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.protocol-feed', [
            'broadcasts' => Broadcast::with(['bcid', 'likes'])->latest()->get()
        ]);
    }

    public function rebroadcast($broadcastId)
{
    $userId = 1; // Simulated current user (adex)

    $existing = Interaction::where('bcid_id', $userId)
        ->where('broadcast_id', $broadcastId)
        ->where('type', 'rebroadcast')
        ->first();

    if ($existing) {
        $existing->delete();
    } else {
        Interaction::create([
            'bcid_id' => $userId,
            'broadcast_id' => $broadcastId,
            'type' => 'rebroadcast'
        ]);
    }
}
}