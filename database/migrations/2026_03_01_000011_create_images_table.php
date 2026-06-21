<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->string('disk')->default('public');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('imageable_id');
            $table->string('imageable_type');
            $table->string('alt')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->index(['imageable_id','imageable_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }
}
