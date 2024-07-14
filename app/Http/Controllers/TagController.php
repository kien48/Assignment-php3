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
        $dataTag = DB::table('article_tag')->where('tag_id', $id)->get();
        $tag = Tag::query()->where('id', $id)->get();
        $dataArticleTag = [];

        foreach ($dataTag as $item){
            $dataArticleTag[] = Article::query()->with(['author','tags'])->where('id', $item->article_id)->first();
        }

        return view('tag', compact('dataArticleTag','tag'));
    }
}
