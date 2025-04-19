<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title');
            $table->string('author');
            $table->string('image_url');
            $table->timestamps();     // created_at & updated_at
            $table->softDeletes();    // deleted_at column
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
}