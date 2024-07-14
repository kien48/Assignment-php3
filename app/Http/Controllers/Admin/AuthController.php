<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            return redirect()->back()->with('error', 'Email or Password is incorrect');
        }
    }


    public function logout(Request $request)
    {
        $request->session()->forget('admin');
        return redirect()->route('admin.login');
    }
}
