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

class reportingController extends Controller
{
    // reporting page
    public function reporting(){
        
        $userId = Auth::user()->id;
        $Parcel = Parcel::first();
       $Invoice = Invoices::where('totalPrice','Devis')->first();

        $allorder =  DB::table('invoices')->where('totalPrice' ,'!=', 'Devis')->count();
        $pendingorder = DB::table('invoices')->where('totalPrice' ,'!=', 'Devis')->where('status' ,'=', 'pending')->count();
        $approvedorder = DB::table('invoices')->where('totalPrice' ,'!=', 'Devis')->where('status' ,'=', 'Approuvé')->count();
        $sale = DB::table('invoices')->where('status','=','Approuvé')
                ->join('services', 'invoices.service_id', '=', 'services.id')  
                ->select('services.sale')      
                ->sum('sale');
        $pur1 = DB::table('services')->sum('stock');
        $pur2 = DB::table('services')->sum('purchase_price');
        $purchase = $pur1 * $pur2;



        
        $todaySale = DB::table('invoices')->where('status','=','Approuvé')
            ->whereDate('date', now())
            ->join('services', 'invoices.service_id', '=', 'services.id')  
            ->select('services.sale')      
            ->sum('sale');



            // credit based reportin start here
            $purchaseCredit = DB::table('invoices')->where('payStatus','=','Payé')
            ->join('services', 'invoices.service_id', '=', 'services.id')  
            ->select('services.purchase_price')      
            ->sum('purchase_price');


            $saleCredit = DB::table('invoices')->where('payStatus','=','Payé')
            ->join('services', 'invoices.service_id', '=', 'services.id')  
            ->select('services.sale')      
            ->sum('sale');

            $profitCredit = $saleCredit - $purchaseCredit;




            $adminpurchaseCredit = DB::table('invoices')->where('adminPaid','=','Payé')
            ->join('services', 'invoices.service_id', '=', 'services.id')  
            ->select('services.purchase_price')      
            ->sum('purchase_price');


            $adminsaleCredit = DB::table('invoices')->where('adminPaid','=','Payé')
            ->join('services', 'invoices.service_id', '=', 'services.id')  
            ->select('services.sale')      
            ->sum('sale');

            $adminprofitCredit = $adminsaleCredit - $adminpurchaseCredit;


        return view("reporting.index",compact('profitCredit','saleCredit','purchaseCredit','Invoice',
        'adminpurchaseCredit','adminsaleCredit','adminprofitCredit',
        'Parcel','allorder','pendingorder','approvedorder','sale','purchase','todaySale'));
    }   


    // todayreport pager
    public function todayreport(){
        $Parcel = Parcel::first();
       $Invoice = Invoices::where('totalPrice','Devis')->first();
        $sale = DB::table('invoices')->whereDate('date', now())->where('status','=','Approuvé')
        ->select('invoices.totalPrice')      
        ->sum('totalPrice');

        $purchase = DB::table('invoices')->whereDate('date', now())->where('status','=','Approuvé')
        ->join('services', 'invoices.service_id', '=', 'services.id')  
        ->select('services.purchase_price')      
        ->sum('purchase_price');

        $profit= $sale - $purchase;

        $devices = Invoices::where('service_id','!=','Devis')->where('status','=','Approuvé')->whereDate('date', now())->get();
        return view("reporting.today",compact('Invoice','Parcel','devices','sale','purchase','profit'));
    }



