<?php

namespace App\Http\Controllers;

use App\Models\BCID;
use Illuminate\Http\Request;

class TreasuryController extends Controller
{
    public function index()
    {
        // 1. Total Citizens (BCID Count)
        $totalCitizens = BCID::count();

        // 2. Total Treasury Value ($5 per registration)
        $totalUsd = $totalCitizens * 5;

        // 3. Network Distribution
        $baseCount = BCID::where('network', 'base')->count();
        $supraCount = BCID::where('network', 'supra')->count();

        // 4. Pending vs Active (Verification Status)
        $activeCitizens = BCID::where('is_active', true)->count();
        $pendingCitizens = BCID::where('is_active', false)->count();

        return view('treasury.index', compact(
            'totalCitizens', 
            'totalUsd', 
            'baseCount', 
            'supraCount',
            'activeCitizens',
            'pendingCitizens'
        ));
    }
}