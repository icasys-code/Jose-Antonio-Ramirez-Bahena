<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartVariantTable extends Migration
{
    public function up()
    {
        Schema::create('part_variant', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('part_id');
            $table->unsignedBigInteger('car_variant_id');
            $table->string('fitment_notes')->nullable();
            $table->boolean('direct_fit')->default(false);
            $table->timestamps();

            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');
            $table->foreign('car_variant_id')->references('id')->on('car_variants')->onDelete('cascade');
            $table->unique(['part_id','car_variant_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('part_variant');
    }
}