         // search searchToday
         public function searchToday(Request $request)
         { 
           $search = $request->search ?? "";
           if($search != ""){
            $sale = DB::table('invoices')->where('product','LIKE','%'.$search.'%')->whereDate('date', now())->where('status','=','Approuvé')
            ->select('invoices.totalPrice')      
            ->sum('totalPrice');


            $purchase = DB::table('invoices')->where('product','LIKE','%'.$search.'%')->whereDate('date', now())->where('status','=','Approuvé')
            ->join('services', 'invoices.service_id', '=', 'services.id')  
            ->select('services.purchase_price')      
            ->sum('purchase_price');

            $profit= $sale - $purchase;
               $devices = Invoices::where('product','LIKE','%'.$search.'%')->where('service_id','!=','Devis')->where('status','=','Approuvé')->whereDate('date', now())->get();
               
           }else{
            $sale = DB::table('invoices')->where('product','LIKE','%'.$search.'%')->whereDate('date', now())->where('status','=','Approuvé')
            ->select('invoices.totalPrice')      
            ->sum('totalPrice');

                $purchase = DB::table('invoices')->where('product','LIKE','%'.$search.'%')->whereDate('date', now())->where('status','=','Approuvé')
                ->join('services', 'invoices.service_id', '=', 'services.id')  
                ->select('services.purchase_price')      
                ->sum('purchase_price');

                $profit= $sale - $purchase;
            $devices = Invoices::where('service_id','!=','Devis')->where('status','=','Approuvé')->whereDate('date', now())->get();
           }
           $Parcel = Parcel::first();
           $Invoice = Invoices::where('totalPrice','Devis')->first();
           return view("reporting.todaySearch",compact('Invoice','Parcel','devices','sale','purchase','profit','search'));
     
         }


      // yajra  for todayreportdata
    //   public function todayreportdata()
    //   {
    //       return Datatables::of(Parcel::query()->whereDate('date', now()))
    //     ->editColumn('serviceRequest', function($order)
    //     {
    //        return $order->servicedata->service;
    //     })

        
    //       ->editColumn('created_at',function(Parcel $Parcel){
    //           return $Parcel->created_at->diffForHumans();
    //       })
          
    //       ->make(true);
    //   }





      // search order today
      public function searchOrdertoday(Request $request)
      {

        $Parcel = Parcel::first();
       $Invoice = Invoices::where('totalPrice','Devis')->first();

          if($request->ajax())
          {
          $output_sub="";
          $product = Parcel::where('marks','LIKE','%'.$request->search.'%')->where('status','=','Approuvé')->whereDate('date', now())->get();      
          $table_sub = $product->count();
          
          if($table_sub > 0)
              {

                $i=1;
                    foreach($product as $device){
                      $output_sub.=  "<tr class='text-dark'>".
                              "<td><b>".$i++."</b></td>".
                              "<td><b class='text-dark'>".$device->user->firstname.' '.$device->user->lastname." </b></td>".
                              "<td><b class='text-dark'>".$device->marks."</b></td>".
                              "<td>".$device->product."</td>".
                              "<td>".$device->servicedata->service."</td>".
                             " <td>".
                              "<span class='badge bagde-sm bg-success'>".$device->status."</span>".
                             "</td>".
                             "<td>".$device->servicedata->sale. '€'."</td>".
                             "<td>".$device->servicedata->purchase_price. '€'."</td>".
                             "<td>".$device->date."</td>".
                              "</tr>";
                      }
                      
                  return Response($output_sub);
              }
              else{
                $output_sub.=  "<tr class='text-dark text-center'>".
                "<td colspan='9'><b class='text-dark'>".'Aucun Enregistrement Trouvé.'." </b></td>".
                "</tr>";
                return Response($output_sub);
              }
              return Response($table_sub);
                  
        }
  }



  

     // monthlyreport pager
     public function monthlyreport(){
        $Parcel = Parcel::first();
       $Invoice = Invoices::where('totalPrice','Devis')->first();

       $sale = DB::table('invoices')->whereMonth('date', date('m'))->whereYear('date', date('Y'))->where('status','=','Approuvé')
       ->select('invoices.totalPrice')      
       ->sum('totalPrice');



        $purchase = DB::table('invoices')->whereMonth('date', date('m'))->whereYear('date', date('Y'))->where('status','=','Approuvé')
        ->join('services', 'invoices.service_id', '=', 'services.id')  
        ->select('services.purchase_price')      
        ->sum('purchase_price');

        $profit= $sale - $purchase;

        $devices = Invoices::where('totalPrice','!=','Devis')->where('status','=','Approuvé')->whereMonth('date', date('m'))->whereYear('date', date('Y'))->get();
        return view("reporting.monthly",compact('Invoice','Parcel','devices','sale','purchase','profit'));
    }




