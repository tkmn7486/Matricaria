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
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->integer('event_id')->comment('イベントID');
            $table->string('user_name')->comment('ユーザー名');
            $table->text('comment')->comment('コメント');
            $table->string('stamp_id')->nullable()->comment('スタンプID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
