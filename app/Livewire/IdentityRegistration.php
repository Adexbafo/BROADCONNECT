<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BCID;

class IdentityRegistration extends Component
{
    public $handle;
    public $network = 'Base';
    public $tx_hash;
    public $platform_fee = 0.25; // $0.25 Platform Fee
    public $isAvailable = null;
    public $isProcessing = false;

    protected $rules = [
        'handle' => 'required|min:3|alpha_dash|unique:bcids,handle',
        'tx_hash' => 'required|regex:/^0x([A-Fa-f0-9]{64})$/',
    ];

    public function updatedHandle()
    {
        $this->validateOnly('handle');
        $this->isAvailable = !BCID::where('handle', $this->handle)->exists();
    }

    public function claim()
    {
        if (!session()->has('pending_wallet')) {
            $this->addError('handle', 'Please connect your wallet first.');
            return;
        }

        $this->validate();
        $this->isProcessing = true;

        try {
            $citizen = BCID::create([
                'handle' => $this->handle,
                'wallet_address' => session('pending_wallet'),
                'network' => $this->network,
                'tx_hash' => $this->tx_hash,
                'fee_paid' => $this->platform_fee,
                'sequence_number' => BCID::count() + 1,
            ]);

            session(['bcid_id' => $citizen->id, 'handle' => $citizen->handle]);
            session()->forget('pending_wallet');
            
            return redirect()->route('feed');
        } catch (\Exception $e) {
            $this->addError('tx_hash', 'Failed to register identity. Please try again.');
        } finally {
            $this->isProcessing = false;
        }
    }

    public function render()
    {
        return view('livewire.identity-registration');
    }
}