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
        Schema::create('attends', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->integer('event_id')->comment('イベントID');
            $table->string('attend')->comment('参加者名');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attend');
    }
};
