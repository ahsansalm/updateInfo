@extends('layouts.informathic')
@section('content')
<div class="bg-white border rounded">
    <div class="card">
        <div class="card-body p-5">
            <div class="row ">
                <div class="col-12 text-center">
                    <i class="fa fa-check-circle " style="font-size: 120px; color: #0C1741!important"></i>
                    <h5 class="mt-2">Nous avons créé votre demande d'assistance</h5>
                    <hr>
                </div>
               
                <div class="col-12 mt-3 text-center">
                    <h6>Vous avez le numéro d'assistance "2148", un technicien Informathic étudiera votre demande.</h6>
                    <p>Lien pour accéder à ma demande d'assistance</p>
                    
                </div>
                <div class="col-md-6 mt-md-5 mt-3">
                    <a href="/SendParcel">
                        <button type="button" class=" btn default-btn btn-block prev-step ">Retour à la page d'envoi de colis</button>
                    </a>
                </div>
                <div class="col-md-6 mt-md-5 mt-1">
                    <a href="/MySupport">
                        <button type="button" class="  btn default-btn btn-block next-step ">Accéder à mon billet</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection