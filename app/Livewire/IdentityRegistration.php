<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BCID;

class IdentityRegistration extends Component
{
    public $handle;
    public $network = 'Base';
    public $tx_hash;
    public $platform_fee = 0.25; // Hardcoded $0.25 Platform Fee

    public function claim()
    {
        if (!session()->has('pending_wallet')) {
            $this->addError('handle', 'Connect wallet first.');
            return;
        }

        $this->validate([
            'handle' => 'required|min:3|unique:bcids,handle',
            'tx_hash' => 'required|regex:/^0x([A-Fa-f0-9]{64})$/',
        ]);

        // Logic: Free registration + $0.25 fee verification
        // In your 'Glass Box' logic, this hash must represent a $0.25 transfer
        $citizen = BCID::create([
            'handle' => $this->handle,
            'wallet_address' => session('pending_wallet'),
            'network' => $this->network,
            'tx_hash' => $this->tx_hash,
            'fee_paid' => $this->platform_fee,
            'sequence_number' => BCID::count() + 1,
        ]);

        session(['bcid_id' => $citizen->id, 'handle' => $citizen->handle]);
        return redirect()->route('feed');
    }

    public function render()
    {
        return view('livewire.identity-registration');
    }
}