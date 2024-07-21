<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.tags.';
    public function index()
    {
        $data = Tag::query()->orderByDesc('id')->orderByDesc('id')->get();
        return view(self::PATH_VIEW.__FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW.__FUNCTION__);
    }
    public function apiGetTags()
    {
        $tags = Tag::query()->orderByDesc('id')->get();
        $json = [
            'data' => $tags
        ];
        return response()->json($json,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);
        $dataTag = Tag::query()->get();
        foreach ($dataTag as $item){
            if($item->name == $data['name']){
                return response()->json()->json(['message' => 'Tag đã tồn tại']);
            }
        }
        Tag::query()->create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Tag::query()->find($id);
        return view(self::PATH_VIEW.__FUNCTION__, compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $model = Tag::query()->find($id);
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);
        $existingTag = Tag::where('name', $data['name'])->where('id', '!=', $id)->first();
        if ($existingTag) {
            return back()->with('error', 'Thẻ đã tồn tại trong hệ thống');
        }
        $model->update($data);
        return redirect()->back()->with('success', 'Thẻ đã được cập nhật');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Tag::query()->find($id);
        $dataArticleTag = DB::table('article_tag')->where('tag_id', $id)->get();
        foreach ($dataArticleTag as $item){
            if($item->tag_id == $id){
                return redirect()->back()->with('error', 'Tag đang được sử dụng');
            }
        }
        $model->delete();
        return back()->with('success', 'Thẻ đã được xóa');
    }
}
