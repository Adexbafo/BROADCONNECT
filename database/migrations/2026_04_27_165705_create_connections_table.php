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
    Schema::create('connections', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('citizen_id'); // The person initiating
        $table->unsignedBigInteger('target_id');  // The person being connected to
        $table->timestamps();

        // Foreign keys to our bcids table
        $table->foreign('citizen_id')->references('id')->on('bcids')->onDelete('cascade');
        $table->foreign('target_id')->references('id')->on('bcids')->onDelete('cascade');
        
        // Prevent duplicate connections
        $table->unique(['citizen_id', 'target_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connections');
    }
};
