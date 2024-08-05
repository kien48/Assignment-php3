<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\Auth\AuthorController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CatelogueController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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
Route::post('/theo-doi',[App\Http\Controllers\AuthorController::class,'follow'])->name('follow');
Route::post('/huy-theo-doi',[App\Http\Controllers\AuthorController::class,'unFollow'])->name('unFollow');

Route::get('/tac-gia',[App\Http\Controllers\AuthorController::class,'index'])->name('authors');
Route::get('/tac-gia/{id}',[App\Http\Controllers\AuthorController::class,'detail'])->name('author.detail');

Route::get('/lien-he',[App\Http\Controllers\ContactController::class,'index'])->name('contact');
Route::post('/lien-he',[App\Http\Controllers\ContactController::class,'store'])->name('contact.store');

Route::get('danh-muc/{slug}',[App\Http\Controllers\CatelogueController::class,'index'])->name('catelogue');
Route::get('/tim-kiem', [App\Http\Controllers\ArticleController::class,'search'])->name('articles.search');
Route::middleware('auth')->group(function (){
    Route::patch('/thay-doi-thong-tin',[App\Http\Controllers\Auth\EditController::class,'update'])->name('update.info');
    Route::patch('/thay-doi-mat-khau',[App\Http\Controllers\Auth\EditController::class,'changePassword'])->name('user.changePassword');
});

Auth::routes();
Route::post('/binh-luan-nhe', [App\Http\Controllers\ArticleController::class, 'addComment'])->name('addComment');
Route::as('api.')->group(function () {
    Route::get('/binh-luan/{id}', [App\Http\Controllers\ArticleController::class, 'apiComment'])->name('apiComment');
});

Route::prefix('/admin')->group(function (){
    Route::as('admin.')->group(function () {
        Route::get('/login', [AuthController::class, 'showFormLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::middleware(['check.admin','check.active.admin'])->group(function (){
            Route::get('/', [DashboardController::class, 'index'])->name('home');
            Route::put('articles/browse/{id}', [ArticleController::class, 'browse'])->name('articles.browse');
            Route::resource('articles', ArticleController::class);
            Route::resource('tags', TagController::class);
            Route::get('catelogues', [CatelogueController::class, 'index'])->name('catelogues.index');
            Route::resource('catelogues', CatelogueController::class)->except(['index'])->middleware('check.role.editor');
            Route::prefix('users')->as('users.')->group(function () {
               Route::middleware('check.role.admin')->group(function () {
                   Route::get('authors/tai-khoan-dang-ky/tạo-tai-khoan/{id}', [App\Http\Controllers\Admin\Auth\AuthorController::class, 'create2'])->name('authors.create2');
                   Route::get('authors/tai-khoan-dang-ky', [App\Http\Controllers\Admin\Auth\AuthorController::class, 'listAuthorRegiter'])->name('authors.listAuthorRegiter');
                   Route::get('authors/khoa-tai-khoan/{id}', [App\Http\Controllers\Admin\Auth\AuthorController::class, 'lookUpAuthor'])->name('authors.lookUpAuthor');
                   Route::get('authors/mo-tai-khoan/{id}', [App\Http\Controllers\Admin\Auth\AuthorController::class, 'unLockAuthor'])->name('authors.unLockAuthor');
                   Route::get('editors/khoa-tai-khoan/{id}', [App\Http\Controllers\Admin\Auth\EditorController::class, 'lookUpEditor'])->name('editors.lookUpEditor');
                   Route::get('editors/mo-tai-khoan/{id}', [App\Http\Controllers\Admin\Auth\EditorController::class, 'unLockEditor'])->name('editors.unLockEditor');
                   Route::get('admins/khoa-tai-khoan/{id}', [App\Http\Controllers\Admin\Auth\AdminController::class, 'lookUpAdmin'])->name('admins.lookUpAdmin');
                   Route::get('admins/mo-tai-khoan/{id}', [App\Http\Controllers\Admin\Auth\AdminController::class, 'unLockAdmin'])->name('admins.unLockAdmin');
                   Route::get('members/khoa-tai-khoan/{id}', [App\Http\Controllers\Admin\Auth\MemberController::class, 'lookUpMember'])->name('members.lookUpMember');
                   Route::get('members/mo-tai-khoan/{id}', [App\Http\Controllers\Admin\Auth\MemberController::class, 'unLockMember'])->name('members.unLockMember');
                   Route::resource('members', App\Http\Controllers\Admin\Auth\MemberController::class);
                   Route::resource('admins', App\Http\Controllers\Admin\Auth\AdminController::class);
                   Route::resource('editors', App\Http\Controllers\Admin\Auth\EditorController::class)->except(['index']);
                   Route::resource('authors', AuthorController::class)->except(['index']);

               });

                Route::get('authors', [AuthorController::class, 'index'])->name('authors.index');
                Route::get('editors', [App\Http\Controllers\Admin\Auth\EditorController::class, 'index'])->name('editors.index');
            });
            Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
            Route::put('/change-password', [AuthController::class, 'changePassword'])->name('changePassword');
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


