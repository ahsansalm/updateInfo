@extends('layouts.informathic3')
@section('content')
<div class="row text-dark">
    <div class="col-12">
        <div class="card">
            <div class="dashboard_image" >
                <h1 class="text-center mt-5">Détail du montant du paiement</h1> 
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
                            <td><h6>Vos notes:</h6></td>
                            <td> <p id="putBrand">{{$bills->marks}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td><h6>Ton produit:</h6></td>
                            <td><p id="putProduct">{{$bills->product}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td><h6>Votre avantage:</h6></td>
                            <td><p id="putProduct">{{$bills->servicedata->service}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">4</th>
                            <td><h6>Prix ​​du produit:</h6></td>
                            <td>   <p id="putBenifit">{{$bills->totalPrice}}</p></td>
                            </tr>
                        </tbody>
                    </table>
                

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        
                    
    <div class="col-md-6">
                    
                    <a href="{{url('/MyBill')}}">
                        <button type="button" class="btn btn-block btn-secondary prev-step">Back</button>
                    </a>
                </div>


                <div class="col-md-6">

                    <form action="{{url('/Mybill/Payer/'.$bills->id)}}">
                        <input type="hidden" value="{{$bills->totalPrice}}" name="price">
                            <button type="submit" class="btn btn-block btn-secondary prev-step">Payez maintenant</button>
                    </form>
                </div>

    </div>
</div>
@endsection