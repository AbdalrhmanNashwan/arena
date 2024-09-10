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
        Schema::create('gsessions', function (Blueprint $table) {
            $table->id();
            $table->string('game_type');
            $table->integer('device_number');
            $table->integer('minutes_played')  ;
            $table->integer('room_cost')    ;
            $table->text('bar_items')   ->nullable() ;
            $table->integer('bar_cost' )   ;
            $table->integer('cost')   ;
            $table->string('total_cost' )   ;
            $table->string('promo_percent');
            $table->string('code')->nullable();
            $table->integer('cost_after_promo');
            $table->integer('group');
            $table->string('card')->nullable();
            $table->string('card_type')->nullable();
            $table->text('note')->nullable();
            $table->dateTime('date');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gsessions');
    }
};
