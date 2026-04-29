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
    Schema::table('bcids', function (Blueprint $table) {
        // Adding a default of 10.00 so existing citizens have a "value"
        $table->decimal('amount', 8, 2)->default(10.00); 
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bcids', function (Blueprint $table) {
            //
        });
    }
};
