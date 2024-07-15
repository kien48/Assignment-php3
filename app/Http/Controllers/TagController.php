<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function tag(int $id, string $slug)
    {
        $dataTag = DB::table('article_tag')
            ->where('tag_id', $id)
            ->pluck('article_id');

        $tag = Tag::query()
            ->where('id', $id)
            ->first();

        $dataArticleTag = Article::query()
            ->with(['author', 'tags'])
            ->whereIn('id', $dataTag)
            ->where('status', 'published')
            ->get();
        return view('tag', compact('dataArticleTag','tag'));
    }
}
