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
            ['article_id' => 1, 'topic_id' => 2],
            ['article_id' => 1, 'topic_id' => 3],
            ['article_id' => 1, 'topic_id' => 4],
            ['article_id' => 1, 'topic_id' => 5],
            ['article_id' => 1, 'topic_id' => 6],
            ['article_id' => 1, 'topic_id' => 7],
            ['article_id' => 1, 'topic_id' => 8],
            ['article_id' => 1, 'topic_id' => 9],
            ['article_id' => 1, 'topic_id' => 10],
            ['article_id' => 1, 'topic_id' => 11],
            ['article_id' => 1, 'topic_id' => 12],
            ['article_id' => 1, 'topic_id' => 13],
            ['article_id' => 1, 'topic_id' => 14],
        ];

        // Avoid duplicates by first truncating the pivot
        DB::table('article_topic')->truncate();

        DB::table('article_topic')->insert($pairs);
    }
}