<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BCID;
use Livewire\Attributes\On; 

class FollowerCount extends Component
{
    public $citizenId;

    // This attribute tells this component to run whenever 'refreshProfile' is dispatched
    #[On('refreshProfile')] 
    public function render()
    {
        $citizen = BCID::find($this->citizenId);
        return view('livewire.follower-count', [
            'followerCount' => $citizen->followers()->count(),
            'followingCount' => $citizen->following()->count(),
        ]);
    }
}