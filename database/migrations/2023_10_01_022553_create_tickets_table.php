<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('theater_id');
            $table->string('movie_name');
            $table->string('email');
            $table->date('show_date');
            $table->time('show_time');
            $table->integer('num_seats');
            $table->string('booking_id')->unique()->default(Str::random(10));
            $table->timestamps();
            $table->foreign('theater_id')->references('id')->on('theater_lists');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
