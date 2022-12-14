<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Support;
use App\Models\ProblemReply;
use auth;
class NotificationController extends Controller
{
    // notification page
    public function notification(){
        $id = Auth::user()->id;
        $ProblemReply = ProblemReply::where('userId',$id)->orderBy('id', 'DESC')->get();
        return view("notification.index",compact('ProblemReply'));
    }
    // notification detail
    public function notiDetail($id){
        $userId = Auth::user()->id;
        $supports = Support::where('userId',$userId)->where('productId',$id)->get();
        $reply = ProblemReply::where('userId',$userId)->where('productId',$id)->get();
        return view("notification.detail",compact('supports','reply'));   
    }
}
