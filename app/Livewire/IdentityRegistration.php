<?php

namespace App\Livewire;

use App\Models\BCID;
use App\Services\BroaderAgentService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class IdentityRegistration extends Component
{
    public $handle;
    public $tx_hash;
    public $payment_asset = 'USDC';
    public $network = 'base';
    public $message = '';

    protected $rules = [
        'handle' => 'required|alpha_dash|unique:bcids,handle|max:20',
        'tx_hash' => 'required|string|unique:bcids,tx_hash',
        'payment_asset' => 'required|in:USDC,SUPRA,ETH',
        'network' => 'required|in:base,supra',
    ];

    public function claim()
{
    $this->validate();

    $bcid = BCID::create([
        // This will now pass NULL if you aren't logged in, preventing the error
        'user_id' => Auth::id(), 
        'handle' => strtolower($this->handle),
        'tx_hash' => $this->tx_hash,
        'payment_asset' => $this->payment_asset,
        'network' => $this->network,
        'is_active' => false,
    ]);

    // This uses the BCID-N logic we added to the model
    $this->message = "Success! You are assigned BCID-{$bcid->sequence_number}. BroaderAgent is verifying...";
    
    $this->reset(['handle', 'tx_hash']);
}

    public function render()
    {
        return view('livewire.identity-registration');
    }
}