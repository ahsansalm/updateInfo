@extends('layouts.informathic2')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

<div class="row">
    <div class="col-12 text-center">
        <div class="dashboard_image">
            <h1 class="brand_device mt-5">Modifier le d'inventaire</h1> 
        </div>
    </div>

    <div class="col-lg-12 my-3">
        <div class="card">
            <div class="card-header">
            Mettre à jour le d'inventaire
            </div>
            <div class="card-body">
                <form action="{{url('config/service/update/'.$services->id)}}" method="POST"  enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                       <div class="row">
                            <div class="col-lg-8 my-2">
                                <label for="exampleInputEmail1"><b>Marque *</b></label>
                                    <select class="form-control" name="marks_id" id="brands" >
                                        <option selected value="{{$services->marks_id}}">{{$services->brand->product_name}}</option>
                                            @foreach($brands as $br)
                                                <option value="{{$br->id}}">{{$br->product_name}}</option>
                                            @endforeach
                                    </select>
                                    @error('marks_id')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror

                                
                                <br>
                                <label for="exampleInputEmail1"><b>Sélectionner la marquet <span style="font-size: 13px; color: gray;">(Si vous souhaitez modifier le produit, sélectionnez d'abord la marque)</span> *</b></label>

                                <select name="product_id" class="form-control" id="select_product" >
                                        <option value="{{$services->product_id}}" selected>{{$services->product->product_name}}</option>
                                       
                                </select>



                                <br>
                                <label for="exampleInputEmail1"><b>Nom du service *</b></label>
                                <input type="text" name="service" value="{{$services->service}}" class="form-control" >
                                @error('service')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror


                                @error('product_id')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                <label for="exampleInputEmail1" class="mt-2"><b>Sélectionner une image </b></label>
                                <input type="file" name="image" class="form-control" >
                                @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                <label for="exampleInputEmail1"><b>Prix ​​d'achat </b></label>
                                <input type="text" name="purchase_price" value="{{$services->purchase_price}}"class="form-control" >
                                <br>
                                <label for="exampleInputEmail1"><b>Prix ​​de vente </b></label>
                                <input type="text" name="price" value="{{$services->sale}}" class="form-control" >
                                <br>
                                <label for="exampleInputEmail1"><b>Quantité </b></label>
                                <input type="text" name="stock" value="{{$services->stock}}" class="form-control" >
                                <br>
                              
                            </div>


                        <div class="col-lg-4 my-2">
                            <img src="../../{{$services->image}}" class="img-fluid" alt="">
                        </div>
                       </div>
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{url('/inventory')}}" class="text-white">
                                    <button type="button" class="btn btn-block next-step">
                                Retour
                                    </button>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="{{url('/service/active/'.$services->id)}}" class="text-white">
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
<script src="//code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script>
    $(function(){
        $("#brands").change(function(){
            var product = $(this).val();
            $.ajax({
                url:'{{ url('/brand/fetch/inv') }}',
                type:'get',
                data:{'product':product},
                success:function(data){
                    $('#select_product').html(data);
                }
            });
         
        });
    });
</script>
@endsection