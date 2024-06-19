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
        Schema::table('communiques', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->enum('communique_status',['en_attente','diffusion','diffusion_fini'])->default('en_attente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('communiques', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->enum('communique_status',['en_attente','diffusion','diffusion_fini'])->default('en_attente');
        });
    }
};
