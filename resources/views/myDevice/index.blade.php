@extends('layouts.informathic')
@section('content')
<div class="row">
<div class="col-12 text-center">
                <div class="dashboard_image">
                    <h1 class="brand_device mt-5">Vos appareils</h1> 
                </div>
            </div>
    <div class="col-12">
   
        <div class="card mycard">
           
            <div class="card-body ">
            <form action="{{url('search/device')}}">
                <div class="row">
                         <div class="col-10">
                            <input type="search" class="form-control"  name="search" placeholder="Rechercher une commande par nom de produit...">
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
                                <th scope="col" class="text-white">Demande de service</th>
                                <th scope="col" class="text-white">Statut</th>
                                <th scope="col" class="text-white">Remarques</th>
                                <th scope="col" class="text-white" >Option</th>
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
                                            @if($device->admin_status =='Appareil accepté')
                                            <td><span class="badge bagde-sm bg-dark">{{$device->admin_status}}</span></td>
                                            @elseif($device->admin_status =='Reçu')
                                            <td><span class="badge bagde-sm bg-primary">{{$device->admin_status}}</span></td>
                                            @elseif($device->admin_status =='en cours')
                                            <td><span class="badge bagde-sm bg-secondary">{{$device->admin_status}}</span></td>
                                            @elseif($device->admin_status =='SALLE DATTENTE')
                                            <td><span class="badge bagde-sm bg-warning">{{$device->admin_status}}</span></td>
                                            @elseif($device->admin_status =='Réparé')
                                            <td><span class="badge bagde-sm bg-primary">{{$device->admin_status}}</span></td>
                                            @elseif($device->admin_status =='Retour au client')
                                            <td><span class="badge bagde-sm bg-success">{{$device->admin_status}}</span></td>
                                            @else
                                            <td><span class="badge bagde-sm" style="background: #FF7F50">{{$device->admin_status}}</span></td>
                                            @endif

                                    <td>
                                        <a href="{{url('/Parcel/Note/'.$device->id)}}">
                                            <button type="button" class="btn btn-sm btn-warning">Remarques</button>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-sm" role="group" aria-label="Button group with nested dropdown">
                                            <a href="{{url('/Parcel/Detail/'.$device->id)}}">
                                                <button type="button" class="btn btn-primary btn-sm"> Voir</button>
                                            </a>
                                        </div>
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