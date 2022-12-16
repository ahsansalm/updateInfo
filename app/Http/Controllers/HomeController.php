<?php

namespace App\Http\Controllers;
use App\Models\Invoices;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Support;
use App\Models\Parcel;
use DB;
use App\Models\user_total_credit;
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
      
            $users = User::where('role_as','0')->get(); 
            $countProblems = DB::table('problem_replies')->count();
            $totalUsers =  DB::table('users')->where('role_as','0')->count();
            $id = Auth::user()->id;
            $Invoice = Invoices::first();
            $Parcel = Parcel::first();
            $invoices = Invoices::where('user_id',$id)->orderBy('id', 'DESC')->take(5)->get();
            $supports = Parcel::where('userId',$id)->orderBy('id','desc')->take(5)->get();
            $devices = Parcel::where('userId',$id)->orderBy('id', 'DESC')->where('status','pending')->take(5)->orderBy('id', 'DESC')->get();
    
            $orders = Invoices::where('totalPrice','!=','Devis')->orderBy('id', 'DESC')->take(5)->get();
            $quotation = Invoices::orderBy('id', 'DESC')->where('totalPrice','=','Devis')->take(5)->get();
            $quotes = Invoices::where('user_id',$id)->where('totalPrice', 'Devis')->orderBy('id', 'DESC')->where('status','Approved')->get();
    
            return view('admin.user',compact('quotation','orders','Invoice','users','totalUsers','countProblems','invoices','supports','devices','quotes','Parcel'));    
          

    
    
    
    
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

       $amount = user_total_credit::where('user_id',$id)->first();


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
