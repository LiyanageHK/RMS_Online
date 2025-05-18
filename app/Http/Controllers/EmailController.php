<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
//use App\Mail\CustomerNotification;
use App\Mail\CustomerNotificationMail;
use App\Models\User;

class EmailController extends Controller
{



public function sendBulkEmail(Request $request)
{
    $subject = $request->input('subject');
    $body = $request->input('body');
    $userIds = $request->input('user_ids', []);

    $users = User::whereIn('user_id', $userIds)->get();

    foreach ($users as $user) {

            Mail::to($user->email)->send(new CustomerNotificationMail($subject, $body));
    }

    return redirect()->back()->with('success', 'Emails sent successfully!');
}

}
