<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

//#[Signature('app:verify-identity')]

#[Description('Command description')]
class VerifyIdentity extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
{
    $id = $this->ask('Enter the BCID Sequence Number to verify (e.g., 1)');

    $bcid = \App\Models\BCID::where('sequence_number', $id)->first();

    if ($bcid) {
        $bcid->update(['is_active' => true]);
        $this->info("BCID-{$id} has been verified by BroaderAgent!");
    } else {
        $this->error("Identity not found.");
    }
}

protected $signature = 'verify:identity';

}
