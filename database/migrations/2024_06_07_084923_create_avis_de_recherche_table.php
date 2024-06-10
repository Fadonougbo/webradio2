<?php

use App\Models\User;
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
        Schema::create('avisDeRecherches', function (Blueprint $table) {
            $table->id();
            $table->enum('personne',['morale','physique'])->default('physique');
            $table->string('adr_email');
            $table->string('adr_tel');
            $table->string('adr_file');
            $table->string('adr_detail')->nullable();
            $table->boolean('isPaid')->default(false);
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status',['en attente','accepté','refusé',])->default('en attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avisDeRecherches');
    }
};
