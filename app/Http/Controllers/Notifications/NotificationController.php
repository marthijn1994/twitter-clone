<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function index()
    {
        return view('notifications.index');
    }

}
