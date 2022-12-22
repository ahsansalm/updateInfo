<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parcel;
use Auth;
use App\Models\Invoices;
use App\Models\Support;
use App\Models\ProblemReply;
use App\Models\Notification;
use App\Models\Message;
use Illuminate\Support\Carbon;
use DB;
class SupportController extends Controller
{
    //page 
    public function mySupport(){
        $id = Auth::user()->id;
        
        $input = [  
            'noti' => 'ok'
        ];
            Parcel::where('userId', '=', $id)->update($input);
            
        $supports = Parcel::where('userId',$id)->orderBy('id','desc')->get();
        
        $Parcel = Parcel::where('userId' , $id)->first();
        $Invoice = Invoices::where('user_id' , $id)->first();
            $notiF2 = Notification::first();
   $notification2 = Notification::where('productId','=',NULL)->where('userId',$id)->orderBy('id','desc')->get();
    
   $message2 = Message::where('or_status','=','User')->where('userId',$id)->orderBy('id','desc')->get();
   $msg2 = Message::first();
   
   
     
            return view("support.index",compact('message2','msg2','notiF2','notification2','Invoice','Parcel','supports'));    
        }
    // edit support page
    public function EditSupport($id){
        $parcel = Parcel::find($id);
        $parcel->chat ='Lis';
        $parcel->save();

        $userId = Auth::user()->id;
        $parcel = Parcel::find($id);
        $supports = Support::where('userId',$userId)->where('productId',$id)->get();
        $reply = ProblemReply::where('userId',$userId)->where('productId',$id)->get();
        $Invoice = Invoices::where('user_id' , $userId)->first();
        $Parcel = Parcel::where('userId' , $userId)->first();

        $notiF2 = Notification::first();
        $notification2 = Notification::where('productId','=',NULL)->where('userId',$userId)->orderBy('id','desc')->get();
        $message2 = Message::where('or_status','=','User')->where('userId',$userId)->orderBy('id','desc')->get();
        $msg2 = Message::first();
        
        
        return view("support.detail",compact('message2','msg2','notiF2','notification2','Invoice','parcel','supports','reply','Parcel'));    
    }
    // add problem
    public function AddSupport(Request $request){
        DB::table('parcels')->update(array('admin_noti' => 'Nouveau'));

        $save = Parcel::find($request->productId);
        $save->admin_chat = "Nouveau";
        $save->save();

        $parcel = Support::create([
            'userId' => $request->userId,
            'productId' => $request->productId,
            'problem' => $request->problem,
            'object' => $request->object,
            'icon' => $request->icon,
            'created_at' => Carbon::now(),
            ]);

            Message::insert([
                'userId' => $request->userId,
                'description' => 'Nouveau message reçu',
                'status' => 'Neuf',
                'or_status' => 'Admin',
                'productId' => $request->productId,
                'created_at' => Carbon::now(),
            ]);

            return response('success');
    }

     // add problem
     public function AddSupportNew(Request $request){

        $parcel = Support::create([
            'userId' => $request->userId,
            'productId' => $request->productId,
            'problem' => $request->problem,
            'object' => $request->object,
            'status' => 'Not',
            'icon' => $request->icon,
            'created_at' => Carbon::now(),
            ]);


            // DB::table('notifications')->where('userId' , $user)->update(array('or_status' => 'Neuf'));

         

            return response('success');
    }



       // search support
       public function searchsupport(Request $request)
       { 
         $search = $request->search ?? "";
         $id = Auth::user()->id;
         if($search != ""){
           $supports = Parcel::where('product','LIKE','%'.$search.'%')->where('userId',$id)->get();
             
         }else{
            $supports = Parcel::where('userId',$id)->get();      
       }
         $Parcel = Parcel::first();

         $notiF2 = Notification::first();
$notification2 = Notification::where('productId','=',NULL)->where('userId',$id)->orderBy('id','desc')->get();
   
 
$message2 = Message::where('or_status','=','User')->where('userId',$id)->orderBy('id','desc')->get();
$msg2 = Message::first();


   
         return view("support.search",compact('message2','msg2','notiF2','notification2','Parcel','supports','search'));  
   
       }


}
