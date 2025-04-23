<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Topic::insert([
            ['name'=>'Women','description'=>'Articles on women\'s role in the church'],
            ['name'=>'Theology','description'=>'Doctrinal study'],
            ['name'=>'Media','description'=>'TV & film analysis'],
            ['name'=>'Scripture','description'=>'Analysis of the scriptures'],
            ['name'=>'Culture','description'=>'Cultural analysis'],
            ['name'=>'History','description'=>'Historical analysis'],
            ['name'=>'Science','description'=>'Scientific analysis'],
            ['name'=>'Philosophy','description'=>'Philosophical analysis'],
            ['name'=>'Society','description'=>'Societal analysis'],
            ['name'=>'Family','description'=>'Family analysis'],
            ['name'=>'Education','description'=>'Educational analysis'],
            ['name'=>'Economics','description'=>'Economic analysis'],
            ['name'=>'Politics','description'=>'Political analysis'],
            ['name'=>'Other','description'=>'Other topics'],
        ]);
    }
}
