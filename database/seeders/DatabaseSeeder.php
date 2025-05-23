<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Publication;
use App\Models\Article;
use App\Models\Topic;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PublicationSeeder::class,
            ArticleSeeder::class,
            TopicSeeder::class,
            ArticleTopicSeeder::class, 
        ]);
    }
}
