<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoices;
use App\Models\Parcel;
use Auth;

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

    // pay bill
    public function PayerBill($id){
      Invoices::find($id)->update([
        'payStatus' => 'Payé',
    ]);
    $notification = array(
        'message' => 'Payé avec succès!',
        'alert_type' => 'success'
    );
    return Redirect()->back()->with( $notification); 
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
