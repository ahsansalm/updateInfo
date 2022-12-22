<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Support;
use App\Models\ProblemReply;
use App\Models\Parcel;
use App\Models\Invoices;
use Illuminate\Support\Carbon;
use DB;
use App\Models\Notification;
use App\Models\Message;
use Auth;
use Yajra\Datatables\Datatables;
class ProblemController extends Controller
{
    // problem page controller
    public function problem(){
        DB::table('parcels')->where('admin_noti', '=', 'Nouveau')->update(array('admin_noti' => 1));
        $supports = Parcel::all();
        $Parcel = Parcel::first();
        $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
        $msg = Message::first();

       $Invoice = Invoices::where('totalPrice','Devis')->first();
        return view("problem.index",compact('message','msg','Invoice','supports','Parcel'));
    }
        // yajra  for problem
        public function getproblem()
        {
            return Datatables::of(Parcel::query()->orderBy('id','desc'))
            ->editColumn('serviceRequest',function($parcel){
                return $parcel->servicedata->service;
            })
            ->editColumn('userId',function($parcel){
                return $parcel->user->firstname;
            })
            ->make(true);
        }




    // problem detail page
    public function problemDetail($id){
        $save = Parcel::find($id);
        $save->admin_chat = "Lis";
        $save->save();

        $supports = Parcel::find($id);
        $userId = $supports->userId;
        $chat = Support::where('userId',$userId)->where('productId',$id)->get();
        $reply = ProblemReply::where('userId',$userId)->where('productId',$id)->get();

        $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
        $msg = Message::first();


        $Parcel = Parcel::first();
       $Invoice = Invoices::where('totalPrice','Devis')->first();


       $notiF = Notification::first();
       $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();
      

        return view("problem.detail",compact('message','msg','notification','notiF','Invoice','supports','chat','reply','Parcel'));    
    }
    // reply to problem
    public function ReplyProb(Request $request){
        
        $save = Parcel::find($request->update_id);
        $save->chat = "Nouveau";
        $save->save();



        $input = [  
            'noti' => 'Nouveau'
        ];
            Parcel::where('userId', '=', $request->userId)->update($input);



        $id = Auth::user()->id;
        $problemReply = ProblemReply::create([
            'adminId' => $id,
            'userId' => $request->userId,
            'productId' => $request->productId,
            'problem' => $request->problem,
            'object' => $request->object,
            'icon' => $request->icon,
            'answer' => $request->answer,
            'created_at' => Carbon::now(),
            ]);



            Message::insert([
                'userId' => $request->userId,
                'description' => 'Nouveau message reçu',
                'status' => 'Neuf',
                'or_status' => 'User',
                'productId' => $request->productId,
                'created_at' => Carbon::now(),
            ]);

            return response('success');
    }
}
