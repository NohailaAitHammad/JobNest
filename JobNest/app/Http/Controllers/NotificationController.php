<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        Auth::user()->unreadNotifications->where('id', $id)->markAsRead();
        return redirect()->back();
    }

    public function markAllRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function index()
    {
        $notifications = Auth::user()->notifications()->latest()->paginate(15);

        return view('notifications.index', compact('notifications'));
    }
}
