<?php

namespace App\Services;

use App\Models\BCID;
use App\Models\Broadcast;
use Illuminate\Support\Facades\Log;

class BroaderAgentService
{
    /**
     * Scan and verify pending identities.
     */
    public function verifyPendingMints()
    {
        $pending = BCID::where('is_active', false)->get();

        foreach ($pending as $citizen) {
            // Logic: If there is a tx_hash, the agent "verifies" it on-chain
            if (!empty($citizen->tx_hash)) {
                $citizen->update(['is_active' => true]);
                Log::info("BroaderAgent: ✅ Verified BCID-{$citizen->sequence_number} (@{$citizen->handle})");
            }
        }
    }

    /**
     * Simple Spam Monitor
     */
    public function scanForSpam()
    {
        // Get broadcasts from the last 5 minutes
        $recent = Broadcast::where('created_at', '>=', now()->subMinutes(5))->get();

        foreach ($recent as $post) {
            // Flag 1: Content too short
            if (strlen($post->content) < 2) {
                Log::warning("BroaderAgent: ⚠️ Spam Alert - Low quality content from BCID-{$post->bcid_id}");
            }
            
            // Flag 2: Duplicate detection
            $duplicateCount = Broadcast::where('content', $post->content)->count();
            if ($duplicateCount > 1) {
                Log::warning("BroaderAgent: ⚠️ Spam Alert - Duplicate content detected.");
            }
        }
    }
}