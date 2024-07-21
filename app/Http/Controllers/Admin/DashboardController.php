<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function apiCountNotification()
    {
       $data = Notification::query()->where('user_id', session('admin')->id)
           ->where('status',0)
           ->count();
       $dataContent = Notification::query()->where('user_id', session('admin')->id)
           ->where('status',0)
           ->get()->toArray();
        $json = [
            'count' => $data,
            'data' => $dataContent
        ];
        return response()->json($json, 200);
    }

    public function read(Request $request)
    {
        Notification::query()->where('id',$request->id)
            ->update(
                ['status' => 1]
            );
    }
}
