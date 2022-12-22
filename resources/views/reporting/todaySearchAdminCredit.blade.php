@extends('layouts.informathic2')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

<div class="row">
    <div class="col-12 text-center">
        <div class="dashboard_image">
            <h1 class="brand_device mt-5">Rapport sur le crédit administrateur aujourd'hui</h1> 
        </div>
    </div>
</div>

<div class="row my-3">
    

    <div class="col-md-4">
        <div class="card card_back-con">
            <div class="card-body ">
                <h4>Vente totale:<span class="badge bg-primary float-right">{{$sale}} €</span></h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card_back-con">
            <div class="card-body ">
                <h5>Achat total: <span class="badge bg-danger float-right">{{$purchase}}  €</span></h5>
            </div>
        </div>
    </div>


    <div class="col-md-4">
        <div class="card card_back-con">
            <div class="card-body ">
                <h4>Votre bénéfice: <span class="badge bg-success  float-right">{{$profit}} €</span></h4>
            </div>
        </div>
    </div>
    <div class="col-12 text-right">


        <form action="{{url('todayAdminCreditPDF')}}">
            <input type="hidden" class="form-control" value="{{$search}}" name="search" placeholder="Ordre de recherche par nom d'utilisateur...">
            <button type="submit" class="btn btn-sm btn-success float-right mt-2">Exporter PDF</button>
        </form>



    </div>

    <div class="col-12 mt-3">
            <form action="{{url('today/admin/credit/report/search')}}">
                <div class="row">
                        <div class="col-10">
                            <input type="search" class="form-control" value="{{$search}}" name="search" placeholder="Rechercher une commande par nom de produit...">
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
                                    <th scope="col" class="text-white">Nom d'utilisateur</th>
                                    <th scope="col" class="text-white">Des marques</th>
                                    <th scope="col" class="text-white">Produit</th>
                                    <th scope="col" class="text-white">Demande de service</th>
                                    <th scope="col" class="text-white">Statut</th>
                                    <th scope="col" class="text-white">Prix</th>
                                    <th scope="col" class="text-white">Prix ​​d'achat</th>
                                    <th scope="col" class="text-white">Date</th>
                                </tr>
                            </thead>
                            <tbody id="orderSeaech">
                                @php($i=1)
                                @foreach($devices as $device)
                                    <form>
                                        <tr class="text-dark">
                                            <th scope="row"><b class="text-dark">{{$i++}}</b></th>
                                            <th scope="row" hidden><b class="text-dark">{{$device->id}}</b></th>
                                            <td><b>{{$device->user->firstname}} {{$device->user->lastname}} </b></td>
                                            <td><b class="text-dark">{{$device->neww->marks}}</b></td>
                                            <td>{{$device->neww->product}}</td>
                                            <td>{{$device->servicedata->service}}</td>
                                            <td><span class="badge bagde-sm bg-success">{{$device->status}}</span></td>
                                            <td>{{$device->totalPrice}} €</td>
                                            <td>{{$device->servicedata->purchase_price}} €</td>
                                            <td>{{$device->userCreditDate}} </td>
                                        </tr>
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                            <div class="col-md-3 mt-5">
                                <a href="{{url('/reporting')}}">
                                    <button type="button" class="default-btn prev-step btn-block btn-secondary">Retour</button>
                                </a>
                            </div>

    </div>

</div>


   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function(){
    // data submit using ajax
    $("#searchOrder").keyup(function () {
        var search = $(this).val();
        console.log(search)
        $.ajax({
                    url: '{{ url('/search/today/order') }}',
                    type:'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data:{'search':search},
                        success:function(data){   
                            $('#orderSeaech').html(data);     
                        }           
        }); 
    }); 
});
</script>

@endsection