<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->id();
            $table->string('element_type');
            $table->string('element_data');
            $table->string('image');
            $table->decimal('position_x',10,6);
            $table->decimal('position_y',10,6);
            $table->timestamps();
            $table->unsignedBigInteger('visionboard_id');
            
            $table->foreign('visionboard_id')->references('id')->on('visionboards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elements');
    }
}
