<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function index()
    {
        $data = User::query()->where('role', 'author')
            ->select('users.*', DB::raw('count(articles.id) as total'))
            ->leftJoin('articles', 'articles.author_id', '=', 'users.id')
            ->where('articles.status', 'published')
            ->groupBy('users.id')
            ->get();
        return view('author', compact('data'));
    }

    public function detail(int $id)
    {
        $model = User::query()->where('users.id', $id)
        ->where('role','author')
        ->select('users.*', DB::raw('count(articles.id) as total'))
        ->join('articles', 'articles.author_id', '=', 'users.id')
         ->where('articles.status', 'published')
            ->groupBy('users.id')
            ->first();
        $dataArticle = Article::query()->with(['author','tags'])
            ->where('author_id', $id)
            ->where('status', 'published')
            ->orderByDesc('id')->paginate(3);
        $status = '';
        if(Auth::check()){
            $checkFollow = Follower::query()
                ->where('author_id', $id)
                ->where('member_id', Auth::user()->id)
                ->exists();
            $status = $checkFollow ? 'true' : 'false';
        }
        return view('detail-author', compact('model', 'dataArticle','status'));
    }

    public function follow(Request $request)
    {
        Follower::query()->create([
            'author_id' => $request->author_id,
            'member_id' => Auth()->user()->id
        ]);
    }
    public function unFollow(Request $request)
    {
        Follower::where('author_id', $request->author_id)
            ->where('member_id', Auth()->user()->id)
            ->delete();
    }


}
