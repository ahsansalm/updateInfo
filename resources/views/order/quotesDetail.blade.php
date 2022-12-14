@extends('layouts.informathic3')
@section('content')
<div class="row">
    <div class="col-12">  
        <form action="{{url('/quotes/approved/'.$device->id)}}" method='POST'>
            @csrf
            <div class="card">
                <div class="dashboard_image">
                    <h1 class="text-center mt-5">Détail des devis</h1> </button>
                        </a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-custom">
                        <tr >
                            <th class="text-white" scope="col">#</th>
                            <th class="text-white" scope="col">Données utilisateur</th>
                            <th class="text-white" scope="col">Informations</th>
                            </tr>
                        </thead>
                        <tbody class="text-dark">
                            <tr>
                            <th scope="row">1</th>
                            <td><h6>Nom d’utilisateur :</h6></td>
                            <td hidden><input type="hidden" value="{{$device->userId}}" name="userId"></td>
                            <td><p>{{$device->user->firstname}} {{$device->user->lastname}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td><h6>E-mail de l’utilisateur:</h6></td>
                            <td><p>{{$device->register->email}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td><h6>Adresse :</h6></td>
                            <td><p>{{$device->user->address}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">4</th>
                            <td><h6>Code postal :</h6></td>
                            <td><p>{{$device->user->postal}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">5</th>
                            <td><h6>Numéro de téléphone :</h6></td>
                            <td><p>{{$device->user->phone}}</p></td>
                            </tr>
                        </tbody>
                    </table>



                    <table class="table">
                        <thead class="thead-custom">
                        <tr >
                            <th class="text-white" scope="col">#</th>
                            <th class="text-white" scope="col">Données produit</th>
                            <th class="text-white" scope="col">Informations</th>
                            </tr>
                        </thead>
                        <tbody class="text-dark">
                            
                            <tr>
                            <th scope="row">1</th>
                            <td><h6>Code produit:</h6></td>
                            <td><p>{{$device->product_code}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td hidden id="userId">{{$device->id}}</td>
                            <td><h6>Marques :</h6></td>
                            <td><p>{{$device->marks}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td><h6>Produit:</h6></td>
                            <td><p>{{$device->product}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">4</th>
                            <td><h6>Demande de service :</h6></td>
                            <td>{{$device->servicedata->service}}</td>
                            </tr>
                            <tr>
                            <th scope="row">5</th>
                            <td><h6>Commandez par l’intermédiaire de:</h6></td>
                            <td><p>{{$device->shipment}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">6</th>
                            <td><h6>Prix :</h6></td>
                            <td>{{$device->servicedata->prices}}</td>
                            </tr>

                            <th scope="row">7</th>
                            <td><h6>Entrez le prix * :</h6></td>
                            <td>
                                <input type="text" value="{{$device->parcel->quotePrice}}" class="form-control" name="quotePrice">
                                    @error('quotePrice')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </td>
                            </tr>

                            <tr>
                            <th scope="row">8</th>
                            <td><h6>Mot de passe ou code PIN :</h6></td>
                            <td><p>{{$device->pin}}</p></td>
                            </tr>

                            <tr>
                            <th scope="row">9</th>
                            <td><h6>Modèle de mot de passe :</h6></td>
                            <td><p>{{$device->pattern}}</p></td>
                            </tr>

                            <th scope="row">10</th>
                            <td><h6>Code à barre :</h6></td>
                            <td>
                            @php
                                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                            @endphp
                            {!! $generator->getBarcode($device->product_code, $generator::TYPE_CODE_128) !!}

                            </td>
                            </tr>
                        </tbody>
                    </table>
                

                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{url('/userQuotes')}}">
                                    <button type="button" class="default-btn prev-step btn-block btn-secondary">Retour</button>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <button type="button" class="default-btn next-step  btn-block btn-primary" id="refuse" >Refuser</button>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="default-btn next-step  btn-block btn-primary">Approved</button>
                            </div>

                            
                        </div>






                
            </div>
        
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function(){
    // data submit using ajax
    $("#refuse").click(function () {
        var userId = $("#userId").text();
        console.log(userId)
        $.ajax({
                    url: '{{ url('/quote/refuse') }}',
                    type:'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data:{'userId':userId},
                        success:function(success){   
                            if(success){
                                toastr.success(success.message,'Refus de commande!');
                                window.location.href = '/userQuotes';
                                
                            }              
                        }           
        }); 
    }); 



});
</script>

@endsection