<?php

namespace App\Providers;

use App\Models\Catelogue;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $dataCatelogues = Catelogue::query()
            ->select('catelogues.id', 'catelogues.name', 'catelogues.slug',
                DB::raw('count(articles.id) as total'))
            ->leftJoin('articles', 'articles.catelogue_id', '=', 'catelogues.id')
            ->where('articles.status', 'published')
            ->groupBy('catelogues.id', 'catelogues.name', 'catelogues.slug')
            ->orderByDesc('catelogues.id')
            ->get();
        view()->share('dataCatelogues', $dataCatelogues);
        $userAdmin = User::query()->where('role', 'admin')->first();
        view()->share('userAdmin', $userAdmin);
        $dataTags = Tag::query()->orderByDesc('id')->get();
        view()->share('dataTags', $dataTags);
        $dataUserAuthor = User::query()
            ->select('users.*', DB::raw('COUNT(articles.author_id) as article_count'))
            ->join('articles', 'articles.author_id', '=', 'users.id')
            ->where('users.role', 'author')
            ->groupBy('users.id')
            ->havingRaw('COUNT(articles.author_id) > 0')
            ->get();
        view()->share('dataUserAuthor', $dataUserAuthor);

    }
}
