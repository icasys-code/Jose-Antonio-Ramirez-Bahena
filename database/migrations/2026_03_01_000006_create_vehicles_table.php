<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_variant_id')->nullable();
            $table->string('vin')->nullable()->unique();
            $table->string('stock_code')->nullable()->unique();
            $table->integer('year')->nullable();
            $table->string('color')->nullable();
            $table->integer('mileage')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->enum('condition', ['new','used','certified'])->default('used');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('car_variant_id')->references('id')->on('car_variants')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
