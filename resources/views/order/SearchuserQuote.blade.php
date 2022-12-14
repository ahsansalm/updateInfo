@extends('layouts.informathic')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="col-12 text-center">
                <div class="dashboard_image">
                    <h1 class="brand_device mt-5">Citation de l'utilisateur</h1>
                     
                </div>
            </div>
            <div class="col-12 text-right">
                <form action="{{url('userQuotePDF')}}">
                            <input type="hidden" class="form-control" value="{{$search}}" name="search" placeholder="Ordre de recherche par nom d'utilisateur...">
                            <button type="submit" class="btn btn-sm btn-success float-right mt-2">Exporter PDF</button>
                    </form>
                </div>
            <div class="card-body">
            <form action="{{url('search/user/quotes')}}">
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
                                    <th scope="col" class="text-white">Image utilisateur</th>
                                    <th scope="col" class="text-white">Des marques</th>
                                    <th scope="col" class="text-white">Produit</th>
                                    <th scope="col" class="text-white">Demande de service</th>
                                    <th scope="col" class="text-white">Statut</th>
                                    <th scope="col" class="text-white">Prix</th>
                                    <th scope="col" class="text-white">Devis Prix</th>
                                    <th scope="col" class="text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @foreach($devices as $device)
                                    <form action="{{url('/quotes/approved/'.$device->id)}}" method='POST'>
                                        @csrf
                                        <tr>
                                            <th scope="row"><b class="text-dark">{{$i++}}</b></th>
                                            <td><b>{{$device->user->firstname}} {{$device->user->lastname}} </b></td>
                                            <td><img src="../../{{$device->user->photo}}  " style="height: 30px; width 20px;" alt=""></td>
                                            <td><b class="text-dark">{{$device->neww->marks}}</b></td>
                                            <td>{{$device->neww->product}}</td>
                                            <td>{{$device->servicedata->service}}</td>
                                            @if($device->status =='Approved')
                                            <td><span class="badge bagde-sm bg-success">{{$device->status}}</span></td>
                                            @elseif($device->status =='Refus')
                                            <td><span class="badge bagde bg-danger">Rufus</span></td>
                                            @else
                                             <td><span class="badge bagde" style="background: #FF7F50">{{$device->status}}</span></td>
                                            @endif
                                            <td>{{$device->totalPrice}}</td>
                                            <td><b class="text-dark">{{$device->quotePrice}}</td>
                                            <td>
                                                <a href="{{url('quotes/detail/'.$device->productId)}}">
                                                <button type="button" class="btn btn-sm btn-primary">Suite</button>
                                               </a>
                                               
                                            </td>
                                        </tr>
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
            </div>
        </div>
    </div>
    </div>
@endsection
