@extends('layouts.informathic2')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

<div class="row">
    <div class="col-12 text-center">
        <div class="dashboard_image">
            <h1 class="brand_device mt-5">Ajouter nouveau</h1> 
        </div>
    </div>

    <div class="col-lg-12 my-3">
        <div class="card">
            <div class="card-body">
                <form action="{{url('config/service/add')}}" method="POST"  enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                       <div class="row">
                            <div class="col-lg-4 my-2">
                                <label for="exampleInputEmail1"><b>Marque *</b></label>
                                    <select class="form-control" name="marks_id" id="brands" >
                                        <option selected disabled>--Sélectionner la marque--</option>
                                            @foreach($brand as $br)
                                                <option value="{{$br->id}}">{{$br->product_name}}</option>
                                            @endforeach
                                    </select>
                                    @error('marks_id')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </div>

                            <div class="col-lg-4 my-2">
                                <label for="exampleInputEmail1"><b>Nom du produit *</b></label>
                                    <select class="form-control" name="product_id" id="select_product" >
                                        <option selected disabled>--Vide--</option>
                                    </select>
                                    @error('product_id')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </div>


                            <div class="col-lg-4 my-2">
                                <label for="exampleInputEmail1"><b>Nom du service *</b></label>
                                    <input type="text" id="service" name="service"  class="form-control " >
                                    @error('service')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    
                            </div>

                            <div class="col-lg-4 my-2 frp">
                                <label for="exampleInputEmail1"><b>Prix ​​d'achat </b></label>
                                   <input type="text" id="purchase_price" name="purchase_price"  class="form-control " >
                            </div>


                            <div class="col-lg-4 my-2 frp">
                                <label for="exampleInputEmail1"><b>Prix ​​de vente</b></label>
                                    <input type="text" id="price" name="price" class="form-control" >
                            </div>


                            <div class="col-lg-4 my-2 frp">
                                <label for="exampleInputEmail1"><b>Sélectionner une image </b></label>
                                    <input type="file" name="image" class="form-control" >
                                    @error('image')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </div>
                            

                            <div class="col-lg-4 my-2 frp" >
                                <label for="exampleInputEmail1"><b>Quantité</label>
                                    <input type="text"  id="quantity" name="stock" class="form-control" >
                            </div>

                         


                        <div class="col-lg-4 my-2">
                        </div>
                       </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{url('/inventory')}}" class="text-white">
                                    <button type="button" class="btn btn-block next-step">
                                Retour
                                    </button>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" id="add" class="btn btn-block next-step">Ajouter</button>
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

        $("#select_product").change(function(){
            var product = $(this).val();
            $.ajax({
                url:'{{ url('/service/fetch/inv') }}',
                type:'get',
                data:{'product':product},
                success:function(data){
                    $('#select_service').html(data);
                }
            });
         
        });



        // $('.frp').css({"display":"none"})
        $("#select_service").change(function(){
            // $('.frp').css({"display":"block"})
            var product = $(this).val();
            $.ajax({
                url:'{{ url('/service/fetch/data/inv') }}',
                type:'get',
                data:{'product':product},
                success:function(data){
                    $('#purchase_price').val(data.purchase_price);
                    $('#price').val(data.price); 
                }
            });
         
        });


        // $("#add").click(function(){
        //     var brand = $('#brands').val();
        //     var product = $('#select_product').val();
        //     var service = $('#select_service').val();
        //     var purchase_price = $('#purchase_price').val();
        //     var price = $('#price').val();
        //     var quantity = $('#quantity').val();

           



        //     $.ajax({
        //         url:'{{ url('/inventory/data/add') }}',
        //         type:'post',
        //         headers: {
        //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //             },
        //         data:{'brand':brand,'product':product,'service':service,
        //             'purchase_price':purchase_price,'price':price,'quantity':quantity},
        //             success:function(success){   
        //                     if(success){
        //                         toastr.success(success.message,'Produit ajouté!');
        //                         window.location.reload();
                                
        //                     }              
        //                 }  
        //     });
         
        // });
    });
</script>
@endsection