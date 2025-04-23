<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleTopicSeeder extends Seeder
{
    public function run(): void
    {
        $pairs = [
            ['article_id' => 1,  'topic_id' => 1],
            ['article_id' => 1,  'topic_id' => 14],
            ['article_id' => 2,  'topic_id' => 2],
            ['article_id' => 2,  'topic_id' => 3],
            ['article_id' => 8,  'topic_id' => 1],
            ['article_id' => 8,  'topic_id' => 3],
            ['article_id' => 9,  'topic_id' => 1],
            ['article_id' => 9,  'topic_id' => 2],
            ['article_id' => 9,  'topic_id' => 3],
            ['article_id' => 9,  'topic_id' => 14],
            ['article_id' => 10, 'topic_id' => 2],
            ['article_id' => 10, 'topic_id' => 3],
            ['article_id' => 10, 'topic_id' => 14],
            ['article_id' => 11, 'topic_id' => 2],
            ['article_id' => 11, 'topic_id' => 3],
            ['article_id' => 11, 'topic_id' => 14],
        ];

        // Avoid duplicates by first truncating the pivot
        DB::table('article_topic')->truncate();

        DB::table('article_topic')->insert($pairs);
    }
}