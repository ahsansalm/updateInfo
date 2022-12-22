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


                <div class="row  text-center">
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
            </div>
        </div>
    </div>
</div>
@endsection