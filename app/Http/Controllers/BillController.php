<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoices;
use App\Models\Parcel;
use App\Models\Notification;
use App\Models\Message;
use Auth;
use App\Models\AdminPayCreditsNoti;
use App\Models\user_total_credit;
use App\Models\UsedCredit;
use App\Models\UserPayCreditsNoti;
use Illuminate\Support\Carbon;
use DB;

class BillController extends Controller
{
    //page 
    public function myBill(){
        $id = Auth::user()->id;
        $notiF2 = Notification::where('userId',$id)->first();
        $notification2 = Notification::where('productId','=',NULL)->where('userId',$id)->orderBy('id','desc')->get();
  
   
        DB::table('invoices')->where('user_id', '=', $id)->update(array('billStatus' => NULL));

        $invoices = Invoices::where('user_id',$id)->orderBy('id','DESC')->get();
        $Parcel = Parcel::where('userId' , $id)->first();
        $Invoice = Invoices::where('user_id' , $id)->first();
        $message2 = Message::where('or_status','=','User')->where('userId',$id)->orderBy('id','desc')->get();
        $msg2 = Message::where('userId',$id)->first();
        $paymentU2 = AdminPayCreditsNoti::where('userId',$id)->orderBy('id','desc')->get();
        $payU2 = AdminPayCreditsNoti::where('userId' , $id)->first();

        
        return view("bill.index",compact('paymentU2','payU2','message2','msg2','notiF2','notification2','Invoice','invoices','Parcel'));    
    }
    // edi tpage
     // edit bill page
     public function EditBill($id){
        $bills = Invoices::find($id);
        $userId = Auth::user()->id;
        $Parcel = Parcel::where('userId' , $userId)->first();
        $Invoice = Invoices::where('user_id' , $userId)->first();
        $notiF2 = Notification::where('userId',$userId)->first();
        $notification2 = Notification::where('productId','=',NULL)->where('userId',$userId)->orderBy('id','desc')->get();  
  
        $message2 = Message::where('or_status','=','User')->where('userId',$id)->orderBy('id','desc')->get();
        $msg2 = Message::where('userId',$userId)->first();
        $paymentU2 = AdminPayCreditsNoti::where('userId',$id)->orderBy('id','desc')->get();
        $payU2 = AdminPayCreditsNoti::where('userId' , $userId)->first();
        return view("bill.detail",compact('paymentU2','payU2','message2','msg2','notiF2','notification2','Invoice','bills','Parcel'));    
    }

    // PayerBillDetail
    public function PayerBillDetail($id){
      $bills = Invoices::find($id);
      $userId = Auth::user()->id;
      $Parcel = Parcel::where('userId' , $userId)->first();
      $Invoice = Invoices::where('user_id' , $userId)->first();
      $notiF2 = Notification::where('userId',$userId)->first();
      $notification2 = Notification::where('productId','=',NULL)->where('userId',$userId)->orderBy('id','desc')->get();
      $message2 = Message::where('or_status','=','User')->where('userId',$id)->orderBy('id','desc')->get();
      $msg2 = Message::where('userId',$userId)->first();

      $paymentU2 = AdminPayCreditsNoti::where('userId',$userId)->orderBy('id','desc')->get();
      $payU2 = AdminPayCreditsNoti::where('userId' , $userId)->first();


      return view("bill.payerdetail",compact('paymentU2','payU2','message2','msg2','paymentU2','payU2','message2','msg2','notiF2','notification2','Invoice','bills','Parcel'));    
  }



    // pay bill
    public function PayerBill(Request $request,$id){


      $userId = Auth::user()->id;
      $price = $request->price;
      $product = $request->product;

      $service = $request->service;


      if($price == 'Devis'){
        $notification = array(
          'message' => 'Le prix de votre service est entre guillemets!',
          'alert_type' => 'error'
        );
        return Redirect()->back()->with( $notification); 
      }
      else
      {
          $amount =  user_total_credit::where('user_id' ,'=', $userId)->first();
          $newcredits = $amount->credits;
          $total = $newcredits-$price;
          // dd($total);
          if($total >= "0"){
            $data = DB::table('invoices')->where('id', '=', $id)->first();
            if($data->Paid === 'Nous. Payé' || $data->Paid === 'Un d. Payé')
            {
              $notification = array(
                'message' => 'Vous avez déjà payé!',
                'alert_type' => 'warning'
            );
            return Redirect()->back()->with( $notification); 
            }
            else{

        
                  DB::table('parcels')->update(array('order_noti' => 'Nouveau'));
                  $values = [
                    'credits'  => $total,
                ];
                DB::table('user_total_credits')->where('user_id', '=', $userId)->update($values);

                UsedCredit::insert([
                  'userId' => $userId,
                  'product' => $product,
                  'service' => $service,
                  'amount' => $price,
                  'created_at' => Carbon::now(),
              ]);


              DB::table('user_pay_credits_notis')->update(array('status' => 'Neuf'));
              UserPayCreditsNoti::insert([
                'userId' => $userId,
                'productId' => $product,
                'description' =>'Payez avec succès',
                'status' => 'Neuf',
                'created_at' => Carbon::now(),
            ]);

              

                Invoices::find($id)->update([
                  'payStatus' => 'Payé',
                  'Paid' => 'Nous. Payé',
                  'userCreditDate' => date('Y-m-d'),
              ]);
              $notification = array(
                  'message' => 'Payé avec succès!',
                  'alert_type' => 'success'
              );
              return Redirect('/MyBill')->with( $notification); 
            }
            
          }
          else{
            $notification = array(
              'message' => 'Vous navez pas assez de crédits!',
              'alert_type' => 'error'
          );
          return Redirect()->back()->with( $notification); 
          }
      }

      
  }


    
       // search bill
       public function searchbill(Request $request)
       { 
         $search = $request->search ?? "";
         $id = Auth::user()->id;
         if($search != ""){
           $invoices = Invoices::where('product','LIKE','%'.$search.'%')->where('user_id',$id)->get();
             
         }else{
            $invoices = Invoices::where('user_id',$id)->orderBy('id','DESC')->get(); 
       }
         $Parcel = Parcel::where('userId',$id)->first();
         $notiF2 = Notification::where('userId',$id)->first();
         $notification2 = Notification::where('productId','=',NULL)->where('userId',$id)->orderBy('id','desc')->get();
   
         $message2 = Message::where('or_status','=','User')->where('userId',$id)->orderBy('id','desc')->get();
         $msg2 = Message::where('userId',$id)->first();
            $paymentU2 = AdminPayCreditsNoti::where('userId',$id)->orderBy('id','desc')->get();
        $payU2 = AdminPayCreditsNoti::where('userId' , $id)->first();
  
         return view("bill.search",compact('paymentU2','payU2','message2','msg2','notiF2','notification2','search','invoices','Parcel')); 
   
       }



       // downlado user pdf
       public function DownloadPDFUser(Request $request,$file){
        return response()->download(public_path('pdf/'.$file));
       }

}
