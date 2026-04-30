<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Broadcast;
use App\Models\Interaction;
use Illuminate\Support\Facades\Session;

class ProtocolFeed extends Component
{
    public $content = '';
    public $replyingTo = null;
    public $replyContent = '';

    protected $rules = [
        'content' => 'required|max:280',
    ];

    public function postVibe()
    {
        if (!session()->has('bcid_id')) return;

        $this->validate();

        Broadcast::create([
            'bcid_id' => session('bcid_id'),
            'content' => $this->content,
            'type' => 'post'
        ]);

        $this->content = '';
        $this->dispatch('vibe-posted');
    }

    public function toggleLike($broadcastId)
    {
        if (!session()->has('bcid_id')) return;

        $userId = session('bcid_id');

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

    public function rebroadcast($broadcastId)
    {
        if (!session()->has('bcid_id')) return;

        Interaction::updateOrCreate([
            'bcid_id' => session('bcid_id'),
            'broadcast_id' => $broadcastId,
            'type' => 'rebroadcast'
        ]);
    }

    public function setReply($id)
    {
        $this->replyingTo = ($this->replyingTo === $id) ? null : $id;
    }

    public function postReply($parentId)
    {
        if (!session()->has('bcid_id')) return;

        $this->validate(['replyContent' => 'required|max:280']);

        Broadcast::create([
            'bcid_id' => session('bcid_id'),
            'content' => $this->replyContent,
            'parent_id' => $parentId,
            'type' => 'reply'
        ]);

        $this->replyContent = '';
        $this->replyingTo = null;
    }

    public function render()
    {
        return view('livewire.protocol-feed', [
            'broadcasts' => Broadcast::with(['bcid', 'likes', 'replies', 'interactions'])
                ->whereNull('parent_id')
                ->latest()
                ->paginate(10)
        ]);
    }
}