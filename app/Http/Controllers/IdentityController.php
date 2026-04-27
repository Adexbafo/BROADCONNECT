<?php

namespace App\Http\Controllers;

use App\Models\BCID;
use App\Services\BroaderAgentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdentityController extends Controller
{
    /**
     * Claim a BCID handle after payment.
     * * This handles the core Phase 1 logic: 
     * Validation -> Model Creation -> Agent Verification.
     */
    public function claimHandle(Request $request, BroaderAgentService $agent)
    {
        // 1. Validation
        $request->validate([
            'handle' => 'required|alpha_dash|unique:bcids,handle|max:20',
            'tx_hash' => 'required|string|unique:bcids,tx_hash',
            'payment_asset' => 'required|in:USDC,SUPRA,ETH',
            'network' => 'required|in:base,supra',
        ]);

        // 2. Creation
        $bcid = BCID::create([
            'user_id' => Auth::id(),
            'handle' => strtolower($request->handle),
            'tx_hash' => $request->tx_hash,
            'payment_asset' => $request->payment_asset,
            'network' => $request->network,
            'is_active' => false, // Initial state
        ]);

        // 3. Execution (BroaderAgent begins verification)
        // Note: In Phase 1 we call this directly; in production, we would use a Queue.
        $agent->verifyIdentityPayment($bcid);

        // 4. Response
        return response()->json([
            'message' => 'Handle claimed successfully.',
            'handle' => $bcid->handle,
            'status' => $bcid->is_active ? 'Active (Verified)' : 'Pending Verification',
            'network' => $bcid->network
        ]);
    }
}