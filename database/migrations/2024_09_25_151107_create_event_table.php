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
            $table->bigIncrements('id')->comment('イベントID');
            $table->string('event_name')->comment('イベント名');
            $table->text('event_description')->comment('イベント説明');
            $table->boolean('is_official')->comment('公式イベントかどうか');
            $table->dateTime('deadline')->nullable()->comment('募集期限');
            $table->dateTime('event_start')->comment('開始日時');
            $table->dateTime('event_end')->comment('終了日時');
            $table->string('event_area')->comment('開催地域');
            $table->string('event_place_address')->comment('開催住所');
            $table->string('event_place_name')->comment('開催場所');
            $table->string('owner')->comment('運営');
            $table->text('memo')->nullable()->comment('メモ');
            $table->string('password')->comment('パスワード');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};