         // search order monthly
         public function searchOrdermonthly(Request $request)
         { 
            $search = $request->search ?? "";
            if($search != ""){
                $sale = DB::table('invoices')->where('product','LIKE','%'.$search.'%')->whereMonth('date', date('m'))->whereYear('date', date('Y'))->where('status','=','Approuvé')
                ->select('invoices.totalPrice')      
                ->sum('totalPrice');
 
 
                    $purchase = DB::table('invoices')->where('product','LIKE','%'.$search.'%')->whereMonth('date', date('m'))->whereYear('date', date('Y'))->where('status','=','Approuvé')
                    ->join('services', 'invoices.service_id', '=', 'services.id')  
                    ->select('services.purchase_price')      
                    ->sum('purchase_price');
            
                    $profit= $sale - $purchase;
                    $devices = Invoices::where('product','LIKE','%'.$search.'%')->where('totalPrice','!=','Devis')->where('status','=','Approuvé')->whereMonth('date', date('m'))->whereYear('date', date('Y'))->get();
                            
            }else{
                $sale = DB::table('invoices')->whereMonth('date', date('m'))->whereYear('date', date('Y'))->where('status','=','Approuvé')
                ->select('invoices.totalPrice')      
                ->sum('totalPrice');
         
         
         
                 $purchase = DB::table('invoices')->whereMonth('date', date('m'))->whereYear('date', date('Y'))->where('status','=','Approuvé')
                 ->join('services', 'invoices.service_id', '=', 'services.id')  
                 ->select('services.purchase_price')      
                 ->sum('purchase_price');
         
                 $profit= $sale - $purchase;
         
                 $devices = Invoices::where('totalPrice','!=','Devis')->where('status','=','Approuvé')->whereMonth('date', date('m'))->whereYear('date', date('Y'))->get();
          
            }
            $Parcel = Parcel::first();
            $Invoice = Invoices::where('totalPrice','Devis')->first();
            return view("reporting.monthlySearch",compact('search','Invoice','Parcel','devices','sale','purchase','profit'));
      
          }





        // searchreport pager
        public function searchreport(){
            $Parcel = Parcel::first();
           $Invoice = Invoices::where('totalPrice','Devis')->first();
            $sale = DB::table('invoices')->whereMonth('date', date('m'))->whereYear('date', date('Y'))->where('status','=','Approuvé')
            ->join('services', 'invoices.service_id', '=', 'services.id')  
            ->select('services.sale')      
            ->sum('sale');

            $purchase = DB::table('invoices')->whereMonth('date', date('m'))->whereYear('date', date('Y'))->where('status','=','Approuvé')
            ->join('services', 'invoices.service_id', '=', 'services.id')  
            ->select('services.purchase_price')      
            ->sum('purchase_price');

            $profit= $sale - $purchase;

            $devices = Invoices::where('totalPrice','!=','Devis')->where('status','=','Approuvé')->whereMonth('date', date('m'))->whereYear('date', date('Y'))->get();
            return view("reporting.search",compact('Invoice','Parcel','devices','sale','purchase','profit'));
        }






    // all orderd 
    public function searchOrdersale(Request $request)
    {
        // sale
        $sale = DB::table('invoices')->whereBetween('date',[$request->search , $request->search1])->where('status','=','Approuvé')
        ->join('services', 'invoices.service_id', '=', 'services.id')  
        ->select('services.sale')      
        ->sum('sale');
        return response($sale);
    }


    // purchase searchOrderpurchase
    public function searchOrderpurchase(Request $request)
    {
        // purchase
        $purchase = DB::table('invoices')->whereBetween('date',[$request->search , $request->search1])->where('status','=','Approuvé')
        ->join('services', 'invoices.service_id', '=', 'services.id')  
        ->select('services.purchase_price')      
        ->sum('purchase_price');
        return response($purchase);
    }



