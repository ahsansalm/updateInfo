<?php

namespace App\Http\Controllers;
use App\Models\Invoices;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Support;
use App\Models\config\brand;
use App\Models\config\product;
use App\Models\service;
use App\Models\Parcel;
use DB;
use App\Models\ToDoList;
use App\Models\vendor;
use Yajra\Datatables\Datatables;
use App\Models\ProblemReply;
use Barryvdh\DomPDF\Facade\Pdf;
class PDFController extends Controller
{
    // here is user table pdf
    public function userPDF(Request $request){
        $search = $request->search ?? "";
        $users = User::where('name','LIKE','%'.$search.'%')->where('role_as','0')->get();
        $pdf = Pdf::loadView('pdf.user',[
            'users' => $users
        ]);
        return $pdf->download('user.pdf'); 

    }


    
    // here is inventoryPDF pdf
    public function inventoryPDF(){
        $services = service::all(); 
        $pdf = Pdf::loadView('pdf.inventory',[
            'services' => $services
        ]);
        return $pdf->download('inventory.pdf'); 

    }


    
    // here is userOrderPDFe pdf
    public function userOrderPDF(Request $request)
    {
        $search = $request->search ?? "";
        $devices = Invoices::where('product','LIKE','%'.$search.'%')->where('totalPrice','!=','Devis')->get();

        $pdf = Pdf::loadView('pdf.userOrder',[
            'devices' => $devices
        ]);
        return $pdf->download('userOrder.pdf'); 

    }

    

    // here is userQuotePDF pdf
    public function userQuotePDF(Request $request){
        $search = $request->search ?? "";
        $devices = Invoices::where('product','LIKE','%'.$search.'%')->where('totalPrice','=','Devis')->get();

        $pdf = Pdf::loadView('pdf.userQuote',[
            'devices' => $devices
        ]);
        return $pdf->download('userQuote.pdf'); 

    }


    
     // here is todolistPDF pdf
     public function todolistPDF(){
        $id = Auth::user()->id;
        $devices = ToDoList::where('admin_id',$id)->where('status','Incomplet')->get();
        $pdf = Pdf::loadView('pdf.toDoList',[
            'devices' => $devices
        ]);
        return $pdf->download('toDoList.pdf'); 

    }


     // here is favPDF pdf
     public function favPDF(){
        $id = Auth::user()->id;
        $devices = ToDoList::where('admin_id',$id)->where('status','Favoriser')->get();
        $pdf = Pdf::loadView('pdf.favList',[
            'devices' => $devices
        ]);
        return $pdf->download('favList.pdf'); 

    }



    // here is taskComPDF pdf
    public function taskComPDF(){
        $id = Auth::user()->id;
        $devices = ToDoList::where('admin_id',$id)->where('status','Complet')->get();
        $pdf = Pdf::loadView('pdf.taskCom',[
            'devices' => $devices
        ]);
        return $pdf->download('taskCom.pdf'); 

    }

    

    // here is vendorListPDF pdf
    public function vendorListPDF(){
        $id = Auth::user()->id;
        $devices = vendor::where('admin_id',$id)->get();
        $pdf = Pdf::loadView('pdf.vendorList',[
            'devices' => $devices
        ]);
        return $pdf->download('vendorList.pdf'); 

    }
    
    

     // here is favVendorPDF pdf
     public function favVendorPDF(){
        $id = Auth::user()->id;
        $devices = vendor::where('admin_id',$id)->where('status','Favoriser')->get();
        $pdf = Pdf::loadView('pdf.favVendor',[
            'devices' => $devices
        ]);
        return $pdf->download('favVendor.pdf'); 

    }

    

    // here is brandPDF pdf
    public function brandPDF(){
        $id = Auth::user()->id;
        $devices = brand::all();
        $pdf = Pdf::loadView('pdf.brand',[
            'devices' => $devices
        ]);
        return $pdf->download('brand.pdf'); 

    }




     // here is productPDF pdf
     public function productPDF(){
        $id = Auth::user()->id;
        $devices = product::all();
        $pdf = Pdf::loadView('pdf.product',[
            'devices' => $devices
        ]);
        return $pdf->download('product.pdf'); 

    }
    



       // here is todayOrderPDF pdf
       public function todayOrderPDF(){
        $id = Auth::user()->id;
        $devices = Invoices::where('totalPrice','!=','Devis')->where('status','=','Approuvé')->whereDate('date', now())->get();
        $pdf = Pdf::loadView('pdf.todayOrder',[
            'devices' => $devices
        ]);
        return $pdf->download('todayOrder.pdf'); 

    }


    


    
       // here is monthOrderPDF pdf
       public function monthOrderPDF(){
        $id = Auth::user()->id;
        $devices = Invoices::where('totalPrice','!=','Devis')->where('status','=','Approuvé')
        ->whereMonth('date', date('m'))->whereYear('date', date('Y'))->get();
        $pdf = Pdf::loadView('pdf.monthOrder',[
            'devices' => $devices
        ]);
        return $pdf->download('monthOrder.pdf'); 

    }





      // here is userOrderSearchPDF pdf
      public function userOrderSearchPDF(Request $request){
        $id = Auth::user()->id;
        $devices = Parcel::whereBetween('date',[$request->search , $request->search1])->where('status','=','Approuvé')->get(); 
        $pdf = Pdf::loadView('pdf.userOrderSearch',[
            'devices' => $devices
        ]);
        return $pdf->download('userOrderSearch.pdf'); 

    }




}
