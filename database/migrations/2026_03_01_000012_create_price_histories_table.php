<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('price_histories', function (Blueprint $table) {
            $table->id();
            $table->morphs('priceable');
            $table->decimal('price', 12, 2);
            $table->string('currency', 3)->default('USD');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamp('effective_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('price_histories');
    }
}
