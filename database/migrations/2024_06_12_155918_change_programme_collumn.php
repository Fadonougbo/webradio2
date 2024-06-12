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
        Schema::table('programmes', function (Blueprint $table) {
            $table->dropColumn('periode_date');
            $table->dropColumn('periode_hour');
            $table->date('programme_date');
            $table->time('programme_hour');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programmes', function (Blueprint $table) {
            $table->dropColumn('programme_date');
            $table->dropColumn('programme_hour');
            $table->date('periode_date');
            $table->time('periode_hour');
            
        });
    }
};
