@extends('layouts.informathic')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="col-12 text-center">
                <div class="dashboard_image" >
                    <h1 class="brand_device mt-5">Problèmes utilisateur</h1> 
                </div>
            </div>
           

            <div class="card-body">
                <table class="table table-bordered w-100 text-dark" id="users-table">
                        <thead style="background: rgb(12, 23, 65);">
                            <tr>
                                <th scope="col" class="text-white">#</th>
                                <th scope="col" class="text-white">Nom d'utilisateur</th>
                                <th scope="col" class="text-white">Des marques</th>
                                <th scope="col" class="text-white">Produit</th>
                                <th scope="col" class="text-white">Demande de service</th>
                                <th scope="col" class="text-white">Statut</th>
                                <th scope="col" class="text-white" >Option</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                        </tbody>
                </table>
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
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('problem.data') !!}',
        columnDefs:[
            {
                targets: 6,
                title:'Action',
                orderable:false,
                render: function(data,type,full,meta){
                    return ' <a class="btn btn-sm btn-primary" href="/problem/Detail/'+full.id+'">Soutien </a>'
                }
            }
        ],
        columns: [
            
            { data: 'id', name: 'id' },
            { data: 'userId', name: 'userId' },
            { data: 'marks', name: 'marks' },
            { data: 'product', name: 'product' },
            { data: 'serviceRequest', name: 'serviceRequest' },
            { data: 'admin_chat', name: 'admin_chat' },
        ]
    });
});
</script>
@endsection