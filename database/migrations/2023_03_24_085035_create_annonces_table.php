<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 70);
            $table->text('description');
            $table->enum('type', ['Appartement', 'Maison', 'Villa', 'Magasin' ,'Terrain']);
            $table->string('ville', 40);
            $table->integer('superficie');
            $table->boolean('neuf');
            $table->decimal('prix',12, 2);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
