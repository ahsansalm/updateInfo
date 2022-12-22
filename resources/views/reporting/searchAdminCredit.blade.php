@extends('layouts.informathic2')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

<div class="row">
    <div class="col-12 text-center">
        <div class="dashboard_image">
            <h1 class="brand_device mt-5">Recherche par date Admin Crédits</h1> 
        </div>
    </div>
</div>


<form action="{{url('/search/admin/credits')}}">
    <div class="row my-3 text-dark">
        <div class="col-md-5">
            <label for=""><b>Partir de la date *</b></label>
            <input type="date" class="form-control" name="from_date" >
        </div>

        <div class="col-md-5">
            <label for=""><b>À ce jour *</b></label>
            <input type="date" id="to_date" class="form-control"  name="to_date" >
        </div>

        <div class="col-md-2  mt-4 ">                            
            <button type="submit" style="margin-top:5px;" class=" btn btn-primary btn-block">Chercher</button>
        </div>

        <div class="col-md-3 mt-5">
            <a href="{{url('/reporting')}}">
                <button type="button" class="default-btn prev-step btn-block btn-secondary">Retour</button>
            </a>
        </div>
    </div>
</form>

    </div>
</div>





@endsection