<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function detail(string $slug)
    {
        $model = Article::query()
            ->with(['author','tags'])
            ->where('slug', $slug)->firstOrFail();
        return view('detail',compact('model'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $articles = Article::query()->with(['author','tags'])->where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->where('status', 'published')
            ->orderByDesc('id')
            ->get();

        return view('search', compact('articles', 'query'));
    }
    public function views(Request $request)
    {
        Article::query()->where('id',$request->id)->increment('views',1);
    }
}
