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
        Schema::create('basketball_field', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id');
            $table->string('title');
            $table->string('image');
            $table->string('price');
            $table->text('address');
            $table->text('desc');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basketball_field');
    }
};
