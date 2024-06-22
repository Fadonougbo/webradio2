<?php

use App\Models\User;
use App\Models\webradio\Article;
use App\Models\webradio\Categorie;
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
        Schema::create('articles_categories', function (Blueprint $table) {

            $table->foreignIdFor(Article::class)->constrained()->cascadeOnDelete()->cascadeOnDelete();

            $table->foreignIdFor(Categorie::class)->constrained()->cascadeOnDelete()->cascadeOnDelete();

            $table->primary(['article_id','categorie_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles_categories');
    }
};
