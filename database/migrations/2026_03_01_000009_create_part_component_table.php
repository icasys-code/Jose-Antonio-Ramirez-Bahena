<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartComponentTable extends Migration
{
    public function up()
    {
        Schema::create('component_part', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('part_id');
            $table->unsignedBigInteger('component_id');
            $table->string('role')->nullable();
            $table->integer('quantity')->default(1);
            $table->timestamps();

            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');
            $table->foreign('component_id')->references('id')->on('components')->onDelete('cascade');
            $table->unique(['part_id','component_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('component_part');
    }
}
