@extends('layouts.informathic')
@section('content')
<div class="row text-dark">
    <div class="col-12 text-center">
        <div class="dashboard_image">
            <h1 class="brand_device mt-5">Portefeuille de soutien
            </h1>
        </div>
    </div>




    <div class="col-lg-4 mt-4">
        <div class="card">
           <div class="card-header" style="background: #0C1741!important; color:white;">
                <h4>Supporter Portfolio</h4>
            </div>
            <div class="card-body">
                 <h2 class="my-3 text-center">{{ $payment->credits }} Credits</h2>
                 
                <h5>Votre portefeuille est vide, vous devez recharger votre portefeuille, pour pouvoir demander une assistance à distance
                    <br><br>
                    Votre portefeuille vous permet d'utiliser l'assistance à distance
                </h5>
                <div class="row">
                    <div class="col">
                        <a href="{{url('/MyBill')}}">
                            <button type="button" class="btn btn-block next-step "><b>Utiliser l'assistance à distance</b></button>
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{url('/SupportWallet/Credits')}}">
                            <button type="button" class="btn btn-block next-step " ><b>Historique d'utilisation du crédit</b></button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="col-lg-8 mt-4">
        <div class="card">
           <div class="card-header" style="background: #0C1741!important; color:white;">
                <h4>Refil</h4>
            </div>
            <div class="card-body">
                <h2 class="my-3 text-center">Recharger mon portefeuille</h2>
                <h5>Vous pouvez recharger votre portefeuille client via notre parent PayPal
                <br><br>
                   En cliquant sur les boutons vous serez redirigé vers la page sécurisée et cryptée de PayPal où vous pourrez effectuer votre paiement en ligne
                <br><br>
                Seul PayPal conserve les données relatives à votre carte de crédit. Informathic ne stocke pas que des données bancaires dans sa base de données
                </h5>
                <!-- <div class="row justify-content-center mt-2">
                    <div class="col-2">
                        <img src="{{asset('img/download.png')}}" class="img-fluid" alt="">
                    </div>
                    <div class="col-2">
                        <img src="{{asset('img/download1.png')}}" class="img-fluid" alt="">
                    </div>
                    <div class="col-2">
                        <img src="{{asset('img/download2.png')}}" class="img-fluid" alt="">
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-lg-4">
                    <form action="{{route('payment')}}" method="POST">
                    @csrf
                        <input type="hidden" name="amount" value="20">
                        <input type="hidden" name="credits" value="20">
                        <button type="submit" class="btn btn-block next-step "><b>Ajouter 20 crédits</b></button>
                    </form>
                    </div>
                    <div class="col-lg-4">
                    <form action="{{route('payment')}}" method="POST">
                    @csrf
                        <input type="hidden" name="amount" value="50">
                          <input type="hidden" name="credits" value="50">
                        <button type="submit" class="btn btn-block next-step "><b>Ajouter 50 crédits</b></button>
                    </form>
                    </div>
                    <div class="col-lg-4">
                    <form action="{{route('payment')}}" method="POST">
                    @csrf
                        <input type="hidden" name="amount" value="100">
                          <input type="hidden" name="credits" value="100">
                        <button type="submit" class="btn btn-block next-step "><b>Ajouter 100 crédits</b></button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <div class="col-12 mt-4">
        <div class="row text-white">
            <div class="col-lg-4 mt-2">
                <div class="card bg-danger" style="border-radius: 20px;">
                    <div class="card-header1 border-bottom py-2 text-center" >
                        <h4>20 Crédits</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="my-3 text-center" style="font-size: 55px;">20 <span style="font-size: 75px;">€</span></h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mt-2">
                <div class="card bg-dark" style="border-radius: 20px;">
                    <div class="card-header1 border-bottom py-2 text-center" >
                        <h4>50 Crédits</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="my-3 text-center"  style="font-size: 55px;">50 <span style="font-size: 75px;">€</span></h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mt-2">
                <div class="card bg-success" style="border-radius: 20px;">
                    <div class="card-header1 border-bottom py-2 text-center" >
                        <h4>100 Crédits</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="my-3 text-center" style="font-size: 55px;">100 <span style="font-size: 75px;">€</span></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
