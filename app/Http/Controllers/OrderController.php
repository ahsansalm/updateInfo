<?php

namespace App\Http\Controllers;
use App\Models\Parcel;
use Auth;
use DB;
use App\Models\Payment;
use App\Models\user_total_credit;
use Illuminate\Http\Request;
use App\Models\Invoices;

class OrderController extends Controller
{
     //page
     public function myOrder(){
        $id = Auth::user()->id;

        DB::table('parcels')->where('userId', '=', $id)->update(array('order_approved_noti' => Null));


        $Parcel = Parcel::where('userId' , $id)->first();
        
        $Invoice = Invoices::where('user_id' , $id)->first();
        $devices = Parcel::where('userId',$id)->orderBy('id', 'DESC')->where('status','en attendant')->orWhere('status','Refus')->orderBy('id', 'DESC')->get();
        return view("order.index",compact('Invoice','devices','Parcel'));
    }

    
       // search bill
       public function searchnorapproved(Request $request)
       { 
         $search = $request->search ?? "";
         $id = Auth::user()->id;
         if($search != ""){
                     $devices = Parcel::where('product','LIKE','%'.$search.'%')->where('userId',$id)->orderBy('id', 'DESC')->where('status','en attendant')->orWhere('status','Refus')->orderBy('id', 'DESC')->get();          
         }else{
        $devices = Parcel::where('userId',$id)->orderBy('id', 'DESC')->where('status','en attendant')->orWhere('status','Refus')->orderBy('id', 'DESC')->get();
        }
        
        $Parcel = Parcel::where('userId' , $id)->first();
         return view("order.indexsearch",compact('search','devices','Parcel'));
   
       }





    // all user order page
    public function userorder(){
        DB::table('parcels')->where('order_noti', '=', 'Nouveau')->update(array('order_noti' => 1));
        $Invoice = Invoices::where('totalPrice','Devis')->first();
        $devices = Invoices::where('totalPrice','!=','Devis')->orderBy('id', 'DESC')->get();
        $Parcel = Parcel::first();
        return view("order.userOrder",compact('devices','Parcel','Invoice'));
    }
      // search order
      public function searchOrder(Request $request)
      { 
        $search = $request->search ?? "";
        if($search != ""){
            $devices = Invoices::where('product','LIKE','%'.$search.'%')->where('totalPrice','!=','Devis')->get();
            
        }else{
            $devices = Invoices::where('totalPrice','!=','Devis')->get();
        }
        $Parcel = Parcel::first();
        return view("order.SearchuserOrder",compact('devices','Parcel','search'));
  
      }


    





    // order approved
    public function orderApproved(Request $request ,$id){
        $user = $request->userId;
        $serviceId =$request->serviceId;
        DB::table('parcels')->where('userId' , $user)->update(array('order_approved_noti' => 'Nouveau'));
        DB::table('parcels')->where('userId' , $user)->update(array('device_noti' => 'Nouveau'));
        DB::table('services')->where('id' , $serviceId)->decrement('stock'); 
        $Parcel = Parcel::first();
        Parcel::find($id)->update([
            'status' => 'Approuvé',
            'admin_status' => 'Appareil accepté',
        ]);
        Invoices::where('productId',$id)->update([
            'status' => 'Approuvé',
            'date' => date('Y-m-d'),
        ]);
        $notification = array(
            'message' => 'Commande approuvée avec succès!',
            'alert_type' => 'success'
        );
        return Redirect("/userOrder")->with( $notification);
    }
        // approved order detail
        public function ApprovedOrderDetail($id){
            $Parcel = Parcel::first();
            $device = Parcel::find($id);
             $Invoice = Invoices::where('totalPrice','Devis')->first();
            return view("order.approvedOrderDetail",compact('device','Parcel','Invoice'));
        }


        public function prnpriview($id)
        {
            $Parcel = Parcel::first();
            $device = Parcel::find($id);
             $Invoice = Invoices::where('totalPrice','Devis')->first();
            return view("order.print",compact('device','Parcel','Invoice'));
        }


           // approved order notes
           public function ApprovedOrderNotes($id){
            $device = Parcel::find($id);
            $Parcel = Parcel::first();
            return view("order.approvedOrderNotes",compact('device','Parcel'));
        }
            // order notes
            public function orderNotes(Request $request,$id){
                Parcel::find($id)->update([
                    'publicNote' => $request->publicNote,
                    'privateNote' => $request->privateNote,
                ]);
                $notification = array(
                    'message' => 'Remarque ajoutée!',
                    'alert_type' => 'success'
                );
                return Redirect("/userOrder")->with( $notification);
            }
    // user page to show approve order
    public function ApprovedOrder(){
        $id = Auth::user()->id;
        DB::table('parcels')->where('userId', '=', $id)->update(array('order_approved_noti' => Null));
     
        $Parcel = Parcel::where('userId' , $id)->first();
        $Invoice = Invoices::where('user_id' , $id)->first();
        
        $devices = Parcel::where('userId',$id)->orderBy('id', 'DESC')->where('status','APPROUVÉ')->orderBy('id', 'DESC')->get();
        return view("order.approvedOrder",compact('devices','Invoice','Parcel'));
    }


    // search bill
    public function searchokapproved(Request $request)
    { 
      $search = $request->search ?? "";
      $id = Auth::user()->id;
      if($search != ""){
        $devices = Parcel::where('product','LIKE','%'.$search.'%')->where('userId',$id)->where('status','APPROUVÉ')->get();
          
      }else{
        $devices = Parcel::where('userId',$id)->orderBy('id', 'DESC')->where('status','APPROUVÉ')->orderBy('id', 'DESC')->get();
     }
      $Parcel = Parcel::first();
      return view("order.approvedOrderSearch",compact('search','devices','Parcel'));

    }


    // refuse order
    public function RefuseOrder(Request $request){
        
        Parcel::where('userId',$request->userId2)->update([
            'order_approved_noti' => 'Refus',
        ]);

        $save = Parcel::find($request->userId);
        $save->status = 'Refus';
        $save->update();
        Invoices::where('productId',$request->userId)->update([
            'status' => 'Refus',
        ]);
        return response(['success','refuse']);
    }

    // recievedOrder order
    public function recievedOrder(Request $request){

        Parcel::where('userId',$request->userId2)->update([
            'device_noti' => 'Nouveau',
        ]);

        $save = Parcel::find($request->userId);
        $save->admin_status = 'Reçu';
        $save->update();
        return response(['success','Reçu']);
    }


    // progress order
    public function progressOrder(Request $request){

        Parcel::where('userId',$request->userId2)->update([
            'device_noti' => 'Nouveau',
        ]);

        $save = Parcel::find($request->userId);
        $save->admin_status = 'en cours';
        $save->update();
        return response(['success','en cours']);
    }


     // waiting order
     public function waitingOrder(Request $request){

        Parcel::where('userId',$request->userId2)->update([
            'device_noti' => 'Nouveau',
        ]);


        $save = Parcel::find($request->userId);
        $save->admin_status = 'SALLE DATTENTE';
        $save->update();
        return response(['success','DATTENTE']);
    }


     // repair order
     public function repairOrder(Request $request){

        Parcel::where('userId',$request->userId2)->update([
            'device_noti' => 'Nouveau',
        ]);


        $save = Parcel::find($request->userId);
        $save->admin_status = 'Réparé';
        $save->update();
        return response(['success','Réparé']);
    }


     // return order
     public function returnOrder(Request $request){

        Parcel::where('userId',$request->userId2)->update([
            'device_noti' => 'Nouveau',
        ]);


        $save = Parcel::find($request->userId);
        $save->admin_status = 'Retour au client';
        $save->update();
        return response(['success','Retour au client']);
    }



         // pay order
         public function payOrder(Request $request){
    
    
            Invoices::where('productId',$request->userId)->update([
                'adminPaid' => 'Payé',
            ]);
            return response(['success','Retour au client']);
        }






    // quotation order
    public function userQuotes(){
        DB::table('invoices')->update(array('quote_noti' => Null));

        $Parcel = Parcel::first();
        $devices = Invoices::orderBy('id', 'DESC')->where('totalPrice','=','Devis')->get();
        return view("order.quotesOrder",compact('devices','Parcel'));
    }


       // search Quote
       public function searchQuote(Request $request)
       { 
         $search = $request->search ?? "";
         if($search != ""){
             $devices = Invoices::where('product','LIKE','%'.$search.'%')->where('totalPrice','=','Devis')->get();
             
         }else{
             $devices = Invoices::where('totalPrice','=','Devis')->get();
         }
         $Parcel = Parcel::first();
         return view("order.SearchuserQuote",compact('devices','Parcel','search'));
   
       }




    // quotes approved
    public function quotesApproved(Request $request,$id){
        $userId = $request->userId;
        DB::table('invoices')->where('user_id', '=', $userId)->update(array('user_quote_noti' => 'Neuf'));
        $validateData = $request->validate([
            'quotePrice' => 'required|max:255',
        ],
        [
            'quotePrice.required' => 'Ce champ est requis',
         
        ]);
        $input = [  
            'quotePrice' => $request->quotePrice,
            'status' => 'Approved',
        ];
            Invoices::where('productId', '=', $id)->update($input);

        $notification = array(
            'message' => 'Devis approuvés avec succès!',
            'alert_type' => 'success'
        );
        return Redirect('/userQuotes')->with( $notification);
    }

     // refuse quote
     public function RefuseQuote(Request $request){
        $save = Parcel::find($request->userId);
        $save->status = 'Refus';
        $save->update();
        Invoices::where('productId',$request->userId)->update([
            'status' => 'Refus',
        ]);
        return response(['success','refuse']);
    }


  
    


    // support wallet
    public function SupportWallet(){

        $id = Auth::user()->id;
        $Parcel = Parcel::where('userId' , $id)->first();
        $Invoice = Invoices::where('user_id' , $id)->first();
        $totalPayment =
        $payment = user_total_credit::where('user_id',$id)->first();
        return view("wallet.index",compact('Invoice','payment','Parcel'));
    }


        // support walletCredit
        public function SupportWalletCredit(){

            $id = Auth::user()->id;
            $Parcel = Parcel::where('userId' , $id)->first();
            $payment = Payment::where('user_id' , $id)->orderBy('id', 'DESC')->get();
            return view("wallet.credit",compact('payment','payment','Parcel'));
        }




     // quotesDetail
     public function quotesDetail($id){
        $Parcel = Parcel::first();
        $device = Parcel::find($id);
        return view("order.quotesDetail",compact('device','Parcel'));
    }

}
