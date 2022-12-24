@extends('layouts.informathic2')
@section('content')
<div class="row text-dark">
    <div class="col-12">
        <div class="card">
            <div class="dashboard_image">
                <h1 class="text-center mt-5">Détails de l'utilisateur</h1> </button>
                    </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-custom">
                    <tr >
                        <th class="text-white" scope="col">#</th>
                        <th class="text-white" scope="col">La description</th>
                        <th class="text-white" scope="col">Informations</th>
                        <th class="text-white" scope="col">#</th>
                        <th class="text-white" scope="col">La description</th>
                        <th class="text-white" scope="col">Informations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td><h6>Nom de famille :</h6></td>
                        <td><p id="putBrand">{{$user->profile->lastname}}</p></td>
                        <th scope="row">6</th>
                        <td><h6>Téléphoner :</h6></td>
                        <td><p id="putBrand">{{$user->profile->phone}}</p></td>
                        </tr>

                        <tr>
                        <th scope="row">2</th>
                        <td><h6>Prénom :</h6></td>
                        <td><p id="putBrand">{{$user->profile->firstname}}</p></td>
                        <th scope="row">7</th>
                        <td><h6>Ville:</h6></td>
                        <td><p id="putBrand">{{$user->profile->town}}</p></td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td><h6>E-mail :</h6></td>
                        <td><p id="putBenifit">{{$user->email}}</p></td>
                        <th scope="row">8</th>
                        <td><h6>Vos préférences de contact avec nos techniciens :</h6></td>
                        <td><p id="putBrand">{{$user->profile->preferenceNew}}</p></td>
                        </tr>
                        <tr>

                        <th scope="row">4</th>
                        <td><h6>code postal :</h6></td>
                        <td><p id="putBenifit">{{$user->profile->postal}}</p></td>
                        <th scope="row">9</th>
                        <td><h6>A quelle tranche horaire pouvons-nous vous contacter :</h6></td>
                        <td><p id="putBrand">{{$user->profile->pre5}} to {{$user->profile->pre_to}}</p></td>
                        </tr>
                        <tr>

                        <th scope="row">5</th>
                        <td><h6>Adresse :</h6></td>
                        <td><p id="putBenifit">{{$user->profile->address}}</td>
                        <th scope="row">10</th>
                        <td><h6>Crédits:</h6></td>
                        <td><p id="putBrand">{{$amount->credits}}</p></td>
                        </tr>
                        <tr>
                       
                    </tbody>
                    </table>


                <div class="row  text-center pb-5" style="border-bottom: 2px solid black;">
                    <div class="col-md-4">
                        <a href="{{url('/adminUser')}}">
                            <button type="button" class="default-btn btn-block btn-secondary prev-step">
                        Retour
                    </div>
                    <div class="col-md-4">
                        <a href="{{url('/user/disabled/'.$user->id)}}">
                            <button type="button" class="default-btn btn-block btn-secondary prev-step">
                            Désactiver l'utilisateur
                    </div>
                    <div class="col-md-4">
                        <a href="{{url('/user/active/'.$user->id)}}">
                            <button type="button" class="default-btn btn-block btn-secondary prev-step">
                            Utilisateur actif
                    </div>
                </div>


                <div class="row">
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
                                                    <td><b class="text-dark"><b class="text-dark">{{$device->payment_id}}</b></td>
                                                    <td><b class="text-dark">{{$device->amount}}</b></td>
                                                    <td><b class="text-dark">{{$device->currency}}</b></td>
                                                    <td><b class="text-dark">{{$device->created_at}}</b></td>
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
                                                <td><b class="text-dark">{{$remains->service}}</b></td>
                                                <td><b class="text-dark">{{$remains->amount}}</b></td>
                                                <td><b class="text-dark">{{$remains->created_at}}</b></td>
                                            </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>




        </div>
    </div>
</div>
@endsection