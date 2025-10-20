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
        Schema::create('motorcycles', function (Blueprint $table) {
            $table->id('motorcycle_id');
            $table->unsignedBigInteger('user_id');
            $table->string('plate_number')->unique()->default('Not Set');
            $table->string('brand')->default('Not Set');
            $table->string('model')->default('Not Set');
            $table->string('engine_capacity')->default('Not Set');
            $table->year('year')->default('2000');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motorcycles');
    }
};
