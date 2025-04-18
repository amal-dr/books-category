<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livres', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->integer('pages'); // Changed from decimal to integer
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            
            // Foreign key column
            $table->unsignedBigInteger('categorie_id');
            
            $table->timestamps();
            
            // Foreign key constraint (added separately for better error handling)
            $table->foreign('categorie_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('livres', function (Blueprint $table) {
            $table->dropForeign(['categorie_id']);
        });
        
        Schema::dropIfExists('livres');
    }
};