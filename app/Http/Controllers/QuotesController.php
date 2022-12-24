<?php

namespace App\Http\Controllers;
use App\Models\Parcel;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models\Invoices;
use App\Models\Message;
use App\Models\AdminPayCreditsNoti;
use App\Models\Notification;

class QuotesController extends Controller
{
    // page
    public function myQuotes(){
      $id = Auth::user()->id;
      DB::table('invoices')->where('user_id', '=', $id)->update(array('user_quote_noti' => Null));
        $Parcel = Parcel::where('userId' , $id)->first();
        $devices = Invoices::where('user_id',$id)->where('totalPrice', 'Devis')->orderBy('id', 'DESC')->where('status','!=','Pending')->get();
        $notiF2 = Notification::where('userId',$id)->first();
        $notification2 = Notification::where('productId','=',NULL)->where('userId',$id)->orderBy('id','desc')->get();
        $message2 = Message::where('or_status','=','User')->where('userId',$id)->orderBy('id','desc')->get();
        $msg2 = Message::where('userId',$id)->first();
        
        $paymentU2 = AdminPayCreditsNoti::where('userId',$id)->orderBy('id','desc')->get();
        $payU2 = AdminPayCreditsNoti::where('userId' , $id)->first();

   
        return view("quotes.index",compact('paymentU2','payU2','message2','msg2','notiF2','notification2','devices','Parcel'));    
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
         $notiF2 = Notification::where('userId',$id)->first();
         $notification2 = Notification::where('productId','=',NULL)->where('userId',$id)->orderBy('id','desc')->get();
         $message2 = Message::where('or_status','=','User')->where('userId',$id)->orderBy('id','desc')->get();
         $msg2 = Message::where('userId',$id)->first();
         $paymentU2 = AdminPayCreditsNoti::where('userId',$id)->orderBy('id','desc')->get();
         $payU2 = AdminPayCreditsNoti::where('userId' , $id)->first();
 
    
   
         return view("quotes.search",compact('paymentU2','payU2','message2','msg2','notiF2','notification2','search','devices','Parcel'));  
   
       }


}
