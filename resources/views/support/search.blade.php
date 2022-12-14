@extends('layouts.informathic2')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="col-12 text-center">
                <div class="dashboard_image" >
                    <h1 class="mt-5">Voir mon support actif</h1> 
                </div>
            </div>
            <div class="card-body">
            <form action="{{url('search/support')}}">
                <div class="row">
                        <div class="col-10">
                            <input type="search" class="form-control"  name="search" value="{{$search}}" placeholder="Ordre de recherche par nom d'utilisateur...">
                        </div>
                        <div class="col-2">
                         <button type="submit" class="btn btn-block btn-primary">Search</button>

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
                                <th scope="col" class="text-white" >Option</th>
                            </tr>
                        </thead>
                        <tbody>
                                @php($i=1)
                                @foreach($supports as $device)
                                    <tr>
                                        <th scope="row"><b class="text-dark">{{$i++}}</b></th>
                                        <td><b class="text-dark">{{$device->marks}}</b></td>
                                        <td>{{$device->product}}</td>
                                        <td>{{$device->servicedata->service}}</td>
                                            @if($device->chat =='Lis')
                                            <td><span class="badge bagde-sm bg-success">{{$device->chat}}</span></td>
                                            @else
                                            <td><span class="badge bagde-sm bg-danger">{{$device->chat}}</span></td>
                                            @endif
                                        <td>
                                            <a href="{{url('/Support/Detail/'.$device->id)}}">
                                                <button type="button" class="btn btn-primary btn-sm">Soutien</button>
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