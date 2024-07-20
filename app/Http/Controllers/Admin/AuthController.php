<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{

    public function showFormLogin()
    {
        return view('admins.auth.login');
    }


    public function login(Request $request)
    {
        $user = User::query()
            ->where('email', $request->email)
            ->whereIn('role', ['admins', 'author', 'editor'])
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->put('admins', $user);
            return redirect()->route('admins.home');
        } else {
            return redirect()->back()->with('error', 'Email or Password is incorrect');
        }
    }


    public function logout(Request $request)
    {
        $request->session()->forget('admins');
        return redirect()->route('admins.login');
    }

    public function profile()
    {
        $user = User::query()->where('id',session('admins')->id)->select(['sayings','job','avatar'])->get()->toArray();
        $total = 0;
        $percent = 0;
        foreach ($user[0] as $key => $value) {
            if($value != null){
                $total++;
            }
        }
        if($total==0){
            $percent = 0;
        }
        $percent = $total / 3 * 100;
        return view('admins.auth.profile',compact('percent'));
    }
    public function edit()
    {
        $user = User::query()->where('id',session('admins')->id)->select(['sayings','job','avatar'])->get()->toArray();
        $total = 0;
        $percent = 0;
        foreach ($user[0] as $key => $value) {
            if($value != null){
                $total++;
            }
        }
        if($total==0){
            $percent = 0;
        }
        $percent = $total / 3 * 100;
       return view('admins.auth.edit',compact('percent'));
    }

    public function update(Request $request, int $id)
    {
        $user = User::query()->find($id);
        $data = $request->except(['avatar','_token','_method']);
        if($request->hasFile('avatar')){
            $data['avatar'] = Storage::put('admins',$request->file('avatar'));
        }
        User::query()->where('id', $id)->update($data);
        if($request->hasFile('avatar') && $user->avatar && Storage::exists( $user->avatar)){
            Storage::delete($user->avatar);
        }
        session(['admins' => User::find($id)]);
        return back();
    }
}
