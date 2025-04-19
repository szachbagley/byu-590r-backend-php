<?php

namespace Database\Seeders;

use App\Models\Publication;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublicationSeeder extends Seeder
{
    public function run(): void
    {
        Publication::insert([
          ['name'=>'Dialogue Journal','link'=>'https://dialoguejournal.com'],
          ['name'=>'Mormonr',      'link'=>'https://mormonr.org'],
          ['name'=>'The Exponent II', 'link'=>'https://exponentii.org'],
          ['name'=>'The Salt Lake Tribune', 'link'=>'https://www.sltrib.com'],
          ['name'=>'The Church of Jesus Christ of Latter-day Saints', 'link'=>'https://www.churchofjesuschrist.org'],
          ['name'=>'The New York Times', 'link'=>'https://www.nytimes.com'],
          ['name'=>'The Atlantic', 'link'=>'https://www.theatlantic.com'],
          ['name'=>'The Guardian', 'link'=>'https://www.theguardian.com/us'],
          ['name'=>'The Washington Post', 'link'=>'https://www.washingtonpost.com'],
          ['name'=>'The New Yorker', 'link'=>'https://www.newyorker.com'],
          ['name'=>'Other', 'link'=>'https://www.google.com'],
        ]);
    }
}