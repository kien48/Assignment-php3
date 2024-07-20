<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catelogue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CatelogueController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admins.catelogues.';
    public function index()
    {
        $data = Catelogue::query()->orderByDesc('id')->get();
        return view(self::PATH_VIEW.__FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW.__FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('image');
        $data['slug'] = Str::slug($data['name']);
        if($request->hasFile('image')){
            $data['image'] = Storage::put('catelogue',$request->file('image'));
        }
        $check = Catelogue::query()->create($data);
        if($check){
            return redirect()->route('admins.catelogues.index')->with('success','Thêm danh mục thành công');
        }
        return back()->with('error','Thêm danh mục thất bại');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Catelogue::query()->find($id);
        return view(self::PATH_VIEW.__FUNCTION__, compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = Catelogue::query()->find($id);
        $data = $request->except(['image','_token','_method']);
        $data['slug'] = Str::slug($data['name']);
        if($request->hasFile('image')){
            $data['image'] = Storage::put('catelogue',$request->file('image'));
        }
        $check = Catelogue::query()->find($id)->update($data);
        if($request->hasFile('image') && $model->image && Storage::exists($model->image)){
            Storage::delete($model->image);
        }
        if($check){
            return redirect()->route('admins.catelogues.index')->with('success','Cập nhật danh mục thành công');
        }
        return back()->with('error','Cập nhật danh mục thất bại');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
