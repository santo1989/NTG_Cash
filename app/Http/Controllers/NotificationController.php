<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function showForUpdating($id, $notification_id)

    {
        $notifications = Notification::find($notification_id)->latest();
        $notifications->status = 'read';
        $notifications->color = 'green';
        $notifications->update();
        return view('home', [
            'notifications' => $notifications
        ]);
    }

    public function read($id)
    {
        $notifications = Notification::find($id);
        $notifications->status = 'read';
        $notifications->color = 'gray';
        $notifications->update();
        return redirect()->back();
    }
}
