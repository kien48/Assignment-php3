<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Catelogue;
use Illuminate\Http\Request;

class CatelogueController extends Controller
{
    public function index(string $slug)
    {
        $dataCatelogue = Catelogue::query()->where('slug', $slug)->first();
        $dataArticle = Article::query()
            ->where('catelogue_id', $dataCatelogue->id)
            ->where('status', 'published')
            ->orderByDesc('id')->get();
        return view('catelogue', compact('dataArticle', 'dataCatelogue'));
    }
}
