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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId("reporter_id")->constrained("users");
            $table->foreignId("target_id")->constrained("users");
            $table->foreignId("product_id")->constrained("products");
            $table->foreignId("rating_id")->constrained('ratings');
            $table->enum('status', ['tk', 'none'])->default('none');
            $table->string('reason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
