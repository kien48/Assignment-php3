<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Notification;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $countArticlesPublic = [];
        if(in_array(session('admin')->role, ['admin','editor'])){
            $countArticlesPublic = Article::query()->where('status','published')->count();
          }
        if(session('admin')->role == 'author'){
            $countArticlesPublic = Article::query()
                ->where('status','published')
                ->where('author_id',session('admin')->id)
                ->count();
        }
        $countArticlesPending = [];
        if(in_array(session('admin')->role, ['admin','editor'])){
            $countArticlesPending = Article::query()->where('status','pending')->count();
        }
        if(session('admin')->role == 'author'){
            $countArticlesPending = Article::query()
                ->where('status','pending')
                ->where('author_id',session('admin')->id)
                ->count();
        }
        $countArticlesHidden = [];
        if(in_array(session('admin')->role, ['admin','editor'])){
            $countArticlesHidden = Article::query()->where('status','hidden')->count();
        }
        if(session('admin')->role == 'author'){
            $countArticlesHidden = Article::query()
                ->where('status','hidden')
                ->where('author_id',session('admin')->id)
                ->count();
        }
        return view('admin.dashboard',compact('countArticlesPublic','countArticlesPending','countArticlesHidden'));
    }

    public function apiCountNotification()
    {
       $data = Notification::query()->where('user_id', session('admin')->id)
           ->where('status',0)
           ->count();
       $dataContent = Notification::query()->where('user_id', session('admin')->id)
           ->where('status',0)
           ->get()->toArray();
        $json = [
            'count' => $data,
            'data' => $dataContent
        ];
        return response()->json($json, 200);
    }

    public function read(Request $request)
    {
        Notification::query()->where('id',$request->id)
            ->update(
                ['status' => 1]
            );
    }
}
