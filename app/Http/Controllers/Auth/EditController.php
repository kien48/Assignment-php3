<?php

namespace App\Http\Controllers\Auth;

use App\Events\ChangePassword;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EditController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->all();
        $user = User::query()->find(Auth()->user()->id);
        $user->update($data);
        auth()->login($user);
        return back();
    }

    public function changePassword(Request $request)
    {
        $data = $request->all();
        if(!Hash::check($data['oldpass'], Auth()->user()->password)){
            $json = [
                'message' => 'Mật khẩu không đúng với mật khẩu hiện tại'
            ];
            return response()->json($json, 200);
        }

        User::query()->where('id',  Auth()->user()->id)->update([
            'password' => bcrypt($data['newpass'])
        ]);
        $json = [
            'message' => 'Mật khẩu đã đổi thành công'
        ];
        return response()->json($json, 200);
    }

}
