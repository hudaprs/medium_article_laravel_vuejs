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
        $articles = Article::orderBy('title', 'asc')->paginate(5);
        return ArticleResource::collection($articles);
    }

    // Membuat Artikel Baru
    public function store(Request $request)
    {
        $article = new Article;
        $article->title = $request->input('title');
        $article->body = $request->input('body');
        
        if($article->save()) {
            return new ArticleResource($article);
        }
    }

    // Mengambil Satu Artikel
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return new ArticleResource($article);
    }

    // Mengubah Artikel
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
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
