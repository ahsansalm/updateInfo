<?php

namespace App\Http\Controllers;
use App\Models\Parcel;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models\Invoices;
use App\Models\Message;
use App\Models\Notification;

use App\Models\AdminPayCreditsNoti;
class DeviceController extends Controller
{
    // my devices page
    public function myDevices(){
      $id = Auth::user()->id;

      
      DB::table('parcels')->where('userId' , $id)->update(array('device_noti' => null));

        $Parcel = Parcel::where('userId' , $id)->first();
        $Invoice = Invoices::where('user_id' , $id)->first();
        $devices = Parcel::where('userId',$id)->orderBy('id','desc')->get();

        
        $notiF2 = Notification::where('userId',$id)->first();
        $notification2 = Notification::where('productId','=',NULL)->where('userId',$id)->orderBy('id','desc')->get();
              

        $message2 = Message::where('or_status','=','User')->where('userId',$id)->orderBy('id','desc')->get();
        $msg2 = Message::where('userId',$id)->first();


        $paymentU2 = AdminPayCreditsNoti::where('userId',$id)->orderBy('id','desc')->get();
        $payU2 = AdminPayCreditsNoti::where('userId',$id)->first();

        return view("myDevice.index",compact('paymentU2','payU2','message2','msg2','notiF2','notification2','Invoice','devices','Parcel'));    
    }
    // edit device page
    public function EditDevice($id){
        $userid = Auth::user()->id;
        $Parcel = Parcel::where('userId' , $userid)->first();
        $Invoice = Invoices::where('user_id' , $userid)->first();

        $devices = Parcel::find($id);

        $notiF2 = Notification::where('userId',$userid)->first();
        $notification2 = Notification::where('productId','=',NULL)->where('userId',$userid)->orderBy('id','desc')->get();
          

        $message2 = Message::where('or_status','=','User')->where('userId',$userid)->orderBy('id','desc')->get();
        $msg2 = Message::where('userId',$userid)->first();



        $paymentU2 = AdminPayCreditsNoti::where('userId',$userid)->orderBy('id','desc')->get();
        $payU2 = AdminPayCreditsNoti::where('userId',$userid)->first();


        return view("myDevice.detail",compact('paymentU2','payU2','message2','msg2','notiF2','notification2','Invoice','devices','Parcel'));    
    }

      // edit device page
      public function NoteParcel($id){
        $userid = Auth::user()->id;
        $Parcel = Parcel::where('userId' , $userid)->first();
        $Invoice = Invoices::where('user_id' , $userid)->first();
        $devices = Parcel::find($id);
         
        $notiF2 = Notification::where('userId',$userid)->first();
        $notification2 = Notification::where('productId','=',NULL)->where('userId',$userid)->orderBy('id','desc')->get();
            

        $message2 = Message::where('or_status','=','User')->where('userId',$userid)->orderBy('id','desc')->get();
        $msg2 = Message::where('userId',$userid)->first();

        
        $paymentU2 = AdminPayCreditsNoti::where('userId',$userid)->orderBy('id','desc')->get();
        $payU2 = AdminPayCreditsNoti::where('userId',$userid)->first();


        return view("myDevice.Notes",compact('paymentU2','payU2','message2','msg2', 'notiF2','notification2','devices','Invoice','Parcel'));    
    }

    // delete parcel device
    public function DeleteDevice($id){
        Parcel::find($id)->delete();
        Invoices::where('productId', $id)->delete();
        $notification = array(
            'message' => 'Appareil supprimé avec succès!',
            'alert_type' => 'error'
        );
            return Redirect()->back()->with( $notification);
    }



    // search device
    public function searchdevice(Request $request)
    { 
      $search = $request->search ?? "";
      $id = Auth::user()->id;
      if($search != ""){
        $devices = Parcel::where('product','LIKE','%'.$search.'%')->where('userId',$id)->get();
          
      }else{
        $devices = Parcel::where('userId',$id)->get();        
    }
      $Parcel = Parcel::where('userId' , $id)->first();
      $notiF2 = Notification::where('userId',$id)->first();
      $notification2 = Notification::where('productId','=',NULL)->orderBy('id','desc')->get();



      $message2 = Message::where('or_status','=','User')->where('userId',$id)->orderBy('id','desc')->get();
      $msg2 = Message::where('userId',$id)->first();

      $paymentU2 = AdminPayCreditsNoti::where('userId',$id)->orderBy('id','desc')->get();
      $payU2 = AdminPayCreditsNoti::where('userId',$id)->first();

      
      return view("myDevice.search",compact('paymentU2','payU2','message2','msg2','notiF2','notification2','devices','Parcel','search'));  

    }



}
