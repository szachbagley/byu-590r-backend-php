<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTopicTable extends Migration
{
    public function up()
    {
        Schema::create('article_topic', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained()->cascadeOnDelete();
            $table->foreignId('topic_id')->constrained()->cascadeOnDelete();
            $table->primary(['article_id','topic_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('article_topic');
    }
}