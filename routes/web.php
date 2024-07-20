<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CatelogueController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('chi-tiet/{slug}',[App\Http\Controllers\ArticleController::class,'detail'])->name('detail');
Route::patch('/tang-view',[App\Http\Controllers\ArticleController::class,'views'])->name('views');

Route::get('tag/{id}/{slug}',[App\Http\Controllers\TagController::class,'tag'])->name('tag');
Route::get('/tac-gia',[App\Http\Controllers\AuthorController::class,'index'])->name('authors');
Route::get('/tac-gia/{id}',[App\Http\Controllers\AuthorController::class,'detail'])->name('author.detail');

Route::get('/lien-he',[App\Http\Controllers\ContactController::class,'index'])->name('contact');
Route::view('/thong-tin-ve-toi', 'about-me')->name('about');
Route::get('danh-muc/{slug}',[App\Http\Controllers\CatelogueController::class,'index'])->name('catelogue');
Route::get('/tim-kiem', [App\Http\Controllers\ArticleController::class,'search'])->name('articles.search');


Route::prefix('/admin')->group(function (){
    Route::as('admin.')->group(function () {
        Route::get('/login', [AuthController::class, 'showFormLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::middleware('check.admin')->group(function (){
            Route::get('/', [DashboardController::class, 'index'])->name('home');
            Route::put('articles/browse/{id}', [ArticleController::class, 'browse'])->name('articles.browse');
            Route::resource('articles', ArticleController::class);
            Route::resource('tags', TagController::class);
            Route::resource('catelogues', CatelogueController::class);

            Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
            Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
            Route::as('profile.')->group(function (){
                Route::get('/profile/edit', [AuthController::class, 'edit'])->name('edit');
                Route::put('/profile/edit/{id}', [AuthController::class, 'update'])->name('update');
            });
            Route::patch('/da-xem', [DashboardController::class, 'read'])->name('read');

        });

        Route::as('api.')->group(function () {
            Route::get('/tag', [TagController::class, 'apiGetTags'])->name('tag');
            Route::get('/dem-so-tin', [DashboardController::class, 'apiCountNotification'])->name('apiCountNotification');

        });
    });
});
