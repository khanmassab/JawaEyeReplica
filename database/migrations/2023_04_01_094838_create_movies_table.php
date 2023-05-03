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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('poster');
            $table->string('title');
            $table->integer('duration');
            $table->timestamp('release_time');
            $table->string('introduction');
            $table->json('actor_image');
            $table->longText('description')->nullable();
            $table->integer('price');
            $table->integer('sheets_per_ticket');
            $table->longText('instructions');
            $table->string('income');
            $table->integer('catalogue');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
