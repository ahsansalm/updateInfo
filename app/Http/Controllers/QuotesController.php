<?php

namespace App\Http\Controllers;
use App\Models\Parcel;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models\Invoices;

class QuotesController extends Controller
{
    // page
    public function myQuotes(){
      $id = Auth::user()->id;
      DB::table('invoices')->where('user_id', '=', $id)->update(array('user_quote_noti' => Null));
      $Parcel = Parcel::where('userId' , $id)->first();
        $devices = Invoices::where('user_id',$id)->where('totalPrice', 'Devis')->orderBy('id', 'DESC')->where('status','!=','Pending')->get();
        return view("quotes.index",compact('devices','Parcel'));    
    }

    // quotes approved order
    public function quotesValue(Request $request,$id){
        Invoices::find($id)->update([
            'totalPrice' => $request->Price,
        ]);
        $notification = array(
            'message' => ' Commande effectuée avec succès!',
            'alert_type' => 'success'
        );
        return Redirect()->back()->with( $notification);
    }

    
    
       // search quote
       public function searchquote(Request $request)
       { 
         $search = $request->search ?? "";
         $id = Auth::user()->id;
         if($search != ""){
           $devices = Invoices::where('product','LIKE','%'.$search.'%')->where('totalPrice', 'DevisDevis')->where('user_id',$id)->where('status','!=','Pending')->get();
             
         }else{
            $devices = Invoices::where('user_id',$id)->where('totalPrice', 'Devis')->orderBy('id', 'DESC')->where('status','!=','Pending')->get();     
       }
         $Parcel = Parcel::first();
         return view("quotes.search",compact('search','devices','Parcel'));  
   
       }


}
