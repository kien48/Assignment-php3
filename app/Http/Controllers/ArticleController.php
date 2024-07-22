<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function apiComment($articleId)
    {
        $comments = Comment::with(['children.user','user'])
            ->where('article_id', $articleId)
            ->whereNull('parent_id')
            ->orderByDesc('id')
            ->get();
        $json = [
            'comments' => $comments
        ];
        return response()->json($json,200);
    }

    public function addComment(Request $request)
    {
        $data = $request->all();
        Comment::query()->create([
            'content' => $data['content'],
            'user_id' => Auth::user()->id,
            'article_id' => $data['article_id'],
            'parent_id' =>   $data['parent_id'] ?? null,
        ]);
    }
}
