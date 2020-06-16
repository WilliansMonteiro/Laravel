<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications()
    {
      $unreadNotifications =  $user = auth()->user()->unreadNotifications;
      return view('admin.notifications', compact('unreadNotifications'));

    }

    public function readAll(){
        $unreadNotifications =  $user = auth()->user()->unreadNotifications;

        $unreadNotifications->each(function($notification){
            $notification->markAsRead();
        });

        flash('Notificações lidas com sucesso')->success();
        return redirect()->back();

    }

    public function read($notification){
       $notifications = auth()->user()->notifications()->find($notification);
       $notifications->markAsRead();
       flash('Notificação lida com sucesso')->success();
        return redirect()->back();
    }
}
