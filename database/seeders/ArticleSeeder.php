<?php

namespace Database\Seeders;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => '“There Is Always a Struggle”: An Interview with Chieko N. Okazaki',
                'author' => 'Gregory A. Prince',
                'link' => 'https://www.dialoguejournal.com/wp-content/uploads/sbi/articles/Dialogue_V45N01_CO.pdf',
                'image_url' => 'images/okazaki.jpg',
                'publication_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => '“Julie Through the Glass”: The Rise and Fall of the Mormon TV Commerical',
                'author' => 'Rollo Romig',
                'link' => 'https://archive.is/XBFgT',
                'image_url' => 'images/mormontv.jpg',
                'publication_id' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'A Professor and Apostle Correspond: Eugene England and Bruce R. McConkie on the Nature of God',
                'author' => 'Rebecca England',
                'link' => 'https://www.eugeneengland.org/a-professor-and-apostle-correspond-eugene-england-and-bruce-r-mcconkie-on-the-nature-of-god',
                'image_url' => 'images/gene_england.jpg',
                'publication_id' => 11,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Doctrine and Covenants 132 and Polygamy',
                'author' => 'Mormonr/B. H. Roberts Foundation',
                'link' => 'https://mormonr.org/qnas/spymbg/doctrine_and_covenants_132_and_polygamy',
                'image_url' => 'images/dc132.png',
                'publication_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => '“The Perfect Union of Man and Woman”: Reclamation and Collaboration in Joseph Smith’s Theology Making',
                'author' => 'Fiona Givens',
                'link' => 'https://www.dialoguejournal.com/articles/the-perfect-union-of-man-and-womanreclamation-and-collaboration-in-joseph-smiths-theology-making/',
                'image_url' => 'images/collaboration.png',
                'publication_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'A Society Meet For Male Priesthood',
                'author' => 'Fiona Givens',
                'link' => 'https://web.archive.org/web/20140223100456/https://difficultrun.nathanielgivens.com/2014/01/20/a-companion-meet-for-male-priesthood/',
                'image_url' => 'images/females_bless.avif',
                'publication_id' => 11,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
        Article::insert($articles);
    }
}
