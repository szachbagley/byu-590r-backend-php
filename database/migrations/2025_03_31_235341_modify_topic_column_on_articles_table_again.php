<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTopicColumnOnArticlesTableAgain extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('topic')->nullable()->change();
        });
    }

    public function down()
    {
        // Leave the column as nullable on rollback,
        // or you could simply comment out this method if you want the change to be irreversible.
        Schema::table('articles', function (Blueprint $table) {
            $table->string('topic')->nullable()->change();
        });
    }
}