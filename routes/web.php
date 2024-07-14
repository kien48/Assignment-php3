<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
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


Route::prefix('/admin')->group(function (){
    Route::as('admin.')->group(function () {
        Route::get('/login', [AuthController::class, 'showFormLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::middleware('check.admin')->group(function (){
            Route::get('/', [DashboardController::class, 'index'])->name('home');

            Route::put('articles/browse/{id}', [ArticleController::class, 'browse'])->name('articles.browse');
            Route::resource('articles', ArticleController::class);


            Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        });

    });
});
