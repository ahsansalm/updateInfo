@extends('layouts.informathic3')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-12 text-center">
                        <div class="dashboard_image" >
                            <h1 class="brand_device mt-5">Votre historique de crédits</h1> 
                        </div>
                    </div>


                    <div class="col-md-4 mt-2">
                        <div class="card card_back-con">
                            <div class="card-body ">
                                <h4>Crédits d'achat:<span class="badge bg-primary float-right">{{$total}}</span></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mt-2">
                        <div class="card card_back-con">
                            <div class="card-body ">
                                <h5>Crédits utilisateur: <span class="badge bg-danger float-right">{{$used}}</span></h5>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4 mt-2">
                        <div class="card card_back-con">
                            <div class="card-body ">
                                <h4>Crédits restants: <span class="badge bg-success  float-right">{{$remain}}</span></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6" style="border-right: 2px solid black;">
                            <h3 class="text-center text-dark">Détail des crédits d'achat</h3>
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


                    <div class="col-md-6">
                        <h3 class="text-center text-dark">Détail des crédits utilisés</h3>
                        <table class="table mt-2" >
                            <thead style="background: rgb(12, 23, 65);">
                                <tr>
                                    <th scope="col" class="text-white">#</th>
                                    <th scope="col" class="text-white">Produit</th>
                                    <th scope="col" class="text-white">Service</th>
                                    <th scope="col" class="text-white">Montante</th>
                                    <th scope="col" class="text-white">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                    @foreach($remain_data as $remains)
                                            <tr>
                                                <th scope="row"><b class="text-dark">{{$i++}}</b></th>
                                                <td><b class="text-dark">{{$remains->product}}</b></td>
                                                <td>{{$remains->service}}</td>
                                                <td>{{$remains->amount}}</td>
                                                <td>{{$remains->created_at}}</td>
                                            </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <a href="{{url('/SupportWallet')}}">
                            <button type="button" class="default-btn prev-step btn-block btn-secondary">Retour</button>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection