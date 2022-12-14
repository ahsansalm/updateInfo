@extends('layouts.informathic2')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="col-12 text-center">
                <div class="dashboard_image" >
                    <h1 class="brand_device mt-5">Voir mes devis actifs</h1> 
                </div>
            </div>
            <div class="card-body">
            <form action="{{url('search/quote')}}">
                <div class="row">
                     <div class="col-10">
                            <input type="search" class="form-control"  value="{{$search}}"   name="search" placeholder="Rechercher une commande par nom de produit...">
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
                                <th scope="col" class="text-white">Prix</th>
                                <th scope="col" class="text-white" style="width: 80px;">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                                @foreach($devices as $device)
                                    <form action="{{url('/quotes/value/'.$device->id)}}" method='POST'>
                                        @csrf
                                        <tr>
                                            <th scope="row"><b class="text-dark">{{$i++}}</b></th>
                                            <td><b class="text-dark">{{$device->neww->marks}}</b></td>
                                            <td>{{$device->neww->product}}</td>
                                            <td>{{$device->servicedata->service}}</td>
                                            @if($device->status =='Approved')
                                            <td><span class="badge bagde-sm bg-success">{{$device->status}}</span></td>
                                            @else
                                            <td><span class="badge bagde-sm bg-danger">{{$device->status}}</span></td>
                                            @endif
                                            <td><b>{{$device->quotePrice}}</b></td>
                                            <td hidden><input type="text" value="{{$device->quotePrice}}" name="Price">{{$device->quotePrice}}</td>
                                            <td>
                                            @if($device->status =='Approved')
                                            <button type="submit" class="btn btn-sm btn-primary">Ordre Now</button>
                                            @else
                                            <button type="button" class="btn btn-sm btn-danger">Refuse</button>
                                            @endif                    
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