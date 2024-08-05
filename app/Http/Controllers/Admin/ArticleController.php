<?php

namespace App\Http\Controllers\Admin;

use App\Events\News;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Catelogue;
use App\Models\Follower;
use App\Models\Notification;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.articles.';
    public function index()
    {
        $data = [];
        if(in_array(session('admin')->role, ['admin', 'editor'])){
            $data = Article::query()->with(['tags','catelogue','author','editor','comments'])->orderByDesc('id')->get();
        }
        if(session('admin')->role == 'author'){
            $data = Article::query()->with(['tags','catelogue','author','editor','comments'])
                ->where('author_id',session('admin')->id)
                ->orderByDesc('id')->get();
        }
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::query()->get();
        $catelogues = Catelogue::query()->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('tags', 'catelogues'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataArticle = $request->except('tag_id','image');
        $dataArticle['author_id'] = session('admin')->id;
        $dataArticle['slug'] = Str::slug($dataArticle['title']);
        try {
            DB::beginTransaction();
            if($request->hasFile('image')){
                $dataArticle['image'] = Storage::put('articles', $request->file('image'));
            }
            $article = Article::query()->create($dataArticle);
            $article->tags()->sync($request->tag_id);
            DB::commit();
            return redirect()->route('admin.article.index');
        }catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Article::query()->with(['tags','catelogue','author'])->findOrFail($id);

        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    public function browse(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_method', '_token');
            $data['is_editor'] = $data['is_editor'] ?? 0;
            $data['is_trending'] = $data['is_trending'] ?? 0;
            $data['editor_id'] = session('admin')->id;
            Article::query()->where('id', $id)->update($data);
            $article = Article::query()->findOrFail($id);
            if($request->status == 'published'){
                Notification::query()->create([
                    'user_id' => $data['author_id'],
                    'content' => "Bài viết $request->title đã được duyệt",
                ]);
                $link = route('detail', $article->slug);
                $followers = Follower::query()->with(['member','author'])->where('author_id', $data['author_id'])->get();
                foreach ($followers as $follower){
                    News::dispatch($follower->member->name,$follower->author->name,$follower->member->email,$request->title,$link);
                }
            }else{
                Notification::query()->create([
                    'user_id' => $data['author_id'],
                    'content' => "Bài viết $request->title đã bị ẩn do vi phạm nội dung",
                ]);
            }
            DB::commit();
            return redirect()->route('admin.articles.index')->with('success', 'Duyệt thành công');
        }catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Duyệt thất bại');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Article::query()->with(['tags','catelogue','author'])->findOrFail($id);
        $dataCatelogues = Catelogue::query()->orderByDesc('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('model','dataCatelogues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
