@extends('layouts.informathic2')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

<div class="row">
    <div class="col-12 text-center">
        <div class="dashboard_image">
            <h1 class="brand_device mt-5">Inventaire Modifier</h1> 
        </div>
    </div>

    <div class="col-lg-12 my-3">
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="form-group">
                       <div class="row">
                            <div class="col-lg-4 my-2">
                                <label for="exampleInputEmail1"><b>Marque *</b></label>
                                    <select name="product_id" class="form-control" id="brands" >
                                        <option selected value="{{$Inventory->brand}}">{{$Inventory->brand}}</option>
                                            @foreach($brand as $br)
                                                <option value="{{$br->id}}">{{$br->product_name}}</option>
                                            @endforeach
                                    </select>
                            </div>

                            <div class="col-lg-4 my-2">
                                <label for="exampleInputEmail1"><b>Nom du produit *</b></label>
                                    <select name="product_id" class="form-control" id="select_product" >
                                        <option selected disabled>--Vide--</option>
                                    </select>
                            </div>


                            <div class="col-lg-4 my-2">
                                <label for="exampleInputEmail1"><b>Nom du service *</b></label>
                                    <select name="service" class="form-control" id="select_service" >
                                        <option selected disabled>--Vide--</option>
                                    </select>
                            </div>

                            <div class="col-lg-4 my-2 frp">
                                <label for="exampleInputEmail1"><b>Prix ​​d'achat *</b></label>
                                   <input type="text" id="purchase_price" disabled class="form-control " >
                            </div>


                            <div class="col-lg-4 my-2 frp">
                                <label for="exampleInputEmail1"><b>Prix ​​de vente*</b></label>
                                    <input type="text" id="price" disabled class="form-control" >
                            </div>

                            <div class="col-lg-4 my-2 frp" >
                                <label for="exampleInputEmail1"><b>Quantité* <span class="text-secondary" style="font-size: 12px;">(Vous pouvez mettre à jour la quantité)</span></b></label>
                                    <input type="text"  id="quantity" class="form-control" >
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
                                <button type="button" id="add" class="btn btn-block next-step">Ajouter</button>
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



        $("#select_service").change(function(){
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


        $("#add").click(function(){
            var brand = $('#brands').val();
            var product = $('#select_product').val();
            var service = $('#select_service').val();
            var purchase_price = $('#purchase_price').val();
            var price = $('#price').val();
            var quantity = $('#quantity').val();

           



            $.ajax({
                url:'{{ url('/inventory/data/add') }}',
                type:'post',
                headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                data:{'brand':brand,'product':product,'service':service,
                    'purchase_price':purchase_price,'price':price,'quantity':quantity},
                    success:function(success){   
                            if(success){
                                toastr.success(success.message,'Produit ajouté!');
                                window.location.reload();
                                
                            }              
                        }  
            });
         
        });
    });
</script>
@endsection