@extends('layouts.informathic')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="col-12 text-center">
                <div class="dashboard_image" >
                    <h1 class="brand_device mt-5">Voir ma facture</h1> 
                </div>
            </div>
            <div class="card-body">
            <form action="{{url('search/bill')}}">
                <div class="row">
                       <div class="col-10">
                            <input type="search" class="form-control"   name="search" placeholder="Rechercher une commande par nom de produit...">
                        </div>
                        <div class="col-2">
                         <button type="submit" class="btn btn-block btn-primary">Chercher</button>

                        </div>
                    </div>
               </form>
                    <table class="table mt-2">
                        <thead style="background: rgb(12, 23, 65);">
                            <tr>
                                <th scope="col" class="text-white">#</th>
                                <th scope="col" class="text-white">Titre</th>
                                <th scope="col" class="text-white">Prix ​​total</th>
                                <th scope="col" class="text-white">Date</th>
                                <th scope="col" class="text-white">Statut</th>
                                <th scope="col" class="text-white">Payer Statut</th>
                                <th scope="col" class="text-white">Payer</th>
                                <th scope="col" class="text-white" style="width: 80px;">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($invoices as $invoice)
                                <tr>
                                    <th scope="row"><b class="text-dark">{{$i++}}</b></th>
                                    <td>{{$invoice->neww->product}}</td>
                                    <td><b class="text-dark">{{$invoice->totalPrice}}</b></td>
                                    <td>{{$invoice->date}}</td>
                                    @if($invoice->status =='Approuvé')
                                    <td><span class="badge badge-success">{{$invoice->status}}</span></td>
                                      @elseif($invoice->status =='en attendant')
                                        <td><span class="badge" style="background: #FF7F50">{{$invoice->status}}</span></td>
                                    @else
                                    <td><span class="badge badge-danger">{{$invoice->status}}</span></td>
                                    @endif

                                    @if($invoice->payStatus =='Payé')
                                    <td><span class="badge badge-primary">{{$invoice->payStatus}}</span></td>
                                    @else
                                    <td><span class="badge badge-danger">{{$invoice->payStatus}}</span></td>
                                    @endif
                                    <td>
                                            <a href="#myModal"  data-toggle="modal" >
                                                <button type="button" class="btn btn-success btn-sm">Payer</button>
                                            </a>


                                                                                        <!-- custom delte button -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<div class="icon-box">
				    <i class="fa fa-check ml-2" style="font-size:48px;color:red"></i>
				</div>						
				<h4 class="modal-title w-100">Êtes-vous sûr?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                
                <a href="{{url('/Mybill/Payer/'.$invoice->id)}}">
                        <button type="button" class="btn btn-success">Payer</button>
                    </a>

                
			</div>
		</div>
	</div>
</div> 
<!-- end custom delte button -->



                                    </td>

                                    <td>
                                            <a href="{{url('/Mybill/Detail/'.$invoice->id)}}">
                                                <button type="button" class="btn btn-outline-primary btn-sm"><i style="font-size: 16px;" class="fa fa-eye pl-2"></i></button>
                                            </a>
                                    </td>
                                </tr>


                                
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    </div>
@endsection