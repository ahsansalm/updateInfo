@extends('layouts.informathic')
@section('content')
<div class="bg-white border rounded">
    <div class="row no-gutters">
        <div class="col-lg-4">
            <div class="profile-content-left pt-5 pb-3 px-3 px-xl-5">
                
                <div class="contact-info pt-4">
                    <h5 class="text-dark mb-1">Coordonnées</h5>
                <hr class="w-100">
            <form action="{{URL('profile/update/')}}/{{auth()->user()->id}}" method="POST" enctype="multipart/form-data"  >
                @csrf
                    <p class="text-dark font-weight-medium pt-4 mb-2">Adresse e-mail</p>
                    <input type="text" class="form-control"  disabled  id="inputPassword" name="email" value="{{auth()->user()->email}}">
                    <p class="text-dark font-weight-medium pt-4 mb-2">Numéro de téléphone</p>
                    <input type="number" class="form-control" id="inputPassword" name="phone" value="{{auth()->user()->profile->phone}}">
                    <p class="text-dark font-weight-medium pt-4 mb-2">Adresse postale</p>
                    <input type="text" class="form-control" id="inputPassword" name="postal" value="{{auth()->user()->profile->postal}}">
                    <p class="text-dark font-weight-medium pt-4 mb-2">adresse permanente</p>
                    <input type="text" class="form-control" id="inputPassword" name="address" value="{{auth()->user()->profile->address}}">
                    
                    <!--password change option-->
                       <a href="{{url('/change/password')}}">
                        <button type="button" class="btn btn-block next-step" id="passChange" >Changer le mot de passe</button>
                       </a>
                        
                        <!-- <div id="changePass">
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
                        </div> -->
                        
                    <!--end of password-->
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="profile-content-right">
                <div class="dashboard_image">
                    <h1 class="brand_device mt-5 text-center">Editer le profil</h1> 
                </div>    
                <br>            
                <h5 class="text-dark mb-1 ml-3">Renseignements personnels</h5>
                <hr class="w-100">
                    <div class="row">
                        <div class="col-md-8  order-md-1 order-2 px-md-0 pr-5">
                            <div class="form-group row ml-2">
                            <label for="staticEmail" class="col-sm-4 col-form-label text-dark font-weight-medium">Prénom:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="inputPassword" name="firstname" value="{{auth()->user()->name}}">
                                </div>
                            </div>
                            <div class="form-group row ml-2">
                                <label for="inputPassword" class="col-sm-4 col-form-label text-dark font-weight-medium">Nom de famille:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="inputPassword" name="lastname" value="{{auth()->user()->profile->lastname}}">
                                </div>
                            </div>
                            <div class="form-group row ml-2">
                                <label for="inputPassword" class="col-sm-4 col-form-label text-dark font-weight-medium">Ville: </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="inputPassword" name="town" value="{{auth()->user()->profile->town}}">
                                </div>
                            </div>
                            <div class="form-group row ml-2">
                                <label for="inputPassword" class="col-sm-4 col-form-label text-dark font-weight-medium">Code postal: </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="inputPassword" name="code" value="{{auth()->user()->profile->code}}">
                                </div>
                            </div>
                            <div class="form-group row ml-2">
                                <label for="inputPassword" class="col-sm-4 col-form-label text-dark font-weight-medium">Changer la photo:</label>
                                <div class="col-md-8">
                                    <input type="hidden" name="old_image" value="{{auth()->user()->profile->photo}}">
                                    <input type="file"  name="photo" class="form-control">
                                    @error('photo')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row ml-2">
                                    <div class="col-md-4">
                                        <button type="submit" id="submit1" class="btn btn-block next-step">Mise à jour</button>
                                    </div>                                
                            </div>
                        </div>
                        <div class="col-md-3 order-md-2 order-1 d-flex justify-content-center">
                            <img src="{{auth()->user()->profile->photo}}"style="height: 200px; width: 200px;" alt="">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function(){
        $("#changePass").hide();
    $("#passChange").click(function () {
        $("#changePass").show();
    });
   
});
</script>
@endsection