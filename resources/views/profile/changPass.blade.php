@extends('layouts.informathic2')
@section('content')
<div class="bg-white border rounded">
        <div class="col-12 text-center">
                <div class="dashboard_image" >
                    <h1 class="brand_device mt-5">Changer le mot de passe</h1> 
                </div>
        </div>
  <div class="container">
  <div class="row no-gutters">
            <div class="col-12">
                <form action="{{URL('profile/update/password')}}/{{auth()->user()->id}}" method="POST" enctype="multipart/form-data"  >
                @csrf
                    <p class="text-dark font-weight-medium pt-4 mb-2">Mot de passe actuel</p>
                    <input type="text" class="form-control" name="current_password">
                        <p class="text-dark font-weight-medium pt-4 mb-2">nouveau mot de passe</p>
                    <input type="text" class="form-control"    id="passGet" name="new_password" v>
                    @error('new_password')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                        <p class="text-dark font-weight-medium pt-4 mb-2">Confirmez le mot de passe</p>
                    <input type="text" class="form-control"    id="password_confirmation" name="password_confirmation" >
                    @error('password_confirmation')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    <!--end of password-->
            </div>
    </div>
    
    <div class="row mb-5">
                
        <div class="col-md-6">
            <a href="{{url('/MyProfile')}}">
                <button type="button" class="btn btn-block next-step">Retour</button>
            </a>
        </div>
        <div class="col-md-6">
            <button type="submit" id="submit1" class="btn btn-block next-step">Mise à jour</button>
        </div>
    </div>
    
    </form>
  </div>
                       
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection