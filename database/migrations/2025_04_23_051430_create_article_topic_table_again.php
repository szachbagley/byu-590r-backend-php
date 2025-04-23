<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTopicTableAgain extends Migration
{
    public function up()
    {
        Schema::dropIfExists('article_topic');
        Schema::create('article_topic', function (Blueprint $table) {
            $table->foreignId('article_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->foreignId('topic_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->primary(['article_id','topic_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('article_topic');
    }
}