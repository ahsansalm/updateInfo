@extends('layouts.informathic3')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="col-12 text-center">
                <div class="dashboard_image" >
                    <h1 class="brand_device mt-5">Votre historique de crédits</h1> 
                </div>
            </div>
            <div class="card-body">
            <!-- <form action="{{url('search/quote')}}">
                <div class="row">
                       <div class="col-10">
                            <input type="search" class="form-control"    name="search" placeholder="Rechercher une commande par nom de produit...">
                        </div>
                        <div class="col-2">
                         <button type="submit" class="btn btn-block btn-primary">Chercher</button>

                        </div>
                    </div>
               </form> -->
                    <table class="table mt-2">
                        <thead style="background: rgb(12, 23, 65);">
                            <tr>
                                <th scope="col" class="text-white">#</th>
                                <th scope="col" class="text-white">ID de paiement</th>
                                <th scope="col" class="text-white">Montant</th>
                                <th scope="col" class="text-white">Devise</th>
                                <th scope="col" class="text-white">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                                @foreach($payment as $device)
                                    <form action="{{url('/quotes/value/'.$device->id)}}" method='POST'>
                                        @csrf
                                        <tr>
                                            <th scope="row"><b class="text-dark">{{$i++}}</b></th>
                                            <td><b class="text-dark">{{$device->payment_id}}</b></td>
                                            <td>{{$device->amount}}</td>
                                            <td>{{$device->currency}}</td>
                                            <td>{{$device->created_at}}</td>
                                        </tr>
                                    </form>
                                @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <a href="{{url('/SupportWallet')}}">
            <button type="button" class="default-btn prev-step btn-block btn-secondary">Retour</button>
        </a>
    </div>
    </div>

@endsection