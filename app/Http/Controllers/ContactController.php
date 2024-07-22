<?php

namespace App\Http\Controllers;

use App\Models\AuthorRegistration;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
       $data = $request->all();
       $dataAuthorRegistration = AuthorRegistration::query()->get();
       foreach ($dataAuthorRegistration as $item){
           if($item->email == $data['email']){
               return back()->with('error', 'Đăng ký thất bại do đã có email này đã đăng ký rồi');
           }
       }
        $dataAdmins = User::query()->where('role', 'admin')->pluck('id')->toArray();
        $randomIdAdmin = $dataAdmins[array_rand($dataAdmins)];
        try {
            DB::beginTransaction();
           $check = AuthorRegistration::query()->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'job' => $data['job'],
                'reason' => $data['reason'],
                'handler_id' => $randomIdAdmin
            ]);
            Notification::query()->create([
                'content' => 'Đăng ký làm tác giả: ' . $data['name'],
                'user_id' => $check->handler_id
            ]);
            DB::commit();
            return back()->with('success', 'Đăng ký thành công');
        }catch (Exception $exception){
            DB::rollBack();
            return back()->with('error', 'Đăng ký thất bại');

        }

    }
}