    // purchase searchOrderprofit
    public function searchOrderprofit(Request $request)
    {
          // sale
        $sale = DB::table('invoices')->whereBetween('date',[$request->search , $request->search1])->where('status','=','Approuvé')
        ->join('services', 'invoices.service_id', '=', 'services.id')  
        ->select('services.sale')      
        ->sum('sale');

        // purchase
        $purchase = DB::table('invoices')->whereBetween('date',[$request->search , $request->search1])->where('status','=','Approuvé')
        ->join('services', 'invoices.service_id', '=', 'services.id')  
        ->select('services.purchase_price')      
        ->sum('purchase_price');

        $profit = $sale -  $purchase;
        return response($profit);
    }





        // all orderd 
        public function searchOrderall(Request $request)
        {
            $Parcel = Parcel::first();
            $Invoice = Invoices::where('totalPrice','Devis')->first();

            $from_date = $request->from_date;
            $to_date = $request->to_date;



            $sale = DB::table('invoices')->whereBetween('date',[$request->from_date , $request->to_date])->where('status','=','Approuvé')
            ->select('invoices.totalPrice')      
            ->sum('totalPrice');


    
            // purchase
            $purchase = DB::table('invoices')->whereBetween('date',[$request->from_date , $request->to_date])->where('status','=','Approuvé')
            ->join('services', 'invoices.service_id', '=', 'services.id')  
            ->select('services.purchase_price')      
            ->sum('purchase_price');
    
            $profit = $sale -  $purchase;



            $devices = Invoices::whereBetween('date',[$request->from_date , $request->to_date])->where('status','=','Approuvé')->get();
            return view("reporting.searchByDate",compact('sale','purchase','profit','from_date','to_date','Invoice','Parcel','devices'));

            // dd($from_date , $to_date);


        }

    



    // todayUserCreditreport pager
    public function todayUserCreditreport(){
    $Parcel = Parcel::first();
       $Invoice = Invoices::where('totalPrice','Devis')->first();
        $sale = DB::table('invoices')->whereDate('userCreditDate', now())->where('status','=','Approuvé')
        ->select('invoices.totalPrice')      
        ->sum('totalPrice');



        $purchase = DB::table('invoices')->whereDate('userCreditDate', now())->where('status','=','Approuvé')
        ->join('services', 'invoices.service_id', '=', 'services.id')  
        ->select('services.purchase_price')      
        ->sum('purchase_price');

        $profit= $sale - $purchase;

        $devices = Invoices::where('service_id','!=','Devis')->where('status','=','Approuvé')->whereDate('userCreditDate', now())->get();
        return view("reporting.UserCredittoday",compact('Invoice','Parcel','devices','sale','purchase','profit'));
    }







             // search searchTodaycredit
             public function searchTodaycredit(Request $request)
             { 
               $search = $request->search ?? "";
               if($search != ""){
                $sale = DB::table('invoices')->where('product','LIKE','%'.$search.'%')->whereDate('userCreditDate', now())->where('status','=','Approuvé')
                ->select('invoices.totalPrice')      
                ->sum('totalPrice');



                $purchase = DB::table('invoices')->where('product','LIKE','%'.$search.'%')->whereDate('userCreditDate', now())->where('status','=','Approuvé')
                ->join('services', 'invoices.service_id', '=', 'services.id')  
                ->select('services.purchase_price')      
                ->sum('purchase_price');

                $profit= $sale - $purchase;
                $devices = Invoices::where('product','LIKE','%'.$search.'%')->where('service_id','!=','Devis')->where('status','=','Approuvé')->whereDate('userCreditDate', now())->get();

               }else{
                $sale = DB::table('invoices')->whereDate('userCreditDate', now())->where('status','=','Approuvé')
                ->select('invoices.totalPrice')      
                ->sum('totalPrice');



                $purchase = DB::table('invoices')->whereDate('userCreditDate', now())->where('status','=','Approuvé')
                ->join('services', 'invoices.service_id', '=', 'services.id')  
                ->select('services.purchase_price')      
                ->sum('purchase_price');

                $profit= $sale - $purchase;
                    $devices = Invoices::where('service_id','!=','Devis')->where('status','=','Approuvé')->whereDate('userCreditDate', now())->get();
                }
               $Parcel = Parcel::first();
               $Invoice = Invoices::where('totalPrice','Devis')->first();
               return view("reporting.todaySearchCredit",compact('search','Invoice','Parcel','devices','sale','purchase','profit','search'));
         
             }


