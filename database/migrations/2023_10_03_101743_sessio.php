<?php

use App\Models\Cours;
// use App\Models\Professeur;
use App\Models\Salle;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sessios', function (Blueprint $table) {
            $table->id();
            $table->string('libele');
            $table->foreignIdFor(Cours::class)->constrained();
            $table->foreignIdFor(Salle::class)->constrained()->nullable();
            $table->integer('nbr_heure');
            $table->integer('heure_debut');
            $table->integer('heure_fin');
            $table->timestamp('date');
            $table->enum('type',['presentiel','ligne'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
