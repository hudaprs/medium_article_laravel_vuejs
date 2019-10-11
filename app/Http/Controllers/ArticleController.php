<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Resources\Article as ArticleResource;

class ArticleController extends Controller
{
    // Mengambil Semua Artikel
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(5);
        return ArticleResource::collection($articles);
    }

    // Membuat Artikel Baru / Mengupdate Artikel Sesuai Method ( PUT / POST )
    public function store(Request $request)
    {
        $article = $request->isMethod('PUT') ? Article::findOrFail($request->input('article_id')) : new Article;
        $article->title = $request->input('title');
        $article->body = $request->input('body');
        
        if($article->save()) {
            return new ArticleResource($article);
        }
    }

    // Menghapus Artikel
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if($article->delete()) {
            return new ArticleResource($article);
        }
    }
}
