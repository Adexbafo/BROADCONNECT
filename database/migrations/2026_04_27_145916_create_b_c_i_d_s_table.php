<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('bcids', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('handle')->unique(); 
        $table->string('supra_address')->unique()->nullable();
        $table->string('base_address')->unique()->nullable();
        
        // Treasury tracking for the $5 fee
        $table->decimal('registration_fee_usd', 8, 2)->default(5.00);
        $table->string('payment_asset'); // e.g., 'USDC', 'SUPRA', 'ETH'
        $table->string('tx_hash')->unique(); // The proof of payment
        
        $table->boolean('is_active')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b_c_i_d_s');
    }
};
