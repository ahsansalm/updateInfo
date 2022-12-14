@extends('layouts.informathic')
@section('content')
<div class="row">
    <div class="col-12 text-center">
        <div class="dashboard_image">
            <h1 class="brand_device mt-5">Configuration</h1> 
        </div>
    </div>
</div>
<div class="row my-3">
    <div class="col-md-6">
        <a href="{{url('/configuration/Marque')}}"> 
            <div class="card card_back-con">
                <div class="card-body ">
                    <h3>Marque</h3>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-6">
        <a href="{{url('/configuration/Produit')}}"> 
            <div class="card card_back-con">
                <div class="card-body ">
                    <h3>Produit</h3>
                </div>
            </div>
        </a>
    </div>

    <!-- <div class="col-md-4">
        <a href="{{url('/configuration/Services')}}"> 
            <div class="card card_back-con">
                <div class="card-body ">
                <h3>Services</h3>
                </div>
            </div>
        </a>
    </div> -->
</div>
@endsection