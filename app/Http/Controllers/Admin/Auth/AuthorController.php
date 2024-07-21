<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Events\Author\CreateUserAuthor;
use App\Events\Author\LookUpAuthor;
use App\Events\Author\UnLockAuthor;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.auth.authors.';
    public function index()
    {
        $data = User::query()->where('role', 'author')->get();
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
        $data['role'] = 'author';
        $check = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role']
        ]);
        if($check){
            CreateUserAuthor::dispatch($data['name'], $data['email'], $data['password']);
            return redirect()->route('admin.users.authors.index');
        }
        return back();

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

    public function lookUpAuthor(int $id)
    {
        $user = User::query()->where('id', $id)->first();
        $data = User::query()->where('id', $id)->update([
            'is_active' => 1
        ]);
        if($data){
            LookUpAuthor::dispatch($user->name, $user->email);
        }
        return back()->with('success', 'Khóa thành công');
    }
    public function unLockAuthor(int $id)
    {
        $user = User::query()->where('id', $id)->first();
        $data = User::query()->where('id', $id)->update([
            'is_active' => 0
        ]);
        if($data){
            UnLockAuthor::dispatch($user->name, $user->email);
        }
        return back()->with('success', 'Mở khóa thành công');
    }
}
