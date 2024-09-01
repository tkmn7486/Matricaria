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
        Schema::table('events', function (Blueprint $table) {
            $table->timestamp('event_start')->change();
            $table->timestamp('event_end')->change();
            $table->timestamp('created_at')->change();
            $table->timestamp('updated_at')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedInteger('event_start');
            $table->unsignedInteger('event_end');
            $table->unsignedInteger('created_at');
            $table->unsignedInteger('updated_at');
        });
    }
};
