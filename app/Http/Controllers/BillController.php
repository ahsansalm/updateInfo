<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoices;
use App\Models\Parcel;
use Auth;
use App\Models\user_total_credit;
use DB;

class BillController extends Controller
{
    //page 
    public function myBill(){
        $id = Auth::user()->id;
        $invoices = Invoices::where('user_id',$id)->orderBy('id','DESC')->get();
        $Parcel = Parcel::where('userId' , $id)->first();
        $Invoice = Invoices::where('user_id' , $id)->first();
        return view("bill.index",compact('Invoice','invoices','Parcel'));    
    }
    // edi tpage
     // edit bill page
     public function EditBill($id){
        $bills = Invoices::find($id);
        $userId = Auth::user()->id;
        $Parcel = Parcel::where('userId' , $userId)->first();
        $Invoice = Invoices::where('user_id' , $userId)->first();
        return view("bill.detail",compact('Invoice','bills','Parcel'));    
    }

    // PayerBillDetail
    public function PayerBillDetail($id){
      $bills = Invoices::find($id);
      $userId = Auth::user()->id;
      $Parcel = Parcel::where('userId' , $userId)->first();
      $Invoice = Invoices::where('user_id' , $userId)->first();
      return view("bill.payerdetail",compact('Invoice','bills','Parcel'));    
  }



    // pay bill
    public function PayerBill(Request $request,$id){
      $userId = Auth::user()->id;
      $price = $request->price;
      $amount =  user_total_credit::where('user_id' ,'=', $userId)->first();
      $newcredits = $amount->credits;
      $total = $newcredits-$price;
      // dd($total);
      if($total >= "0"){
        DB::table('parcels')->update(array('order_noti' => 'Nouveau'));
        DB::table('invoices')->update(array('quote_noti' => 'neuf'));
          $values = [
            'credits'  => $total,
        ];
        DB::table('user_total_credits')->where('user_id', '=', $userId)->update($values);


        Invoices::find($id)->update([
          'payStatus' => 'Payé',
          'userCreditDate' => date('Y-m-d'),
      ]);
      $notification = array(
          'message' => 'Payé avec succès!',
          'alert_type' => 'success'
      );
      return Redirect('/MyBill')->with( $notification); 
      }else{
        $notification = array(
          'message' => 'Vous navez pas assez de crédits!',
          'alert_type' => 'error'
      );
      return Redirect()->back()->with( $notification); 
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
         $Parcel = Parcel::first();
         return view("bill.search",compact('search','invoices','Parcel')); 
   
       }

}
