<?php

namespace App\Http\Middleware;
use App\Models\Notification;
use Closure;
use Illuminate\Http\Request;
use App\Models\Parcel;
use App\Models\Message;
use Auth;
use DB;
use App\Models\Invoices;
use App\Models\UserPayCreditsNoti;
class userOrderMiddleware
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
            DB::table('parcels')->where('order_noti', '=', 'Nouveau')->update(array('order_noti' => 1));

            $Parcel = Parcel::first();
            $Invoice = Invoices::where('totalPrice','Devis')->first();
             $devices = Invoices::where('totalPrice','!=','Devis')->orderBy('id', 'DESC')->get();
            $totalOrder = DB::table('parcels')->count();
            $pendingOrder = DB::table('parcels')->where('status','pending')->count();
            $approvedOrder = DB::table('parcels')->where('status','Approved')->count();
            $notiF = Notification::first();
            $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();
            $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
            $msg = Message::first();


            $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
            $payU = UserPayCreditsNoti::first();
            return response()->view("order.userOrder",compact('paymentU','payU','message','msg','notiF','notification','devices','totalOrder','pendingOrder','approvedOrder','Parcel','Invoice')); 

        }
        else 
        { 
            return redirect('/home');
        }
    }
}
