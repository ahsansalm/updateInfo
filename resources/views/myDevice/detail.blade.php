@extends('layouts.informathic2')
@section('content')
<div class="row text-dark">
    <div class="col-12">
        <div class="card">
            <div class="dashboard_image">
                <h1 class="text-center mt-5">Détail du colis</h1> </button>
                    </a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-custom">
                    <tr >
                        <th class="text-white" scope="col">#</th>
                        <th class="text-white" scope="col">La description</th>
                        <th class="text-white" scope="col">Informations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td><h6>Vos notes :</h6></td>
                        <td><p id="putBrand">{{$devices->marks}}</p></td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td><h6>Ton produit:</h6></td>
                        <td><p id="putProduct">{{$devices->product}}</p></td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td><h6>Prestation demandée :</h6></td>
                        <td><p id="putBenifit">{{$devices->servicedata->service}}</p></td>
                        </tr>
                        <tr>
                        <th scope="row">4</th>
                        <td><h6>Informations complémentaires :</h6></td>
                        <td><p id="putBenifit">{{$devices->shipment}}</p></td>
                        </tr>
                        <tr>
                        <th scope="row">5</th>
                        <td><h6>Problèmes détectés :</h6></td>
                        <td><p id="putBenifit">{{$devices->information}}</p></td>
                        </tr>
                        <tr>
                        <th scope="row">6</th>
                        <td> <h6>Adresse:</h6></td>
                        <td><p class="text-dark" id="address">{{auth()->user()->name}}</p><br>
                                            <p>{{auth()->user()->profile->postal}}</p><br>
                                            <p>{{auth()->user()->profile->code}}</p><br>
                                            <p>{{auth()->user()->profile->phone}}</p></td>
                        </tr>
                        <tr>
                        <th scope="row">7</th>
                        <td>  <h6>Votre choix de retour :</h6></td>
                        <td><p id="putBenifit">{{$devices->problems}}</p></td>
                        </tr>
                        <tr>
                    </tbody>
                    </table>


                <div class="row  text-center mt-5">

                    <div class="col-md-12 text-center">
                        <div class="alert alert-warning" role="alert">
                            <p>Vous pouvez modifier votre adresse dans votre profil.</p>  
                        </div>
                        <div class="alert alert-danger" role="alert">
                            <p>W Attendez notre validation avant d'envoyer. Cela évite à tout le monde de perdre du temps et de l'argent.
                                Nous ne validons pas immédiatement les nouvelles demandes lorsque nous avons trop de demandes à traiter
                                à la fois. Merci pour votre patience.
                            </p> 
                        </div>                                   
                    </div>
                    <div class="col-md-4">
                        <a href="{{url('/MyDevices')}}">
                            <button type="button" class="default-btn btn-block btn-secondary prev-step">
                        Retour
                            </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection