<?php

namespace App\Http\Controllers;
use App\Models\Parcel;
use Auth;
use DB;
use App\Models\Notification;
use App\Models\Payment;
use App\Models\Message;
use App\Models\user_total_credit;
use App\Models\AdminPayCreditsNoti;
use Illuminate\Http\Request;
use App\Models\UserPayCreditsNoti;
use App\Models\Invoices;
use Image;
use App\Models\UsedCredit;
use Illuminate\Support\Carbon;
class OrderController extends Controller
{
     //page
     public function myOrder(){
        $id = Auth::user()->id;

        DB::table('parcels')->where('userId', '=', $id)->update(array('order_approved_noti' => Null));


        $Parcel = Parcel::where('userId' , $id)->first();
        
        $Invoice = Invoices::where('user_id' , $id)->first();
        $devices = Parcel::where('userId',$id)->orderBy('id', 'DESC')->where('status','en attendant')->orWhere('status','Refus')->orderBy('id', 'DESC')->get();
        $notiF2 = Notification::where('userId' , $id)->first();
        $notification2 = Notification::where('productId','=',NULL)->where('userId',$id)->orderBy('id','desc')->get();
        
        $message2 = Message::where('or_status','=','User')->where('userId',$id)->orderBy('id','desc')->get();
        $msg2 = Message::where('userId' , $id)->first();

        $paymentU2 = AdminPayCreditsNoti::where('userId',$id)->orderBy('id','desc')->get();
        $payU2 = AdminPayCreditsNoti::where('userId' , $id)->first();
 

        return view("order.index",compact('paymentU2','payU2','message2','msg2','notiF2','notification2','Invoice','devices','Parcel'));
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
        $notiF2 = Notification::where('userId' , $id)->first();
        $notification2 = Notification::where('productId','=',NULL)->where('userId',$id)->orderBy('id','desc')->get();
        
        $message2 = Message::where('or_status','=','User')->where('userId',$id)->orderBy('id','desc')->get();
        $msg2 = Message::where('userId' , $id)->first();

        $paymentU2 = AdminPayCreditsNoti::where('userId',$id)->orderBy('id','desc')->get();
        $payU2 = AdminPayCreditsNoti::where('userId' , $id)->first();
 

         return view("order.indexsearch",compact('paymentU2','payU2','message2','msg2','notiF2','notification2','search','devices','Parcel'));
   
       }





    // all user order page
    public function userorder(){
        DB::table('parcels')->where('order_noti', '=', 'Nouveau')->update(array('order_noti' => 1));
        $Invoice = Invoices::where('totalPrice','Devis')->first();
        $devices = Invoices::where('totalPrice','!=','Devis')->orderBy('id', 'DESC')->get();
        $Parcel = Parcel::first();
        $notiF = Notification::first();
            $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();
        $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
        $msg = Message::first();


            $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
            $payU = UserPayCreditsNoti::first();

            return view("order.userOrder",compact('paymentU','payU','message','msg','notiF','notification','devices','Parcel','Invoice'));
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
        $notiF = Notification::first();
        $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();
      
        $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
        $msg = Message::first();

        
            $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
            $payU = UserPayCreditsNoti::first();

        return view("order.SearchuserOrder",compact('paymentU','payU','message','msg','notiF','notification','devices','Parcel','search'));
  
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


        DB::table('notifications')->where('userId' , $user)->update(array('or_status' => 'Neuf'));
        Notification::insert([
            'userId' => $user,
            'description' => 'Commande approuvée par ladministrateur',
            'or_status' => 'Neuf',
            'date' => date('Y-m-d'),
            'created_at' => Carbon::now(),
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
             $notiF = Notification::first();
             $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();
            

             $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
             $msg = Message::first();
             
        $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
        $payU = UserPayCreditsNoti::first();
            return view("order.approvedOrderDetail",compact('paymentU','payU','message','msg','notiF','notification','device','Parcel','Invoice'));
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
            $notiF = Notification::first();
            $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();
            $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
        $msg = Message::first();
        $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
        $payU = UserPayCreditsNoti::first();
            return view("order.approvedOrderNotes",compact('paymentU','payU','message','msg','notiF','notification','device','Parcel'));
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

        $notiF2 = Notification::where('userId' , $id)->first();
        $notification2 = Notification::where('productId','=',NULL)->where('userId',$id)->orderBy('id','desc')->get();
        $message2 = Message::where('or_status','=','User')->where('userId',$id)->orderBy('id','desc')->get();
        $msg2 = Message::where('userId' , $id)->first();


        
        $paymentU2 = AdminPayCreditsNoti::where('userId',$id)->orderBy('id','desc')->get();
        $payU2 = AdminPayCreditsNoti::where('userId' , $id)->first();
 
      return view("order.approvedOrder",compact('paymentU2','payU2','message2','msg2','notiF2','notification2','devices','Invoice','Parcel'));
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
      $Parcel = Parcel::where('userId' , $id)->first();
      $notiF2 = Notification::where('userId' , $id)->first();
      $notification2 = Notification::where('productId','=',NULL)->where('userId',$id)->orderBy('id','desc')->get();

      $message2 = Message::where('or_status','=','User')->where('userId',$id)->orderBy('id','desc')->get();
      $msg2 = Message::where('userId' , $id)->first();


      
      $paymentU2 = AdminPayCreditsNoti::where('userId',$id)->orderBy('id','desc')->get();
      $payU2 = AdminPayCreditsNoti::where('userId' , $id)->first();

        
      return view("order.approvedOrderSearch",compact('paymentU2','payU2','message2','msg2','notiF2','notification2','search','devices','Parcel'));

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

        DB::table('notifications')->where('userId' , $request->userId2)->update(array('or_status' => 'Neuf'));
        Notification::insert([
            'userId' => $request->userId2,
            'description' => 'Commande refusée par ladministrateur',
            'or_status' => 'Neuf',
            'date' => date('Y-m-d'),
            'created_at' => Carbon::now(),
        ]);

        return response(['success','refuse']);
    }

    // recievedOrder order
    public function recievedOrder(Request $request){

        Parcel::where('userId',$request->userId2)->update([
            'device_noti' => 'Nouveau',
        ]);

        // DB::table('notifications')->where('userId' , $request->userId2)->update(array('or_status' => 'Neuf'));
        // Notification::insert([
        //     'userId' => $request->userId2,
        //     'description' => 'Commande approuvée par ladministrateur',
        //     'or_status' => 'Neuf',
        //     'date' => date('Y-m-d'),
        //     'created_at' => Carbon::now(),
        // ]);

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
    
        $id = $request->userId;
        $data  =  Invoices::where('productId',$request->userId)->first();
        if($data->Paid === 'Nous. Payé' || $data->Paid === 'Un d. Payé'){
            $data = [
                'error' => true,
                'message'=> 'Vous avez déjà payé'
              ] ;

              return response()->json($data);
        }else{
            Invoices::where('productId',$request->userId)->update([
                'adminPaid' => 'Payé',
                'Paid' => 'Un d. Payé',
                'userCreditDate' => date('Y-m-d'),
            ]);
            $data = [
                'success' => true,
                'message'=> 'Vous avez payé cette commande'
              ] ;


              DB::table('admin_pay_credits_notis')->update(array('status' => 'Neuf'));
              AdminPayCreditsNoti::insert([
                'userId' => $request->userId2,
                'productId' => $request->userId,
                'description' =>'Administrateur a payé votre commande',
                'status' => 'Neuf',
                'created_at' => Carbon::now(),
            ]);

              
            return response()->json($data);
        }
        }






    // quotation order
    public function userQuotes(){
        DB::table('invoices')->update(array('quote_noti' => Null));

        $Parcel = Parcel::first();
        $devices = Invoices::orderBy('id', 'DESC')->where('totalPrice','=','Devis')->get();
        $notiF = Notification::first();
        $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();
       
        $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
        $msg = Message::first();

        $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
        $payU = UserPayCreditsNoti::first();
        return view("order.quotesOrder",compact('paymentU','payU','message','msg','notiF','notification','devices','Parcel'));
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
         $notiF = Notification::first();
         $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();
        
         $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
         $msg = Message::first();
  
         $Parcel = Parcel::first();
         return view("order.SearchuserQuote",compact('paymentU','payU','message','msg','notiF','notification','devices','Parcel','search'));
   
       }




    // quotes approved
    public function quotesApproved(Request $request,$id){
        $userId = $request->userId;
        DB::table('invoices')->where('user_id', '=', $userId)->update(array('user_quote_noti' => 'Neuf'));
        $validateData = $request->validate([
            'quotePrice' => 'required|max:255',
        ],
        [
            ']quotePrice.required' => 'Ce champ est requis',
         
        ]);
        $input = [  
            'quotePrice' => $request->quotePrice,
            'status' => 'Approuvé',
        ];
            Invoices::where('productId', '=', $id)->update($input);

        $notification = array(
            'message' => 'Devis approuvés avec succès!',
            'alert_type' => 'success'
        );
        DB::table('notifications')->where('userId' , $userId)->update(array('or_status' => 'Neuf'));

        Notification::insert([
            'userId' => $userId,
            'description' => 'Le devis a été approuvé',
            'or_status' => 'Neuf',
            'date' => date('Y-m-d'),
            'created_at' => Carbon::now(),
        ]);

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




    // upload pdf page
    public function uploadPDFpage($id){
        $Parcel = Parcel::first();
        $notiF = Notification::first();
        $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();
        $Invoice = Invoices::first();


        
        $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
        $payU = UserPayCreditsNoti::first();
        $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
        $msg = Message::first();


        $device = Parcel::find($id);
        return view("order.uploadPDF",compact('paymentU','payU','message','msg','notiF','notification','Invoice','device','Parcel'));
    }


    
     // upload pdf
     public function uploadpdf(Request $request,$id){
        $validateData = $request->validate([
            "pdf" => "required|mimes:pdf|max:10000"
        ],
        [
            'pdf.required' => 'Ce champ est requis',
            'pdf.mimes' => 'Sélectionnez uniquement le fichier PDF',
         
        ]);

        $userid = $request->userId;
        DB::table('invoices')->where('user_id', '=', $userid)->update(array('billStatus' => 'Neuf'));


        $save = Parcel::find($id);

        $pdf = $request->pdf;
        $filename=time().'.'.$pdf->getClientOriginalExtension();
        $request->pdf->move('pdf',$filename);

        $save->pdf = $filename;
        $save->save();
        $notification = array(
            'message' => 'Téléchargez le PDF avec succès!',
            'alert_type' => 'success'
        );
        return Redirect('/userOrder')->with( $notification);
    }


  
    


    // support wallet
    public function SupportWallet(){

        $id = Auth::user()->id;
        $Parcel = Parcel::where('userId' , $id)->first();
        $Invoice = Invoices::where('user_id' , $id)->first();
        $totalPayment =
        $payment = user_total_credit::where('user_id',$id)->first();
        $notiF2 = Notification::where('userId' , $id)->first();
        $notification2 = Notification::where('productId','=',NULL)->where('userId',$id)->orderBy('id','desc')->get();
        
        
        $message2 = Message::where('or_status','=','User')->where('userId',$id)->orderBy('id','desc')->get();
        $msg2 = Message::where('userId' , $id)->first();
  
        $paymentU2 = AdminPayCreditsNoti::where('userId',$id)->orderBy('id','desc')->get();
        $payU2 = AdminPayCreditsNoti::where('userId' , $id)->first();
  
       

        return view("wallet.index",compact('paymentU2','payU2','message2','msg2','notiF2','notification2','Invoice','payment','Parcel'));
    }


        // support walletCredit
        public function SupportWalletCredit(){
          

            $id = Auth::user()->id;
            $notiF2 = Notification::where('userId' , $id)->first();
            $notification2 = Notification::where('productId','=',NULL)->where('userId',$id)->orderBy('id','desc')->get();
              
            $paymentU2 = AdminPayCreditsNoti::where('userId',$id)->orderBy('id','desc')->get();
            $payU2 = AdminPayCreditsNoti::where('userId' , $id)->first();
    
              
            $message2 = Message::where('or_status','=','User')->where('userId',$id)->orderBy('id','desc')->get();
            $msg2 = Message::where('userId' , $id)->first();

            $Parcel = Parcel::where('userId' , $id)->first();
            $payment = Payment::where('user_id' , $id)->orderBy('id', 'DESC')->get();


            $remain_data = UsedCredit::where('userId' , $id)->orderBy('id','desc')->get();
            
            $payment_total = user_total_credit::where('user_id',$id)->first();
            $total = $payment_total->totalCredits;
            $remain = $payment_total->credits;

            $used = $total-$remain;

            return view("wallet.credit",compact('remain_data','used','remain','paymentU2','payU2','message2','msg2','notiF2','notification2','total','payment','Parcel'));
        }




     // quotesDetail
     public function quotesDetail($id){
        $Parcel = Parcel::first();
        $device = Parcel::find($id);
        
        $notiF = Notification::first();
        $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();
       
  

        $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
        $msg = Message::first();
 
        $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
        $payU = UserPayCreditsNoti::first();
        
        return view("order.quotesDetail",compact('paymentU','payU','message','msg','notiF','notification','device','Parcel'));
    }

    // noti ok
    public function NotiOK(){
        DB::table('notifications')->update(array('status' => NULL));
        return response(['success']);
    }

      // noti2 ok
      public function Noti2OK(){
        $id = Auth::user()->id;
        DB::table('notifications')->where('userId',$id)->update(array('or_status' => NULL));
        return response(['success']);
    }


        // msg ok
        public function msgOK(){
            DB::table('messages')->update(array('userStatus' => NULL));
            return response(['success']);
        }



              // msg2 ok
      public function msg2OK(){
        $id = Auth::user()->id;
        DB::table('messages')->where('userId',$id)->update(array('adminId' => NULL));
        return response(['success']);
    }


    
        // payU ok
        public function payUOK(){
            DB::table('user_pay_credits_notis')->update(array('status' => NULL));
            return response(['success']);
        }



        

              // payU ok
      public function payU2OK(){
        $id = Auth::user()->id;
        DB::table('admin_pay_credits_notis')->where('userId',$id)->update(array('status' => NULL));
        return response(['success']);
    }

}
