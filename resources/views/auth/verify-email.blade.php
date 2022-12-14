<!DOCTYPE html>
<html lang="en">
<head>
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>InforMathic</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet"/>
  <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />
  <script src="sweetalert2.min.js"></script>
  <link rel="stylesheet" href="sweetalert2.min.css">
  <link href="{{asset('auth/assets/css/custom.css')}}" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="{{asset('auth/assets/plugins/toaster/toastr.min.css')}}" rel="stylesheet" />
  <link href="{{asset('auth/assets/plugins/nprogress/nprogress.css')}}" rel="stylesheet" />
  <link href="{{asset('auth/assets/plugins/flag-icons/css/flag-icon.min.css')}}" rel="stylesheet"/>
  <link href="{{asset('auth/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" />
  <link href="{{asset('auth/assets/plugins/ladda/ladda.min.css')}}" rel="stylesheet" />
  <link href="{{asset('auth/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
  <link href="{{asset('auth/assets/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
  <!-- SLEEK CSS -->
  <link id="sleek-css" rel="stylesheet" href="{{asset('auth/assets/css/sleek.css')}}" />
  <!-- FAVICON -->
  <link href="{{asset('auth/assets/img/favicon.png')}}" rel="shortcut icon" />
  <script src="{{asset('auth/assets/plugins/nprogress/nprogress.js')}}"></script>
</head>

</head>
  <body class="bg-light-gray" id="body">
      <div class="container d-flex flex-column justify-content-between vh-100">
      <div class="row justify-content-center mt-5">
        <div class="col-8">
          <div class="card">
            <div class="card-header" style="background: #0C1741;">
              <div class="app-brand text-center py-3" style="background: #0C1741;">
                  <h4 class="brand-name">Formulaire de connexion</h4>
              </div>
            </div>
            <div class="card-body p-5">

              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row">
                  <div class="form-group col-md-12 mb-4">
                    <input type="email" class="form-control input-lg @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Adresse Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>Mauvais email ou mot de passe. Merci de réessayer :)</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group col-md-12 ">
                    <input type="password" class="form-control input-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="password" placeholder="Mot de passe">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="col-md-12">
                    <div class="d-flex my-2 justify-content-between">
                      <div class="d-inline-block mr-3">
                        <label class="control control-checkbox">Se souvenir de moi
                          <input type="checkbox" />
                          <div class="control-indicator"></div>
                        </label>
                
                      </div>
                      <p><a  style="color: #0C1741;" href="#">Mot de passe perdu ?</a></p>
                    </div>
                  <div class="col-12">
                  <button type="submit" class="btn btn-lg next-step btn-block  mb-4">Connexion</button>
                  </div>
                    <p>Je n'ai pas encore de compte
                      <a style="color: #0C1741;" href="{{url('/register')}}">Creer un compte</a>
                    </p>
                  </div>
                </div>
              </form>

              <div class="alert alert-danger mt-3" role="alert">L'e-mail de vérification a été envoyé</div>
            </div>
          </div>
        </div>
      </div>
    </div>




        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  @if(session('success'))
    <script>
      swal("Bon travail!!", "accédez à l'e-mail et cliquez sur le bouton vérifier l'adresse e-mail", "success");
    </script>
  @endif
  
</body>
</html>