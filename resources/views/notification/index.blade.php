@extends('layouts.informathic')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="col-12 text-center">
                <div class="dashboard_image">
                    <h1 class="brand_device mt-5">Notification</h1> 
                </div>
            </div>
            <div class="card-body">
                    <table class="table mt-2">
                        <thead style="background: rgb(12, 23, 65);">
                            <tr>
                                <th scope="col" class="text-white">#</th>
                                <th scope="col" class="text-white">Des marques</th>
                                <th scope="col" class="text-white">Produit</th>
                                <th scope="col" class="text-white">bénéficier à</th>
                                <th scope="col" class="text-white" >Icône</th>
                                <th scope="col" class="text-white" >Statut</th>
                                <th scope="col" class="text-white" >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                                @foreach($ProblemReply as $device)
                                    <tr>
                                        <th scope="row"><b class="text-dark">{{$i++}}</b></th>
                                        <td><b class="text-dark">{{$device->product->marks}}</b></td>
                                        <td>{{$device->product->product}}</td>
                                        <td>{{$device->product->serviceRequest}}</td>
                                        <td>{{$device->icon}}</td>
                                        @if($device->status =='Nouveau')
                                        <td><span class="badge bg-danger">{{$device->status}}</span></td>    
                                        @else
                                        <td><span class="badge bg-success">{{$device->status}}</span></td>    
                                        @endif
                                        <td>
                                            <a href="{{url('/notification/detail/'.$device->productId)}}">
                                                <button type="button" class="btn btn-primary btn-sm">Suite</button>
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