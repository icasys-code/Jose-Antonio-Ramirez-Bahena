<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTables extends Migration
{
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->string('type')->default('string');
            $table->timestamps();
        });

        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attribute_id');
            $table->string('value');
            $table->string('unit')->nullable();
            $table->timestamps();

            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
        });

        Schema::create('attributeables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attribute_value_id');
            $table->morphs('attributeable');
            $table->timestamps();

            $table->foreign('attribute_value_id')->references('id')->on('attribute_values')->onDelete('cascade');
            $table->unique(['attribute_value_id','attributeable_id','attributeable_type'], 'attr_valable_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('attributeables');
        Schema::dropIfExists('attribute_values');
        Schema::dropIfExists('attributes');
    }
}
