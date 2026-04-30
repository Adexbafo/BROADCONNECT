<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BCID;
use Illuminate\Support\Facades\Session;

class WalletAuth extends Component
{
    public $address;

    public function login($address)
    {
        $this->address = $address;

        // Verify if a BCID exists for this wallet address
        $citizen = BCID::where('wallet_address', $address)->first();

        if ($citizen) {
            // Citizen found! Log them in
            Session::put('bcid_id', $citizen->id);
            Session::put('handle', $citizen->handle);
            return redirect()->route('feed');
        } else {
            // New user or no BCID linked yet
            Session::put('pending_wallet', $address);
            session()->flash('status', 'Wallet linked! Please choose your handle.');
        }
    }

    public function logout()
    {
        Session::forget(['bcid_id', 'handle', 'pending_wallet']);
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.wallet-auth');
    }
}