<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\config\brand;
use App\Models\config\product;
use App\Models\service;
use App\Models\Parcel;
use App\Models\Invoices;
use App\Models\User;
use Auth;
use Image;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Carbon;
use DB;
class ConfigurationController extends Controller
{
    // index page
    public function index(){
        $Parcel = Parcel::first();
      $Invoice = Invoices::where('totalPrice','Quotation')->first();
        return view("config.index",compact('Invoice','Parcel'));
    }
    

    // brand page
    public function brands(){
        $brand = DB::table('brands')->first();
        $Parcel = Parcel::first();
      $Invoice = Invoices::where('totalPrice','Quotation')->first();
        return view('config.brands.index',compact('brand','Parcel','Invoice'));
    }
    // yajra  for brand
    public function getbrands()
        {
            return Datatables::of(brand::query()->orderBy('id','desc'))
            ->editColumn('created_at',function(brand $brand){
                return $brand->created_at->diffForHumans();
            })
            ->make(true);
        }

    // brand add
    public function addBrands(Request $request){
        $validateData = $request->validate([
            'product_name' => 'required|unique:brands|max:255',
            'image'        =>  'required|image|mimes:jpeg,png,jpg|max:2048'
        ],
        [
            'product_name.required' => 'Ce champ est requis',
            'product_name.unique' => 'Nom du produit unique',
            'image.required' => 'Ce champ est requis',
            'image.mimes' => 'Limage doit être .jpg, .jpeg, .png,',
            'image.max' => 'La taille de limage doit être inférieure à 2 Mo',
        ]);

        $id = Auth::user()->id;
        $photo = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$photo->GetClientOriginalExtension();
        Image::make($photo)->resize(300,200)->save('img/brand/'.$name_gen);
        $last_img = 'img/brand/'.$name_gen;

        brand::insert([
            'user_id' => $id,
            'product_name' => $request->product_name,
            'image' => $last_img,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Compte utilisateur créé !',
            'alert_type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    // edit brand page
    public function editBrand($id){
        $brand = brand::find($id);
        $Parcel = Parcel::first();
      $Invoice = Invoices::where('totalPrice','Quotation')->first();

        return view('config.brands.edit' ,compact('brand','Parcel','Invoice'));

    }

    // update brands
    public function updateBrands(Request $request, $id){
        $validateData = $request->validate([
            'product_name' =>  'min:3',
            'image'        =>  'image|mimes:jpeg,png,jpg|max:2048'
        ],
        [
            'product_name.min' => 'Nom Requis au moins 3 caractères  ',
            'image.mimes' => 'Limage doit être .jpg, .jpeg, .png,',
            'image.max' => 'La taille de limage doit être inférieure à 2 Mo',
        ]);
        $photo = $request->file('image');
        if($photo){
            $name_gen = hexdec(uniqid()).'.'.$photo->GetClientOriginalExtension();
            Image::make($photo)->resize(300,200)->save('img/brand/'.$name_gen);

            $last_img = 'img/brand/'.$name_gen;

            brand::find($id)->update([
                'product_name' => $request->product_name,
                'image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Mise à jour de la marque !',
                'alert_type' => 'warning'
            );
            return Redirect()->back()->with($notification);
        }
        else{
            brand::find($id)->update([
                'product_name' => $request->product_name,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Mise à jour de la marque !',
                'alert_type' => 'warning'
            );
            return Redirect()->back()->with($notification);
        }
    }
    // disabled brnad
    public function DeleteBrand($id){

        brand::find($id)->update([
            'disable' => 'Désactivé',
        ]);
        $notification = array(
            'message' => 'Vous désactivez cette marque!',
            'alert_type' => 'error'
        );
        return Redirect()->back()->with($notification);

    }
     // active brand
    
     public function BrandActive($id){
        Brand::find($id)->update([
            'disable' => 'Actif',
        ]);
        $notification = array(
            'message' => 'Marque actif!',
            'alert_type' => 'succcess'
        );
        return Redirect('/configuration/Marque')->with($notification);
    }




    // product page
    public function Products(){
        $brands = brand::all();
        $product = product::first();
        $Parcel = Parcel::first();
        $Invoice = Invoices::where('totalPrice','Quotation')->first();
        return view('config.product.index',compact('brands','product','Parcel','Invoice'));
    }


    // product add
    public function addProducts(Request $request){
        $validateData = $request->validate([
            'product_name' => 'required|unique:products|max:255',
            'product_id' => 'required',
            'image'        =>  'required|image|mimes:jpeg,png,jpg|max:2048'
        ],
        [
            'product_name.required' => 'Ce champ est requis',
            'product_id.required' => 'Ce champ est requis',
            'product_name.unique' => 'Nom du produit unique',
            'image.required' => 'Ce champ est requis',
            'image.mimes' => 'Limage doit être .jpg, .jpeg, .png,',
            'image.max' => 'La taille de limage doit être inférieure à 2 Mo',
        ]);

        $id = Auth::user()->id;
        $photo = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$photo->GetClientOriginalExtension();
        Image::make($photo)->resize(300,200)->save('img/product/'.$name_gen);
        $last_img = 'img/product/'.$name_gen;

        product::insert([
            'user_id' => $id,
            'product_name' => $request->product_name,
            'product_id' => $request->product_id,
            'image' => $last_img,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => ' Ajouter un produit!',
            'alert_type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

      // yajra  for product
      public function getproducts()
      {
          return Datatables::of(product::query()->orderBy('id','desc'))
          ->editColumn('product_id',function(product $product){
            return $product->brand->product_name;
        })
          ->editColumn('created_at',function(product $product){
              return $product->created_at->diffForHumans();
          })
          ->make(true);
      }


       // edit product page
    public function editProducts($id){
        $brands = brand::all();
        $products = product::find($id);
        $Parcel = Parcel::first();
        $Invoice = Invoices::where('totalPrice','Quotation')->first();
        return view('config.product.edit' ,compact('products','brands','Parcel','Invoice'));

    }

    // update brands
    public function updateProducts(Request $request, $id){
        $validateData = $request->validate([
            'product_name' =>  'min:3',
            'image'        =>  'image|mimes:jpeg,png,jpg|max:2048'
        ],
        [
            'product_name.min' => 'Nom Requis au moins 3 caractères  ',
            'product_name.unique' => 'Nom du produit unique  ',
            'image.mimes' => 'Limage doit être .jpg, .jpeg, .png,',
            'image.max' => 'La taille de limage doit être inférieure à 2 Mo',
        ]);
        $photo = $request->file('image');
        if($photo){
            $name_gen = hexdec(uniqid()).'.'.$photo->GetClientOriginalExtension();
            Image::make($photo)->resize(300,200)->save('img/product/'.$name_gen);

            $last_img = 'img/product/'.$name_gen;

            product::find($id)->update([
                'product_name' => $request->product_name,
                'product_id' => $request->product_id,
                'image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Mise à jour du produit!',
                'alert_type' => 'warning'
            );
            return Redirect()->back()->with($notification);
        }
        else{
            product::find($id)->update([
                'product_name' => $request->product_name,
                'product_id' => $request->product_id,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Mise à jour du produit!',
                'alert_type' => 'warning'
            );
            return Redirect()->back()->with($notification);
        }
    }

    // delete product
    public function DeleteProducts($id){
        product::find($id)->update([
            'disable' => 'Désactivé',
        ]);
        $notification = array(
            'message' => 'Vous désactivez ce produit!',
            'alert_type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }

    // product active

    public function productActive($id){
        product::find($id)->update([
            'disable' => 'Actif',
        ]);
        $notification = array(
            'message' => 'Produit actif!',
            'alert_type' => 'succcess'
        );
        return Redirect('/configuration/Produit')->with($notification);
    }

    // product page
    public function Services(){
        $brands = brand::all();
        $products = product::all();
        $service = DB::table('services')->first();
        $Parcel = Parcel::first();
        return view('config.service.index',compact('brands','products','service','Parcel'));
    }

      // yajra  for service
      public function getservices()
      {
          return Datatables::of(service::query()->orderBy('id','desc'))
          ->editColumn('marks_id',function(service $service){
            return $service->brand->product_name;
        })
          ->editColumn('product_id',function(service $service){
            return $service->product->product_name;
        })
          ->editColumn('created_at',function(service $service){
              return $service->created_at->diffForHumans();
          })
          ->make(true);
      }


     // service add
     public function addServices(Request $request){
        $validateData = $request->validate([
            'service' => 'required|max:255',
            'product_id' => 'required',
            'marks_id' => 'required',
            'image'        =>  'image|mimes:jpeg,png,jpg|max:2048'
        ],
        [
            'service.required' => 'Ce champ est requis',
            'product_id.required' => 'Ce champ est requis',
            'marks_id.required' => 'Ce champ est requis',
            'image.mimes' => 'Limage doit être .jpg, .jpeg, .png,',
            'image.max' => 'La taille de limage doit être inférieure à 2 Mo',
        ]);

        $id = Auth::user()->id;
        if($request->price){
            if($photo = $request->file('image')){
            $name_gen = hexdec(uniqid()).'.'.$photo->GetClientOriginalExtension();
            Image::make($photo)->resize(300,200)->save('img/service/'.$name_gen);
            $last_img = 'img/service/'.$name_gen;
    
            service::insert([
                'user_id' => $id,
                'service' => $request->service,
                'product_id' => $request->product_id,
                'marks_id' => $request->marks_id,
                'purchase_price' => $request->purchase_price,
                'sale' => $request->price,
                'stock' => $request->stock,
                'image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => ' Service ajouté!',
                'alert_type' => 'success'
            );
            return Redirect('/inventory')->with($notification);
            }else{
                $random_img = 'img/random2.jpg'; 
                service::insert([
                    'user_id' => $id,
                    'service' => $request->service,
                    'product_id' => $request->product_id,
                    'marks_id' => $request->marks_id,
                    'purchase_price' => $request->purchase_price,
                    'sale' => $request->price,
                    'stock' => $request->stock,
                    'image' => $random_img,
                    'created_at' => Carbon::now(),
                ]);
                $notification = array(
                    'message' => ' Service ajouté!',
                    'alert_type' => 'success'
                );
                return Redirect('/inventory')->with($notification);
            }
        }
        else{
            if($photo = $request->file('image')){
            $name_gen = hexdec(uniqid()).'.'.$photo->GetClientOriginalExtension();
            Image::make($photo)->resize(300,200)->save('img/service/'.$name_gen);
            $last_img = 'img/service/'.$name_gen;
    
            service::insert([
                'user_id' => $id,
                'service' => $request->service,
                'product_id' => $request->product_id,
                'marks_id' => $request->marks_id,
                'purchase_price' => $request->purchase_price,
                'sale' => 'Devis',
                'stock' => $request->stock,
                'image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => ' Service ajouté!',
                'alert_type' => 'success'
            );
            return Redirect('/inventory')->with($notification);
            }else{
                $random_img = 'img/random2.jpg'; 
                service::insert([
                    'user_id' => $id,
                    'service' => $request->service,
                    'product_id' => $request->product_id,
                    'marks_id' => $request->marks_id,
                    'purchase_price' => $request->purchase_price,
                    'sale' => 'Devis',
                    'stock' => $request->stock,
                    'image' => $random_img,
                    'created_at' => Carbon::now(),
                ]);
                $notification = array(
                    'message' => ' Service ajouté!',
                    'alert_type' => 'success'
                );
                return Redirect('/inventory')->with($notification);
            }
        }
    }


      // edit service page
      public function editServices($id){
        $brands = brand::all();
      $Invoice = Invoices::where('totalPrice','Quotation')->first();

        $products = product::all();
        $services = service::find($id);
        $Parcel = Parcel::first();
        return view('config.service.edit',compact('Invoice','brands','products','services','Parcel'));

    }
   // update service
   public function updateServices(Request $request, $id){
    $validateData = $request->validate([
        'service' => 'min:3',
        'image'        =>  'image|mimes:jpeg,png,jpg|max:2048'
    ],
    [
        'service.min' => 'Nom Requis au moins 3 caractères ',
        'product_id.required' => 'Ce champ est requis',
        'image.mimes' => 'Limage doit être .jpg, .jpeg, .png,',
        'image.max' => 'La taille de limage doit être inférieure à 2 Mo',
    ]);
    $photo = $request->file('image');
        if($photo){
            $name_gen = hexdec(uniqid()).'.'.$photo->GetClientOriginalExtension();
            Image::make($photo)->resize(300,200)->save('img/service/'.$name_gen);
            $last_img = 'img/service/'.$name_gen;

            service::find($id)->update([
                'service' => $request->service,
                'product_id' => $request->product_id,
                'marks_id' => $request->marks_id,
                'sale' => $request->price,
                'stock' => $request->stock,
                'purchase_price' => $request->purchase_price,
                'image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Mise à jour du produit!',
                'alert_type' => 'warning'
            );
            return Redirect('/inventory')->with($notification);
        }
        else{
            service::find($id)->update([
                'service' => $request->service,
                'product_id' => $request->product_id,
                'marks_id' => $request->marks_id,
                'purchase_price' => $request->purchase_price,
                'sale' => $request->price,
                'stock' => $request->stock,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Mise à jour du produit!',
                'alert_type' => 'warning'
            );
            return Redirect('/inventory')->with($notification);
        }
    }
      // disabled service
      public function DeleteServices($id){
        service::find($id)->update([
            'disable' => 'Désactivé',
        ]);
        $notification = array(
            'message' => 'Vous avez désactivé ce service!',
            'alert_type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }

    // active servec
    
     public function serviceActive($id){
        service::find($id)->update([
            'disable' => 'Actif',
        ]);
        $notification = array(
            'message' => 'Service actif!',
            'alert_type' => 'succcess'
        );
        return Redirect('/inventory')->with($notification);
    }




      // product fetch data for fee
      public function fetchProduct(Request $request){
        $data = product::where('id',$request->product)->first();
        return response($data);
    }


    
}
