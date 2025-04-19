<?php
// filepath: database/migrations/xxxx_xx_xx_xxxxxx_drop_topics_and_pivot_tables.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DropTopicsAndPivotTables extends Migration
{
    public function up()
    {
        Schema::dropIfExists('article_topic');
        Schema::dropIfExists('topics');
    }

    public function down()
    {
        // if you need to re‑create them, you can copy your old create_… files here
    }
}