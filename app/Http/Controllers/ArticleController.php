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
}
