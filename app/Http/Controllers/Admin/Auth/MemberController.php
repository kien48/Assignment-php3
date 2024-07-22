<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.auth.members.';

    public function index()
    {
        $data = User::query()->where('role', 'member')->get();
        return view(self::PATH_VIEW.__FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function lookUp(int $id)
    {
        $user = User::query()->where('id', $id)->first();
        $data = User::query()->where('id', $id)->update([
            'is_active' => 1
        ]);
        return back()->with('success', 'Khóa thành công');
    }
    public function unLockMembers(int $id)
    {
        $user = User::query()->where('id', $id)->first();
        $data = User::query()->where('id', $id)->update([
            'is_active' => 0
        ]);
        return back()->with('success', 'Mở khóa thành công');
    }
}
