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
        Schema::create('events', function (Blueprint $table) {
            $table->id()->index();
            $table->string('title');
            $table->boolean('is_official');
            $table->unsignedInteger('deadline');
            $table->unsignedInteger('event_start');
            $table->unsignedInteger('event_end');
            $table->string('event_place_name');
            $table->string('event_place_address');
            $table->string('owner');
            $table->longText('event_description');
            $table->longText('memo');
            $table->unsignedInteger('created_at');
            $table->unsignedInteger('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
