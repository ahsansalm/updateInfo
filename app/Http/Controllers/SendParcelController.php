<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parcel;
use App\Models\Invoices;
use Illuminate\Support\Carbon;
use App\Models\config\brand;
use Picqer;
use DB;
use Auth;
class SendParcelController extends Controller
{
    // sedn parcel
    public function sendParcel(){
        $id = Auth::user()->id;
        $brands = brand::where('disable','Actif')->get();
        $Parcel = Parcel::where('userId' , $id)->first();
        
      $Invoice = Invoices::where('user_id' , $id)->first();
        return view("sendParcel.index",compact('brands','Invoice','Parcel'));    
    }
    // success parcel
    public function successParcel(){
        $id = Auth::user()->id;
        $Parcel = Parcel::where('userId' , $id)->first();
        $Invoice = Invoices::where('user_id' , $id)->first();
        return view("sendParcel.success",compact('Parcel','Invoice'));    
    }

    // insert parcel
    public function insert(Request $request){
        DB::table('parcels')->update(array('order_noti' => 'Nouveau'));
        DB::table('invoices')->update(array('quote_noti' => 'neuf'));

        // product code section
        $product_code = rand(106890122,100000000);

        $image = 'barcode/' .time(). ".png";
        $barimgae = '/'.'barcode/' .time(). ".png";
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        $barcodes =  file_put_contents($image,$generator->getBarcode
        ($product_code,$generator::TYPE_CODE_128, 3, 50));
       

        $parcel = Parcel::create([
            'userId' => $request->userId,
            'marks' => $request->marks,
            'product' => $request->product,
            'serviceRequest' => $request->service,
            'product_code' => $product_code,
            'barcode' => $barimgae,
            'information' => $request->information,
            'problems' => $request->problem,
            'pin' => $request->pin,
            'pattern' => $request->pattern,
            'shipment' => $request->shipment,
            'returnChoice' => $request->returnChoice,
            'date' => date('Y-m-d'),
            'month' => date('m'),
            'created_at' => Carbon::now(),
        ]);
        $id = $parcel->id;
        Invoices::insert([
            'marks' => $request->marks,
            'product' => $request->product,
            'user_id' => $request->userId,
            'productId' => $id,
            'totalPrice' => $request->price,
            'service_id' => $request->service,
            'date' => date('Y-m-d'),
            'month' => date('m'),
        ]);
        return response(['success','Colis téléchargé avec succès']);    
    }
}
