<?php

namespace App\Http\Controllers;
use App\Models\Invoices;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Support;
use App\Models\Parcel;
use DB;
use Yajra\Datatables\Datatables;
use App\Models\ProblemReply;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['verified', 'auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
        if(Auth::user()->role_as == '1'){

            $userId = Auth::user()->id;
            $Parcel = Parcel::first();
            $Invoice = Invoices::where('totalPrice','Devis')->first();
    
            $allorder =  DB::table('invoices')->where('totalPrice' ,'!=', 'Devis')->count();
            $pendingorder = DB::table('invoices')->where('totalPrice' ,'!=', 'Devis')->where('status' ,'=', 'pending')->count();
            $approvedorder = DB::table('invoices')->where('totalPrice' ,'!=', 'Devis')->where('status' ,'=', 'Approuvé')->count();
            $sale = DB::table('invoices')->where('status','=','Approuvé')
                    ->join('services', 'invoices.service_id', '=', 'services.id')  
                    ->select('services.price')      
                    ->sum('price');
            $pur1 = DB::table('services')->sum('stock');
            $pur2 = DB::table('services')->sum('purchase_price');
            $purchase = $pur1 * $pur2;
    
    
    
            
            $todaySale = DB::table('invoices')->where('status','=','Approuvé')
                ->whereDate('date', now())
                ->join('services', 'invoices.service_id', '=', 'services.id')  
                ->select('services.price')      
                ->sum('price');
            return view("reporting.index",compact('Invoice','Parcel','allorder','pendingorder','approvedorder','sale','purchase','todaySale'));
    
            

         }
        else {
            $users = User::where('role_as','0')->get(); 
            $countProblems = DB::table('problem_replies')->count();
            $totalUsers =  DB::table('users')->where('role_as','0')->count();
            $id = Auth::user()->id;
            $Invoice = Invoices::where('user_id' , $id)->first();
            $Parcel = Parcel::where('userId' , $id)->first();
            $invoices = Invoices::where('user_id',$id)->orderBy('id', 'DESC')->take(5)->get();
            $supports = Parcel::where('userId',$id)->orderBy('id','desc')->take(5)->get();
            $devices = Parcel::where('userId',$id)->orderBy('id', 'DESC')->where('status','pending')->take(5)->orderBy('id', 'DESC')->get();
    
            $quotes = Invoices::where('user_id',$id)->where('totalPrice', 'Devis')->orderBy('id', 'DESC')->where('status','Approved')->get();
    
            return view('admin.user',compact('Invoice','users','totalUsers','countProblems','invoices','supports','devices','quotes','Parcel'));    
          
       }
    
    
    
    
    }

      // yajra  for user
      public function getusers()
      {
          return Datatables::of(User::query()->where('role_as','0')->orderBy('id', 'DESC'))
          ->editColumn('created_at',function(User $User){
              return $User->created_at->diffForHumans();
          })
          
          ->make(true);
      }


    // user detail
    public function userDetail($id){
        $user = User::find($id);
        $Parcel = Parcel::first();
       $Invoice = Invoices::where('totalPrice','Devis')->first();

       $amount =  DB::table('payments')->where('user_id',$id)->sum('amount');


        return view("admin.userDetail",compact('Invoice','Parcel','user','amount'));
    }

    // userDisabled
    public function userDisabled($id){
        $users = User::find($id);
        $users->status = "Handicapé";
        $users->update();
         $notification = array(
                'message' => 'Vous avez désactivé cet utilisateur!',
                'alert_type' => 'error'
            );
            return Redirect('/home')->with($notification);
    }



     // userDisabled
     public function useractive($id){
        $users = User::find($id);
        $users->status = "Actif";
        $users->update();
         $notification = array(
                'message' => 'Vous activez cet utilisateur!',
                'alert_type' => 'success'
            );
            return Redirect('/home')->with($notification);
    }
}
