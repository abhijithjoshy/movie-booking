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
        Schema::create('theater_details', function (Blueprint $table) {
            $table->id();
            $table->string('theater_name'); 
            $table->string('movie_name'); 
            $table->date('show_date'); 
            $table->time('show_time'); 
            $table->integer('num_seats'); 
            $table->string('movie_thumbnail_path'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theater_details');
    }
};
