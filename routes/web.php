<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AuthController;
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
Route::get('detail/{slug}',[App\Http\Controllers\ArticleController::class,'detail'])->name('detail');
Route::get('tag/{id}/{slug}',[App\Http\Controllers\TagController::class,'tag'])->name('tag');
Route::get('/authors',[App\Http\Controllers\AuthorController::class,'index'])->name('authors');
Route::get('/author/{id}',[App\Http\Controllers\AuthorController::class,'detail'])->name('author.detail');

Route::get('/contact',[App\Http\Controllers\ContactController::class,'index'])->name('contact');
Route::view('/thong-tin-ve-toi', 'about-me')->name('about');
Route::get('catelogue/{slug}',[App\Http\Controllers\CatelogueController::class,'index'])->name('catelogue');
Route::get('/search', [App\Http\Controllers\ArticleController::class,'search'])->name('articles.search');


Route::prefix('/admin')->group(function (){
    Route::as('admin.')->group(function () {
        Route::get('/login', [AuthController::class, 'showFormLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::middleware('check.admin')->group(function (){
            Route::get('/', [DashboardController::class, 'index'])->name('home');

            Route::put('articles/browse/{id}', [ArticleController::class, 'browse'])->name('articles.browse');
            Route::resource('articles', ArticleController::class);
            Route::resource('tags', TagController::class);

            Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        });

        Route::as('api.')->group(function () {
            Route::get('/tags', [TagController::class, 'apiGetTags'])->name('tag');
        });
    });
});
