<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class adminControler extends Controller
{
    public function index()
    {
        $admin = Admin::find(1);
        $notifications = $admin->unreadNotifications;
        return view('Admin.dashbord.dashbord', compact('notifications'));
    }
    public function markNotification(Request $request) {
        $admin = Admin::find(1);
        $admin->unreadNotifications->when($request->input('id'),function($query) use ($request){
            return $query->where('id',$request->input('id'));
        })->markAsRead();
    }
    public function send(){
        return view('Admin.dashbord.send');
    }
}
