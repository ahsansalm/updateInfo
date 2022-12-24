<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Parcel;
use App\Models\Invoices;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Message;
use App\Models\UserPayCreditsNoti;
use Auth;
use DB;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user()->role_as;
        if ($user == 1) {
            DB::table('parcels')->where('admin_noti', '=', 'Nouveau')->update(array('admin_noti' => 1));
            $Parcel = Parcel::first();
            $notiF = Notification::first();
            $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();


            $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
            $msg = Message::first();

            
            $supports = Parcel::all();
            $Invoice = Invoices::first();
            $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
            $payU = UserPayCreditsNoti::first();
            
            return response()->view('problem.index',compact('paymentU','payU','message','msg','notification','notiF','Invoice','supports','Parcel'));
        }
        else 
        { 
            return redirect('/home');
        }



    }
}
