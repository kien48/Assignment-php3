<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Events\Author\LookUpAuthor;
use App\Events\Author\UnLockAuthor;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.auth.editors.';

    public function index()
    {
        $data = User::query()->where('role', 'editor')->get();
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
        $data = $request->all();
        $data['role'] = 'editor';
        $check = User::query()->create([
            'name' => 'Biên tập '.$data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);

        if ($check) {
            return redirect()->route('admin.users.editors.index')->with('success', 'Tạo tài khoản thành công');
        }
        return back()->with('error', 'Tạo tài khoản thất bại');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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

    public function lookUpEditor(int $id)
    {
        $user = User::query()->where('id', $id)->first();
        $data = User::query()->where('id', $id)->update([
            'is_active' => 1
        ]);
        return back()->with('success', 'Khóa thành công');
    }
    public function unLockEditor(int $id)
    {
        $user = User::query()->where('id', $id)->first();
        $data = User::query()->where('id', $id)->update([
            'is_active' => 0
        ]);
        return back()->with('success', 'Mở khóa thành công');
    }
}
