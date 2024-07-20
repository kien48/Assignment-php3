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
        $userAdmin = User::query()->where('role', 'admins')->first();
        view()->share('userAdmin', $userAdmin);
        $dataTags = Tag::query()->orderByDesc('id')->get();
        view()->share('dataTags', $dataTags);
        $dataUserAuthor = User::query()->where('role', 'author')->get();
        view()->share('dataUserAuthor', $dataUserAuthor);

    }
}
