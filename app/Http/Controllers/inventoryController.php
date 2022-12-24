<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parcel;
use Auth;
use App\Models\Invoices;
use App\Models\Support;
use App\Models\Inventory;
use App\Models\config\Brand;
use App\Models\config\product;
use App\Models\config\service;
use App\Models\ProblemReply;
use App\Models\Message;
use App\Models\UserPayCreditsNoti;
use Illuminate\Support\Carbon;
use DB;
use App\Models\Notification;

class inventoryController extends Controller
{
    // page
    public function inventory(){
        $Parcel = Parcel::first();
        $Invoice = Invoices::where('totalPrice','Devis')->first();
        $service = DB::table('services')->first();


        $notiF = Notification::first();
      $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();

      $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
      $msg = Message::first();
      
      $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
      $payU = UserPayCreditsNoti::first();
        return view("inventory.index",compact('paymentU','payU','message','msg','notiF','notification','Invoice','Parcel','service'));
    }


    // page add
    public function inventoryAdd(){
        $Parcel = Parcel::first();
        $brand = DB::table('brands')->where('disable','Actif')->get();
        $Parcel = Parcel::first();
        $notiF = Notification::first();
       $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();

       
       $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
       $msg = Message::first();

       $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
       $payU = UserPayCreditsNoti::first();
        return view("inventory.add",compact('paymentU','payU','message','msg','notiF','notification','Parcel','brand'));
    }

     // fetch product 
        
     public function FetchProduct(Request $request){
        {
            if($request->ajax())
                {
                $output_sub="";
                $product = product::where('product_id',$request->product)->get();
                $table_sub = $product->count();
                if($table_sub > 0)
                    {
                        $output_sub.= "<option disabled selected>".
                        '--Sélectionner un produit--'.
                        "</option>"; 
                        foreach ($product as $key => $tech_data) {
                            $output_sub.="<option  value='$tech_data->id'>".
                            $tech_data->product_name.
                            "</option>";

                        }
                        return Response($output_sub);
                    }
                    else{
                        $output_sub.='<option>'.
                            'Vide '.
                        '</option>';
                        return Response($output_sub);
                    }
                    return Response($table_sub);
                        
                    }
        }
    }


     // fetch servidce 
        
     public function FetchService(Request $request){
        {
            if($request->ajax())
                {
                $output_sub="";
                $product = service::where('product_id',$request->product)->get();
                $table_sub = $product->count();
                if($table_sub > 0)
                    {
                        $output_sub.= "<option disabled selected>".
                        '--Sélectionnez la prestation--'.
                        "</option>"; 
                        foreach ($product as $key => $tech_data) {
                            $output_sub.="<option  value='$tech_data->id'>".
                            $tech_data->service.
                            "</option>";

                        }
                        return Response($output_sub);
                    }
                    else{
                        $output_sub.='<option>'.
                            'Vide '.
                        '</option>';
                        return Response($output_sub);
                    }
                    return Response($table_sub);
                        
                    }
        }
    }

       // service fetch data for fee
       public function FetchServicedata(Request $request){
        $data = service::where('id',$request->product)->first();
        return response($data);
    }


    // insertDataInv 
    public function insertDataInv(Request $request){
        $id = Auth::user()->id;
        $inventory = Inventory::create([
            'userId' => $id,
            'brand' => $request->brand,
            'product' => $request->product,
            'service' => $request->service,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->price,
            'quantity' => $request->quantity,
            'created_at' => Carbon::now(),
            ]);
            return response('success');
    }

        // edit service page
        public function inventoryedit($id){
            $Inventory = Inventory::find($id);
            dd($Inventory);
            $brand =Brand::all();
            $Parcel = Parcel::first();
            return view('inventory.edit',compact('Inventory','Parcel','brand'));
    
        }

}
