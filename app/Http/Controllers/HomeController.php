<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $tags = Tag::query()->orderByDesc('id')->limit(15)->get();
        $articlesEditor = Article::query()->with(['author','tags'])
            ->where('is_editor', 1)
            ->where('status','published')
            ->first();
        $articlesTrending = Article::query()
            ->where('status','published')
            ->where('is_trending', 1)
            ->orderByDesc('id')->limit(3)->get();
        $articlesViews = Article::query()->with(['author','tags'])
            ->where('status','published')
            ->orderByDesc('views')->first();
        $articlesNews = Article::query()
            ->with(['author', 'tags'])
            ->where('status','published')
            ->orderByDesc('id')
            ->paginate(5);
        return view('home',compact('tags','articlesEditor','articlesTrending','articlesViews','articlesNews'));
    }
}
