@extends('layouts.informathic2')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

<div class="row">
    <div class="col-12 text-center">
        <div class="dashboard_image">
            <h1 class="brand_device mt-5">Modifier le produit</h1> 
        </div>
    </div>

    <div class="col-lg-12 my-3">
        <div class="card">
            <div class="card-header">
            Mettre à jour le produit
            </div>
            <div class="card-body">
                <form action="{{url('config/product/update/'.$products->id)}}" method="POST"  enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                       <div class="row">
                            <div class="col-lg-8 my-2">
                                <label for="exampleInputEmail1"><b>Nom de marque *</b></label>
                                <input type="text" name="product_name" value="{{$products->product_name}}" class="form-control" >
                                @error('product_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                <label for="exampleInputEmail1"><b>Sélectionner la marquet *</b></label>
                                <select name="product_id" class="form-control" >
                                        <option value="{{$products->product_id}}" selected>{{$products->brand->product_name}}</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->product_name}}</option>
                                        @endforeach
                                </select>
                                @error('product_id')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                <label for="exampleInputEmail1" class="mt-2"><b>Sélectionner une image *</b></label>
                                <input type="file" name="image" class="form-control" >
                                @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>


                        <div class="col-lg-4 my-2">
                            <img src="../../{{$products->image}}" class="img-fluid" alt="">
                        </div>
                       </div>
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{url('/configuration/Produit')}}" class="text-white">
                                    <button type="button" class="btn btn-block next-step">
                                Retour
                                    </button>
                                </a>
                            </div>


                            <div class="col-md-4">
                                <a href="{{url('/product/active/'.$products->id)}}" class="text-white">
                                    <button type="button" class="btn btn-block next-step">
                                Actif
                                    </button>
                                </a>
                            </div>


                            <div class="col-md-4">
                                <button type="submit" class="btn btn-block next-step">Ajouter</button>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>


  
</div>
@endsection