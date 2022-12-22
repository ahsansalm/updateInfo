<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Parcel;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models\Invoices;
use App\Models\Message;
use App\Models\Notification;

class userQuotesMiddleware
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
            
        DB::table('invoices')->update(array('quote_noti' => Null));
            $Parcel = Parcel::first();
            $devices = Invoices::orderBy('id', 'DESC')->where('totalPrice','=','Devis')->get();

            $notiF = Notification::first();
            $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();
       
  
            $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
            $msg = Message::first();
    
            
            return response()->view("order.quotesOrder",compact('message','msg','notiF','notification','devices','Parcel'));  
        }
        else 
        { 
            return redirect('/home');
        }
    }
}
