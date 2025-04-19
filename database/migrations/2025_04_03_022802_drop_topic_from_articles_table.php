<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTopicFromArticlesTable extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('topic');
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('topic')->nullable();
        });
    }
}