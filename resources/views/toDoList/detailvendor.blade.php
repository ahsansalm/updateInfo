@extends('layouts.informathic3')
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
            <h1 class="brand_device mt-5">Détail du vendeur</h1> 
        </div>
    </div>
    
    <div class="col-lg-12 mt-3">
        <div class="card">
            <div class="card-header">
            Détail du vendeur
            </div>
            <div class="card-body">
                <form action="" method="POST" id="form" enctype="multipart/form-data">
                @csrf
                <table class="table text-dark table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">Nom *</th>
                            <th scope="row">La description *</th>
                            <th scope="row">Lien *</th>
                            <th scope="row">Allez sur le lien *</th>
                           
                        </tr>
                        <tr>
                            <th scope="row">
                                <input type="text" name="name" disabled id="name" value="{{$vendor->name}}" class="form-control">
                                <p id="p1" class="text-danger"></p>

                            </th>
                            <td>
                                <input type="text" name="descrip" disabled id="descrip" value="{{$vendor->descrip}}" class="form-control">
                                <p id="p2" class="text-danger"></p>
                            </td>
                            <td>
                                <input type="text" name="link" disabled id="link" value="{{$vendor->link}}" class="form-control">
                                <p id="p3" class="text-danger"></p>
                            </td>
                            <td>
                                <a href="{{$vendor->link}}" target="_blank">
                                    <h6  class="pt-2">Cliquez sur moi</h6>
                                </a>
                            </td>
                            
                        </tr>
                        <tr>
                        </tr>
                    </tbody>
                </table>
                   
                </form>
            </div>
        </div>
    </div>

 



    <div class="col-md-2 mb-3">
        <a href="{{url('/vendorlist')}}">
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


$('#submit2').click(function(){
        var title = $("#title").val();
        var descrip = $("#descrip").val();
       
        if(title.length == "")
          {
            $("#p1").text("Titre requis");
            $("#title").focus();
            return false;
          }

        else if(descrip.length == "")
          {
            $("#p2").text("Descriptif requis");
            $("#descrip").focus();
            return false;
          }
          else
          {
                return true;
              }
    });
    
</script>


@endsection