<?php

use App\Models\Classe;
use App\Models\Sessio;
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
        Schema::create('classe_sessio', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sessio::class)->constrained();
            $table->foreignIdFor(Classe::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classe_sessio');
    }
};
