@extends('layouts.informathic')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="col-12 text-center">
                <div class="dashboard_image" >
                    <h1 class="brand_device mt-5">Voir mes commandes en attente</h1> 
                </div>
            </div>
            <div class="card-body">
            <form action="{{url('search/norapproved')}}">
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
                                <th scope="col" class="text-white">Des marques</th>
                                <th scope="col" class="text-white">Produit</th>
                                <th scope="col" class="text-white"> Demande de service</th>
                                <th scope="col" class="text-white">Prix</th>
                                <th scope="col" class="text-white">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($devices as $device)
                                <tr>
                                    <th scope="row"><b class="text-dark">{{$i++}}</b></th>
                                    <td><b class="text-dark">{{$device->marks}}</b></td>
                                    <td>{{$device->product}}</td>
                                    <td>{{$device->servicedata->service}}</td>
                                    <td>{{$device->parcel->totalPrice}}</td>
                                    
                                      @if($device->status =='en attendant')
                                            <td><span class="badge bagde-sm"style="background: #FF7F50">{{$device->status}}</span></td>
                                            @else
                                            <td><span class="badge bagde-sm bg-danger">{{$device->status}}</span></td>
                                            @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    </div>
@endsection