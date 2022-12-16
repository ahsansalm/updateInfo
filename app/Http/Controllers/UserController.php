<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\config\brand;
use App\Models\config\product;
use App\Models\service;
use App\Models\User;
use App\Models\Parcel;
use App\Models\Invoices;
use Auth;
use Image;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Carbon;
use DB;
class UserController extends Controller
{
    // fetxh product from brnad
    public function fetchbrandproduct(Request $request){
   
        if($request->ajax())
        {
        $output_sub="";
        $data = product::where('product_Id',$request->id)->where('disable' , 'Actif')->get();
        $table_sub = $data->count();
        if($table_sub > 0)
            {
                foreach ($data as $key => $tech_data) {
                    $output_sub.=
                "<div class='col-md-3 col-sm-6  image_col '>".
                "<img class='img-fluid img-fluid2' src='$tech_data->image'>".
                "<button type= 'button' class='btn btn-outline-primary service_id btn-block  mt-3 service_click' onClick='addItem(value,innerHTML)' text='$tech_data->product_name' value='$tech_data->id'>".$tech_data->product_name."</button>".
               "</div>";
                }
                return Response($output_sub);  }
            }    
    }
    
       // fetxh fetchproducctservice from brnad
       public function fetchproducctservice(Request $request){
   
        if($request->ajax())
        {
        $newOutput="";
        $data = service::where('product_id',$request->value)->where('disable' , 'Actif')->get();
        $table_sub = $data->count();
        if($table_sub > 0)
            {
                foreach ($data as $key => $tech_data) {
                    $newOutput.=
                "<div class='col-md-3 col-sm-6  image_col mt-2 ps4_fat px-md-2 px-3'>".
                    "<div class='card'>". 
                            " <img class='card-img-top img-fluid img-fluid2'  src='$tech_data->image'>".
                        "<div class='card-body'>".
                            "<h6>".$tech_data->service."</h6>".
                            "<button type= 'button' class='btn btn-outline-primary newBenifitClick btn-block  mt-3 ' onClick='addBenifit(value,innerHTML)' text='$tech_data->id' value='$tech_data->id'>".$tech_data->sale."</button>".
                        "</div>".
                    "</div>".
               "</div>";
                                        
                }
                return Response($newOutput);  
            }
        }    
    }


    
    public function adminUser(){
        
            $Parcel = Parcel::first();
            $users = User::where('role_as','0')->orderBy('id', 'DESC')->get(); 
            $Invoice = Invoices::where('totalPrice','Devis')->first();
            return view("adminUser.index",compact('Parcel','Invoice','users'));
    }



       // search bill
       public function usersadmin(Request $request)
       { 
         $search = $request->search ?? "";
         $id = Auth::user()->id;
         if($search != ""){
            $users = User::where('name','LIKE','%'.$search.'%')->where('role_as','0')->orderBy('id', 'DESC')->get();

         }else{
            $users = User::where('role_as','0')->orderBy('id', 'DESC')->get();         
        }
        
        $Parcel = Parcel::where('userId' , $id)->first();
        
        $Invoice = Invoices::where('totalPrice','Devis')->first();
         return view("adminUser.search",compact('search','users','Parcel','Invoice'));
   
       }
}
