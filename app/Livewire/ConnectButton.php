<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BCID;
use Illuminate\Support\Facades\DB;

class ConnectButton extends Component
{
    public $targetId;
    public $isFollowing;

    public function mount($targetId)
    {
        $this->targetId = $targetId;
        // For testing: We'll assume BCID-1 is the one clicking the button
        $this->checkStatus();
    }

    public function checkStatus()
    {
        $this->isFollowing = DB::table('connections')
            ->where('citizen_id', 1) // Acting as BCID-1
            ->where('target_id', $this->targetId)
            ->exists();
    }

    public function toggleConnect()
{
    if ($this->isFollowing) {
        DB::table('connections')
            ->where('citizen_id', 1)
            ->where('target_id', $this->targetId)
            ->delete();
    } else {
        DB::table('connections')->insert([
            'citizen_id' => 1,
            'target_id' => $this->targetId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    $this->checkStatus();
    
    // This tells Livewire to refresh any component listening for "refreshProfile"
    $this->dispatch('refreshProfile'); 
}
}