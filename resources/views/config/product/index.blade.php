@extends('layouts.informathic2')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<!-- custom delte button -->

<!-- end custom delte button -->
<div class="row">
    <div class="col-12 text-center">
        <div class="dashboard_image">
            <h1 class="brand_device mt-5">Des produits</h1> 
        </div>
    </div>
    <div class="col-lg-8 mt-3">
        <div class="card">
            <div class="card-body">
                <a href="{{url('productPDF')}}">
                    <button type="button" class="btn btn-sm btn-success float-right my-1">Exporter PDF</button>
                </a>
                <table class="table table-bordered w-100 text-dark" id="users-table">
                    <thead class="card-header">
                        <tr>
                            <th>Identifiant</th>
                            <th>Nom du produit</th>
                            <th>Marque</th>
                            <th>Statut</th>
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
            Ajouter de nouveaux produits
            </div>
            <div class="card-body">
                <form action="{{url('config/product/add')}}" method="POST"  enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Nom du produit *</b></label>
                        <input type="text" name="product_name" class="form-control" >
                        @error('product_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        <br>
                        <label for="exampleInputEmail1"><b>Sélectionner la marquet *</b></label>
                        <select name="product_id" class="form-control" >
                                <option value="" selected>--Sélectionner la marquet--</option>
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
        ajax: '{!! route('products.data') !!}',
        columnDefs:[
            {
                targets: 5,
                title:'Action',
                orderable:false,
                render: function(data,type,full,meta){
                    return ' <a class="btn btn-sm btn-primary" href="/product/edit/'+full.id+'">Éditer </a>  <a class="btn btn-sm btn-danger" href="/product/delete/'+full.id+'">Handicapé </a>'
                }
            }
        ],
        columns: [
            
            { data: 'id', name: 'id' },
            { data: 'product_name', name: 'product_name' },
            { data: 'product_id', name: 'product_id' },
            { data: 'disable', name: 'disable' },
            { data: 'created_at', name: 'created_at' },
        ]
    });
});
</script>

@endsection