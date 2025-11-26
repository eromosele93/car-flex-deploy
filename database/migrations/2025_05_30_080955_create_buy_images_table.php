<?php

use App\Models\Buy;
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
        Schema::create('buy_images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('filename');
            $table->foreignIdFor(Buy::class)->constrained('buys');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buy_images');
    }
};
