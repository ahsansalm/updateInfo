@extends('layouts.informathic2')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

<div class="row">
    <div class="col-12 text-center">
        <div class="dashboard_image">
            <h1 class="brand_device mt-5">Modifier la marque</h1> 
        </div>
    </div>

    <div class="col-lg-12 my-3">
        <div class="card">
            <div class="card-header">
            Mettre à jour la marque
            </div>
            <div class="card-body">
                <form action="{{url('config/brand/update/'.$brand->id)}}" method="POST"  enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                       <div class="row">
                            <div class="col-lg-8 my-2">
                                <label for="exampleInputEmail1"><b>Nom de marque *</b></label>
                                <input type="text" name="product_name" value="{{$brand->product_name}}" class="form-control" >
                                @error('product_name')
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
                            <img src="../../{{$brand->image}}" class="img-fluid" alt="">
                        </div>
                       </div>
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{url('/configuration/Marque')}}" class="text-white">
                                    <button type="button" class="btn btn-block next-step">
                                Retour
                                    </button>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="{{url('/Active/Marque/'.$brand->id)}}" class="text-white">
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