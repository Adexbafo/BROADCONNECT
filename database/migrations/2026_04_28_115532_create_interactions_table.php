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
    Schema::create('interactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('bcid_id')->constrained('bcids'); // Who did it
        $table->foreignId('broadcast_id')->constrained('broadcasts')->onDelete('cascade');
        $table->string('type'); // 'like', 'rebroadcast'
        $table->timestamps();
        
        // Prevent duplicate likes
        $table->unique(['bcid_id', 'broadcast_id', 'type']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interactions');
    }
};
