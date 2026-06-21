<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartsTable extends Migration
{
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique();
            $table->string('name');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('manufacturer_id')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->string('currency', 3)->default('USD');
            $table->decimal('weight', 10, 3)->nullable();
            $table->json('dimensions')->nullable();
            $table->integer('stock')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('parts');
    }
}
