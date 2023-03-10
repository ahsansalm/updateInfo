@extends('layouts.informathic2')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

<div class="row">
    <div class="col-12 text-center">
        <div class="dashboard_image">
            <h1 class="brand_device mt-5">Chercher par date</h1> 
        </div>
    </div>
</div>


<form action="{{url('/search/all/order')}}">
    <div class="row my-3 text-dark">
        <div class="col-md-5">
            <label for=""><b>Partir de la date *</b></label>
            <input type="date" class="form-control" value="{{$from_date}}" name="from_date" >
        </div>

        <div class="col-md-5">
            <label for=""><b>À ce jour *</b></label>
            <input type="date" id="to_date" class="form-control" value="{{$to_date}}" name="to_date" >
        </div>

        <div class="col-md-2  mt-4 ">                            
            <button type="submit" style="margin-top:5px;" class=" btn btn-primary btn-block">Chercher</button>
        </div>
</form>
        
        <div class="col-md-4 mt-4">
            <div class="card card_back-con">
                <div class="card-body ">
                    <h4>Vente totale:<span class="badge bg-primary float-right"> {{$sale}} €</span></h4>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-4">
            <div class="card card_back-con">
                <div class="card-body ">
                    <h5>Achat total: <span class="badge bg-danger float-right" id="purchase"> {{$purchase}} €</span></h5>
                </div>
            </div>
        </div>


        <div class="col-md-4 mt-4">
            <div class="card card_back-con">
                <div class="card-body ">
                    <h4>Votre bénéfice: <span class="badge bg-success  float-right" id="profit"> {{$profit}} €</span></h4>
                </div>
            </div>
        </div>
        <div class="col-12 text-right">

            <form action="{{url('userOrderSearchPDF')}}">

                <input type="hidden" class="form-control" value="{{$from_date}}" name="from_date" >
                <input type="hidden" id="to_date" class="form-control" value="{{$to_date}}" name="to_date" >


                <button type="submit" class="btn btn-sm btn-success float-right mt-2">Exporter PDF</button>
            </form>
        </div>
        <div class="col-12">
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
                                            <td>{{$device->date}} </td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
        </div>

        <div class="col-md-3 mt-5">
            <a href="{{url('/reporting')}}">
                <button type="button" class="default-btn prev-step btn-block btn-secondary">Retour</button>
            </a>
        </div>
    </div>


    </div>
</div>





@endsection