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
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->text('notice_1')->nullable();
            $table->string('notice_1_title')->nullable();
            $table->text('notice_2')->nullable();
            $table->string('notice_2_title')->nullable();
            $table->text('notice_3')->nullable();
            $table->string('notice_3_title')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
