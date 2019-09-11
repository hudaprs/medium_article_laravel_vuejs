<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $article = new Article;
        $article->title = "Judul Artikel Pertama";
        $article->body = "Isi Artikel Pertama";
        $article->save();

        $article2 = new Article;
        $article2->title = "Judul Artikel Kedua";
        $article2->body = "Isi Artikel Kedua";
        $article2->save();

        $article3 = new Article;
        $article3->title = "Judul Artikel Ketiga";
        $article3->body = "Isi Artikel Ketika";
        $article3->save();
    }
}
