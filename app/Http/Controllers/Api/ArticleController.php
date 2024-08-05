<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Catelogue;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function tinTheoLoai(string $slug)
    {
        $dataCatelogue = Catelogue::query()->where('slug', $slug)->first();
        $dataArticle = Article::query()
            ->where('catelogue_id', $dataCatelogue->id)
            ->where('status', 'published')
            ->orderByDesc('id')->get();
        $json = [
            'data'=>$dataArticle,
            'message' => 'OK'
        ];
        return response()->json($json, 200);
    }

    public function chiTietTin(string $slug)
    {
        $model = Article::query()
            ->with(['author','tags'])
            ->where('slug', $slug)->firstOrFail();
        $json = [
            'data'=>$model,
            'message' => 'OK'
        ];
        return response()->json($json, 200);
    }
}
