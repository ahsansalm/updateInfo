@extends('layouts.informathic2')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<!-- custom delte button -->

<!-- end custom delte button -->

<div class="row">
    <div class="col-12 text-center">
        <div class="dashboard_image">
            <h1 class="brand_device mt-5">Prestations de service</h1> 
        </div>
    </div>
    <div class="col-lg-8 mt-3">
        <div class="card">
            <div class="card-body">
                
                <table class="table table-bordered w-100 text-dark" id="users-table">
                    <thead class="card-header">
                        <tr>
                            <th>Identifiant</th>
                            <th>Service</th>
                            <th>Produit</th>
                            <th>Prix (€)</th>
                            <th>Créé à</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <div class="col-lg-4 mt-3">
        <div class="card">
            <div class="card-header">
            Service de mise à jour
            </div>
            <div class="card-body">
                <form action="{{url('config/service/add')}}" method="POST"  enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <input type="hidden" class="marksId" name="marks_id">
                        <label for="exampleInputEmail1"><b>Nom du service *</b></label>
                        <input type="text" name="service" class="form-control" >
                        @error('service')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        <br>
                        <label for="exampleInputEmail1"><b>Sélectionner un produit *</b></label>
                        <select name="product_id" class="form-control"  id="select_product">
                                <option value="" selected>--Sélectionner un produit--</option>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->product_name}}</option>
                                @endforeach
                        </select>
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
                        <input type="text" name="purchase_price" class="form-control" >
                        <br>
                        <label for="exampleInputEmail1"><b>Prix ​​de vente </b>(Si ce champ est vide, le prix sera un devis)</label>
                        <input type="text" name="price" class="form-control" >
                      
                    </div>
                    <button type="submit" class="btn next-step">Ajouter</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-2 mb-3">
        <a href="{{url('/configuration')}}">
            <button type="button" class="default-btn btn-block btn-secondary prev-step">
        Retour
    </div>
</div>
<script src="//code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('services.data') !!}',
        columnDefs:[
            {
                targets: 5,
                title:'Action',
                orderable:false,
                render: function(data,type,full,meta){
                    return ' <a class="btn btn-sm btn-primary" href="/service/edit/'+full.id+'">Éditer </a>  <a class="btn btn-sm btn-primary" href="/service/delete/'+full.id+'">Effacer </a> '
                }
            }
        ],
        columns: [
            
            { data: 'id', name: 'id' },
            { data: 'service', name: 'service' },
            { data: 'product_id', name: 'product_id' },
            { data: 'sale', name: 'sale' },
            { data: 'created_at', name: 'created_at' },
        ]
    });
});
$(function(){
        $("#select_product").change(function(){
            var product = $(this).val();
            console.log(product)
            $.ajax({
                url:'{{ url('/product/fetch/data') }}',
                type:'get',
                data:{'product':product},
                success:function(data){
                    $('.marksId').val(data.product_id);
                }
            });
         
        });
    });
</script>

@endsection