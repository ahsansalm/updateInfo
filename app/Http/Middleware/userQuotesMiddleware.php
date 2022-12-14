<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Parcel;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models\Invoices;

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
            return response()->view("order.quotesOrder",compact('devices','Parcel'));  
        }
        else 
        { 
            return redirect('/home');
        }
    }
}
