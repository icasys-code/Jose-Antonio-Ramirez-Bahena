<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarVariantsTable extends Migration
{
    public function up()
    {
        Schema::create('car_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_model_id');
            $table->string('name');
            $table->string('trim')->nullable();
            $table->string('engine')->nullable();
            $table->string('transmission')->nullable();
            $table->string('fuel_type')->nullable();
            $table->integer('doors')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('car_model_id')->references('id')->on('car_models')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('car_variants');
    }
}
