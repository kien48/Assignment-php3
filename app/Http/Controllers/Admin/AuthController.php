<?php

namespace App\Http\Controllers\Admin;

use App\Events\ChangePassword;
use App\Http\Controllers\Controller;
use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{

    public function showFormLogin()
    {
        return view('admin.auth.login');
    }


    public function login(Request $request)
    {
        $user = User::query()
            ->where('email', $request->email)
            ->whereIn('role', ['admin', 'author', 'editor'])
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->put('admin', $user);
            return redirect()->route('admin.home');
        } else {
            return redirect()->back()->with('error', 'Email hoặc Mật khẩu không đúng');
        }
    }


    public function logout(Request $request)
    {
        $request->session()->forget('admin');
        return redirect()->route('admin.login');
    }

    public function profile()
    {
        $user = User::query()->where('id',session('admin')->id)->select(['sayings','job','avatar'])->get()->toArray();
        $total = 0;
        $percent = 0;
        foreach ($user[0] as $key => $value) {
            if($value != null){
                $total++;
            }
        }
        $percent = $total / 3 * 100;
        $folowers = Follower::query()->where('author_id', session('admin')->id)->count();
        $followings = Follower::query()->where('member_id', session('admin')->id)->count();
        return view('admin.auth.profile',compact('percent','folowers','followings'));
    }
    public function edit()
    {
        $user = User::query()->where('id',session('admin')->id)->select(['sayings','job','avatar'])->get()->toArray();
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
       return view('admin.auth.edit',compact('percent'));
    }

    public function update(Request $request, int $id)
    {
        $user = User::query()->find($id);
        $data = $request->except(['avatar','_token','_method']);
        if($request->hasFile('avatar')){
            $data['avatar'] = Storage::put('admin',$request->file('avatar'));
        }
        User::query()->where('id', $id)->update($data);
        if($request->hasFile('avatar') && $user->avatar && Storage::exists( $user->avatar)){
            Storage::delete($user->avatar);
        }
        session(['admin' => User::find($id)]);
        return back();
    }

    public function changePassword(Request $request)
    {
        $data = $request->all();
        if(!Hash::check($data['oldpass'], session('admin')->password)){
            $json = [
                'message' => 'Mật khẩu không đúng với mật khẩu hiện tại'
            ];
            return response()->json($json, 200);
        }

        $check = User::query()->where('id', session('admin')->id)->update([
            'password' => bcrypt($data['newpass'])
        ]);
        $name = session('admin')->name;
        $email = session('admin')->email;
        $password = $data['newpass'];
        if($check){
            ChangePassword::dispatch($name, $email, $password);
        }
        $json = [
            'message' => 'Mật khẩu đã đổi thành công'
        ];
        return response()->json($json, 200);
    }
}
