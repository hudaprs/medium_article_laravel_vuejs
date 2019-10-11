<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticlesTableSeeder extends Seeder
{
    public function run()
    {
        factory(Article::class, 10)->create();
    }
}
