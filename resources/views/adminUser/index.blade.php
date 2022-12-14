@extends('layouts.informathic')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">


<style>
     
    </style>




    <div class="row">
            <div class="col-12">
                <div class="card">
                   <div class="row text-center">
                        <div class="col-12">
                            <div class="dashboard_image">
                                <h1 class="brand_device mt-5">Tous les utilisateurs</h1> 
                            </div>
                            
                        </div>
                        
                        <div class="col-12">
                            <a href="{{url('userPDF')}}">
                                <button type="button" class="btn btn-sm btn-success float-right m-2">Exporter PDF</button>
                            </a>
                        </div>
                   </div>
                   
                    <div class="card-body">
                    <!-- users -->
                            <table class="table table-bordered w-100 text-dark" id="users-table">
                                <thead style="background: rgb(12, 23, 65);">
                                    <tr>
                                        <th scope="col" class="text-white">#</th>
                                        <th scope="col" class="text-white">Prénom</th>
                                        <th scope="col" class="text-white">E-mail</th>
                                        <th scope="col" class="text-white">Statut</th>
                                        <th scope="col" class="text-white" style="width: 80px;">Option</th>
                                    </tr>
                                </thead>
                               
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
        ajax: '{!! route('users.data') !!}',
        columnDefs:[
            {
                targets: 4,
                title:'Action',
                orderable:false,
                render: function(data,type,full,meta){
                    return '  <a class="btn btn-sm btn-primary" href="/User/detail/'+full.id+'">Détail </a>'
                }
            }
        ],
        columns: [
            
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'status', name: 'status'},
        ]
    });
});
</script>

@endsection