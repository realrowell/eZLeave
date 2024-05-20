<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notification_mark_read($id){
        // dd(Carbon::now()->timespan());
        $notifications = Notification::where('id',$id)
                        ->update([
                            'is_open' => true,
                        ]);

        return redirect()->back()->with('success','Notification has been marked as read.');
    }

    public function notification_mark_unread($id){
        // dd(Carbon::now()->timespan());
        $notifications = Notification::where('id',$id)
                        ->update([
                            'is_open' => false,
                        ]);

        return redirect()->back()->with('success','Notification has been marked as unread.');
    }
}
