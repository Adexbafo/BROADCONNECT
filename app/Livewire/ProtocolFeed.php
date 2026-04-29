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
        'broadcasts' => Broadcast::with(['bcid', 'likes', 'replies'])
            ->whereNull('parent_id') // Only show top-level posts
            ->latest()
            ->get()
    ]);
}

    public function rebroadcast($broadcastId)
{
    // A rebroadcast is just a special interaction
    \App\Models\Interaction::updateOrCreate([
        'bcid_id' => 1,
        'broadcast_id' => $broadcastId,
        'type' => 'rebroadcast'
    ]);
}

    public function quote($broadcastId)
{
    // Quoting usually opens a text box, let's reuse the reply logic 
    // but we can tag it as a quote in the future.
    $this->replyingTo = $broadcastId; 
}

   public $replyingTo = null; // Stores the ID of the broadcast being replied to
public $replyContent = '';

public function setReply($id)
{
    $this->replyingTo = $id;
}

public function postReply($parentId)
{
    $this->validate(['replyContent' => 'required|max:280']);

    \App\Models\Broadcast::create([
        'bcid_id' => 1, 
        'content' => $this->replyContent,
        'parent_id' => $parentId,
        'type' => 'quote' // Add a 'type' column to your broadcasts table to distinguish
    ]);

    $this->replyContent = '';
    $this->replyingTo = null;
}
}