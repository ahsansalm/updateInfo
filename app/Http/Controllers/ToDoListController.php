<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDoList;
use App\Models\vendor;
use App\Models\Parcel;
use App\Models\Invoices;
use App\Models\Message;
use Illuminate\Support\Carbon;
use App\Models\UserPayCreditsNoti;
use Auth;
use App\Models\Notification;
use Yajra\Datatables\Datatables;
class ToDoListController extends Controller
{
    // main page
    public function index(){
        $Parcel = Parcel::first();
        $Invoice = Invoices::where('totalPrice','Devis')->first();
        $notiF = Notification::first();
        $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();

        $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
        $msg = Message::first();
    $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
        $payU = UserPayCreditsNoti::first();
        
        return view("toDoList.index",compact('paymentU','payU','message','msg','notiF','notification','Invoice','Parcel'));
    }
    // 
       // yajra  for list
       public function gettask()
       {
        $id = Auth::user()->id;
           return Datatables::of(ToDoList::query()->where('admin_id',$id)->where('status','Incomplet')->orderBy('id','desc'))
           
           ->editColumn('created_at',function(ToDoList $ToDoList){
               return $ToDoList->created_at->diffForHumans();
           })
           ->make(true);
       }
       
    //add task
    public function addTask(Request $request){
        $id = Auth::user()->id;
        ToDoList::insert([
            'admin_id' => $id,
            'title' => $request->title,
            'descrip' => $request->descrip,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Nouvelle tâche ajoutée !',
            'alert_type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    // task edit page
    public function TaskEditPage($id){
        $task = ToDoList::find($id);
        $Parcel = Parcel::first();
        
        $Invoice = Invoices::where('totalPrice','Devis')->first();
        $notiF = Notification::first();
        $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();

        $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
        $msg = Message::first();
    $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
        $payU = UserPayCreditsNoti::first();
      
  
        return view("toDoList.edit",compact('paymentU','payU','message','msg','notiF','notification','Invoice','task','Parcel'));
    }

    // task edit
    public function editTask($id){
        ToDoList::find($id)->update([
            'status' => 'Complet',
        ]);
        $notification = array(
            'message' => 'Vous terminez cette tâche!',
            'alert_type' => 'success'
        );
        return Redirect()->back()->with( $notification);
    }
    public function updateTask(Request $request, $id){
        ToDoList::find($id)->update([
            'title' => $request->title,
            'descrip' => $request->descrip,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Mise à jour de la tâche!',
            'alert_type' => 'warning'
        );
        return Redirect('/todolist')->with($notification);
        }
    
          // product fetch data for fee
          public function fetchProduct(Request $request){
            $data = product::where('id',$request->product)->first();
            return response($data);
    }
    
    

    // incomTask
    public function incomTask($id){
        ToDoList::find($id)->update([
            'status' => 'Incomplet',
        ]);
        $notification = array(
            'message' => 'Votre tâche est incomplète!',
            'alert_type' => 'error'
        );
        return Redirect()->back()->with( $notification);
    }
    

    // fav task
    public function favTask($id){
        ToDoList::find($id)->update([
            'status' => 'Favoriser',
        ]);
        $notification = array(
            'message' => 'Tâche ajouter aux favoris',
            'alert_type' => 'info'
        );
        return Redirect()->back()->with( $notification);
    }


    // comlist page
    public function comlist(){
        $Parcel = Parcel::first();
        
        $Invoice = Invoices::where('totalPrice','Devis')->first();
    
    $notiF = Notification::first();
    $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();

    $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
        $msg = Message::first();
    $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
        $payU = UserPayCreditsNoti::first();
        return view("toDoList.complete",compact('paymentU','payU','message','msg','notiF','notification','Invoice','Parcel'));
    }
     // yajra  for list
     public function getcom()
     {
      $id = Auth::user()->id;
         return Datatables::of(ToDoList::query()->where('admin_id',$id)->where('status','Complet')->orderBy('id','desc'))
         
         ->editColumn('created_at',function(ToDoList $ToDoList){
             return $ToDoList->updated_at->diffForHumans();
         })
         ->make(true);
     }

         // favlist page
    public function favlist(){
        $Parcel = Parcel::first();
        $notiF = Notification::first();
        $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();

        $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
        $msg = Message::first();
    $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
        $payU = UserPayCreditsNoti::first();
        
        $Invoice = Invoices::where('totalPrice','Devis')->first();
        return view("toDoList.favrouite",compact('paymentU','payU','message','msg','notiF','notification','Invoice','Parcel'));
    }
     // yajra  for list
     public function getfav()
     {
      $id = Auth::user()->id;
         return Datatables::of(ToDoList::query()->where('admin_id',$id)->where('status','Favoriser')->orderBy('id','desc'))
         
         ->editColumn('created_at',function(ToDoList $ToDoList){
             return $ToDoList->updated_at ->diffForHumans();
         })
         ->make(true);
     }


     /// vendorlist
     public function vendorlist(){
        
        $Invoice = Invoices::where('totalPrice','Devis')->first();
        $Parcel = Parcel::first();
        $notiF = Notification::first();
        $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();

        $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
        $msg = Message::first();
    $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
        $payU = UserPayCreditsNoti::first();
        
        return view("toDoList.vendorlist",compact('paymentU','payU','message','msg','notiF','notification','Invoice','Parcel'));
     }


        // yajra  for list
    public function getvendor()
    {
        $id = Auth::user()->id;
        return Datatables::of(vendor::query()->where('admin_id',$id)->orderBy('id','desc'))
        
        ->editColumn('created_at',function(vendor $vendor){
            return $vendor->created_at->diffForHumans();
        })
        ->make(true);
    }



    //add vendor
    public function addVendor(Request $request){
        $id = Auth::user()->id;
        vendor::insert([
            'admin_id' => $id,
            'name' => $request->name,
            'descrip' => $request->descrip,
            'link' => $request->link,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Vendeur ajouté !',
            'alert_type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
      // vendor edit page
      public function vendorEditPage($id){
        $vendor = vendor::find($id);
        $Parcel = Parcel::first();
        $notiF = Notification::first();
        $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();

        $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
        $msg = Message::first();
    $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
        $payU = UserPayCreditsNoti::first();
        $Invoice = Invoices::where('totalPrice','Devis')->first();
        return view("toDoList.editvendor",compact('paymentU','payU','message','msg','notiF','notification','Invoice','vendor','Parcel'));
    }

    public function updatevendor(Request $request, $id){
        vendor::find($id)->update([
            'name' => $request->name,
            'descrip' => $request->descrip,
            'link' => $request->link,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Fournisseur mis à jour!',
            'alert_type' => 'warning'
        );
        return Redirect()->back()->with($notification);
        }

           // delete vendor
      public function DeleteVendor($id){
        vendor::find($id)->delete();
        $notification = array(
            'message' => 'Fournisseur Supprimer!',
            'alert_type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }


    
    // fav vendor
    public function favvendor($id){
        vendor::find($id)->update([
            'status' => 'Favoriser',
        ]);
        $notification = array(
            'message' => 'TVendeur ajouter aux favoris',
            'alert_type' => 'info'
        );
        return Redirect()->back()->with( $notification);
    }

    

     // vendor edit page
     public function detailVendor($id){
        $vendor = vendor::find($id);
        
        $Invoice = Invoices::where('totalPrice','Devis')->first();
        $Parcel = Parcel::first();
        $notiF = Notification::first();
        $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();

        $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
        $msg = Message::first();
    $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
        $payU = UserPayCreditsNoti::first();
        return view("toDoList.detailvendor",compact('paymentU','payU','message','msg','notiF','notification','Invoice','vendor','Parcel'));
    }




    // vendorfavlist page
    public function vendorfavlist(){
        $Parcel = Parcel::first();
        $notiF = Notification::first();
        $notification = Notification::where('productId','!=',NULL)->orderBy('id','desc')->get();

        $message = Message::where('or_status','=','Admin')->orderBy('id','desc')->get();
        $msg = Message::first();
    $paymentU = UserPayCreditsNoti::orderBy('id','desc')->get();
        $payU = UserPayCreditsNoti::first();
        
        $Invoice = Invoices::where('totalPrice','Devis')->first();
    return view("toDoList.favrouiteVendor",compact('paymentU','payU','message','msg','notiF','notification','Invoice','Parcel'));
    }
    // yajra  for list
    public function getvendorfav()
    {
    $id = Auth::user()->id;
        return Datatables::of(vendor::query()->where('admin_id',$id)->where('status','Favoriser')->orderBy('id','desc'))
        
        ->editColumn('created_at',function(vendor $vendor){
            return $vendor->updated_at ->diffForHumans();
        })
        ->make(true);
    }

        
}