    // monthlyUserCreditreport pager
    public function monthlyUserCreditreport(){
        $Parcel = Parcel::first();
           $Invoice = Invoices::where('totalPrice','Devis')->first();
            $sale = DB::table('invoices')->whereMonth('userCreditDate', date('m'))->whereYear('userCreditDate', date('Y'))->where('payStatus','=','Payé')
            ->select('invoices.totalPrice')      
            ->sum('totalPrice');
    
    
    
            $purchase = DB::table('invoices')->whereMonth('userCreditDate', date('m'))->whereYear('userCreditDate', date('Y'))->where('payStatus','=','Payé')
            ->join('services', 'invoices.service_id', '=', 'services.id')  
            ->select('services.purchase_price')      
            ->sum('purchase_price');
    
            $profit= $sale - $purchase;
    
            $devices = Invoices::where('service_id','!=','Devis')->where('payStatus','=','Payé')->whereMonth('userCreditDate', date('m'))->whereYear('userCreditDate', date('Y'))->get();
            return view("reporting.UserCreditmonthly",compact('Invoice','Parcel','devices','sale','purchase','profit'));
        }


           // search searchmonthlycredit
           public function searchmonthlycredit(Request $request)
           { 
             $search = $request->search ?? "";
             if($search != ""){
                $sale = DB::table('invoices')->where('product','LIKE','%'.$search.'%')->whereMonth('userCreditDate', date('m'))->whereYear('userCreditDate', date('Y'))->where('payStatus','=','Payé')
                ->select('invoices.totalPrice')      
                ->sum('totalPrice');
        
        
        
                $purchase = DB::table('invoices')->where('product','LIKE','%'.$search.'%')->whereMonth('userCreditDate', date('m'))->whereYear('userCreditDate', date('Y'))->where('payStatus','=','Payé')
                ->join('services', 'invoices.service_id', '=', 'services.id')  
                ->select('services.purchase_price')      
                ->sum('purchase_price');
        
                $profit= $sale - $purchase;

                $devices = Invoices::where('product','LIKE','%'.$search.'%')->where('service_id','!=','Devis')->where('payStatus','=','Payé')->whereMonth('userCreditDate', date('m'))->whereYear('userCreditDate', date('Y'))->get();

             }else{
                $sale = DB::table('invoices')->whereMonth('userCreditDate', date('m'))->whereYear('userCreditDate', date('Y'))->where('payStatus','=','Payé')
                ->select('invoices.totalPrice')      
                ->sum('totalPrice');
        
        
        
                $purchase = DB::table('invoices')->whereMonth('userCreditDate', date('m'))->whereYear('userCreditDate', date('Y'))->where('payStatus','=','Payé')
                ->join('services', 'invoices.service_id', '=', 'services.id')  
                ->select('services.purchase_price')      
                ->sum('purchase_price');
        
                $profit= $sale - $purchase;
        
                $devices = Invoices::where('service_id','!=','Devis')->where('payStatus','=','Payé')->whereMonth('userCreditDate', date('m'))->whereYear('userCreditDate', date('Y'))->get();
              }
             $Parcel = Parcel::first();
             $Invoice = Invoices::where('totalPrice','Devis')->first();
             return view("reporting.monthlySearchCredit",compact('search','Invoice','Parcel','devices','sale','purchase','profit','search'));
       
           }



             




    
}
