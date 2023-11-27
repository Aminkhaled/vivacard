<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Kutia\Larafirebase\Facades\Larafirebase;


class NotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
          $request->validate([
        'title'=>'required',
        'message'=>'required'
    ]);

    try{
        $fcmTokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

     

        Larafirebase::withTitle($request->title)
            ->withBody($request->message)
            ->sendMessage($fcmTokens);

        return redirect()->back()->with('success','Notification Sent Successfully!!');

    }catch(\Exception $e){
        report($e);
        return redirect()->back()->with('error','Something goes wrong while sending notification.');
    }
     
    }
}