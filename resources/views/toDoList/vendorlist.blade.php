@extends('layouts.informathic2')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<!-- custom delte button -->
<!-- <div id="myModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<div class="icon-box">
				    <i class="fa fa-warning ml-2" style="font-size:48px;color:red"></i>
				</div>						
				<h4 class="modal-title w-100">Êtes-vous sûr?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>Voulez-vous supprimer votre service ?</p>
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                
               
			</div>
		</div>
	</div>
</div>  -->
<!-- end custom delte button -->

<div class="row">
    <div class="col-12 text-center">
        <div class="dashboard_image">
            <h1 class="brand_device mt-5"> Liste de fournisseurs</h1> 
        </div>
    </div>
    
    <div class="col-lg-12 mt-3">
        <div class="card">
            <div class="card-header">
            Ajouter un nouveau fournisseur
            </div>
            <div class="card-body">
                <form action="{{url('/add/vendor')}}" method="POST" id="form" enctype="multipart/form-data">
                @csrf
                <table class="table text-dark table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">Nom *</th>
                            <th scope="row">La description *</th>
                            <th scope="row">Lien *</th>
                            <th scope="row">Action</th>
                        </tr>
                        <tr>
                            <th scope="row">
                                <input type="text" name="name" id="name" class="form-control">
                                <p id="p1" class="text-danger"></p>

                            </th>
                            <td>
                                <input type="text" name="descrip" id="descrip" class="form-control">
                                <p id="p2" class="text-danger"></p>
                            </td>
                            <td>
                                <input type="text" name="link" id="link" class="form-control">
                                <p id="p3" class="text-danger"></p>
                            </td>
                            <td> <button type="submit" class="btn btn-primary" id="submit2">Ajouter</button></td>
                        </tr>
                        <tr>
                        </tr>
                    </tbody>
                </table>
                   
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 text-right">
        <a href="{{url('vendorListPDF')}}">
            <button type="button" class="btn btn-sm btn-success float-right mt-2">Exporter PDF</button>
        </a>
    </div>
    <div class="col-lg-12 mt-3">
        <div class="card">
            <div class=".card-body">
                <table class="table table-bordered w-100 text-dark" id="users-table">
                    <thead class="card-header">
                        <tr>
                            <th>Identifiant</th>
                            <th>Nom</th>
                            <th>Créé à</th>
                            <th>Action</th>
                            <th>Éditer</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>



    <!-- <div class="col-md-2 mb-3">
        <a href="{{url('/configuration')}}">
            <button type="button" class="default-btn btn-block btn-secondary prev-step">
        Retour
    </div> -->
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
        ajax: '{!! route('vendorlist.data') !!}',
        columnDefs:[
            {
                targets: 3,
                title:'Action',
                orderable:false,
                render: function(data,type,full,meta){
                    return '<a class="btn btn-sm btn-primary fa fa-bookmark-o " style="font-size:18px;" href="/vendor/fav/'+full.id+'"> </a> <a class="btn btn-sm btn-info " href="/vendor/detail/'+full.id+'"> Détail</a>   '
                },
            
            },
            
            {
                targets: 4,
                title:'Edit',
                orderable:false,
                render: function(data,type,full,meta){
                    return '<a class="btn btn-sm btn-outline-primary " href="/vendor/edit/page/'+full.id+'">Éditer </a> <a class="btn btn-sm btn-outline-danger " href="/vendor/delete/'+full.id+'">Effacer </a>  '
                },
            
            }
        ],

        columns: [
            
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'link', name: 'link' },
        ]
    });
});
    $('#submit2').click(function(){
        var name = $("#name").val();
        var descrip = $("#descrip").val();
        var link = $("#link").val();
       
        if(name.length == "")
          {
            $("#p1").text("Titre requis");
            $("#name").focus();
            return false;
          }

        else if(descrip.length == "")
          {
            $("#p2").text("Descriptif requis");
            $("#descrip").focus();
            return false;
          }
          else if(link.length == "")
          {
            $("#p3").text("Lien requis");
            $("#link").focus();
            return false;
          }
          else
          {
                return true;
              }
    });
    
</script>


@endsection