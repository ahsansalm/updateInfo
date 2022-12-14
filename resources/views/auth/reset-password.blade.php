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
        <div class="col-10">
          <div class="card">
            <div class="card-header" style="background: #0C1741;">
              <div class="app-brand text-center py-3" style="background: #0C1741;">
                  <h4 class="brand-name">réinitialiser le mot de passe</h4>
              </div>
            </div>
            <div class="card-body p-5">

              <form  action="{{ route('password.update') }}"method="POST" enctype="multipart/form-data" id="form1">
                @csrf
                <div class="row">

                <input type="hidden" name="token" value="{{$token}}">
                <div class="form-group col-md-12 mb-4">
                <label for="">Entrer l'adresse e-mail*</label>
                    <input type="email" class="form-control input-lg" name="email" id="email" autofocus>
                    <p id="p2" class="text-danger"></p>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>Mauvais email ou mot de passe. Merci de réessayer :)</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group col-md-12 mb-4">
                  <label for="">Mot de passe *</label>
                  <input type="password" class="form-control" id="password" name="password"   autofocus>
                  <p id="p3"class="text-danger"></p>
                  </div>


                  <div class="form-group col-md-12 mb-4">
                  <label for="">Confirmez le mot de passe *</label>
                  <input type="password" class="form-control" id="confirmPassword" name="password_confirmation"   autofocus>
                  <p id="p40" class="text-danger"></p>

                  </div>




                  <div class="col-md-12">
                    <button type="submit" class="btn btn-lg  btn-block next-step " id="reset" >Réinitialiser</button>
                  </div>
                </div>
              </form>



           
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
  <!-- toaster js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- toaster script -->
  <script>
    @if(Session::has('message'))
    var type = "{{ Session ::get('alert_type','danger') }}"
    switch(type){
        case 'info':
        toastr.info("{{ Session ::get('message') }}");
        break;
        case 'success':
        toastr.success("{{ Session ::get('message') }}");
        break;
        case 'warning':
        toastr.warning("{{ Session ::get('message') }}");
        break;
        case 'error':
        toastr.error("{{ Session ::get('message') }}");
        break;
    }
    @endif
  </script>
  <script>
      $(document).ready(function() {
      $("#reset").click(function() {
        var name = $("#name").val();
        var email = $("#email").val();
        var email_verification = $("#email_verification").val();
        var pass = $("#password").val();
        var confirmPassword = $("#confirmPassword").val();
        var regExpEmail = /^([\w\.\+]{1,})([^\W])(@)([\w]{1,})(\.[\w]{1,})+$/;

        var passwordregex6digits = new RegExp("^(?=.{6,})");
        var passwordregexLowercase = new RegExp("^(?=.*[a-z])");
        var passwordregexUppercase = new RegExp("^(?=.*[A-Z])");
        var passwordregexNumber = new RegExp("^(?=.*[0-9])");
        var passwordRegexSpecial = new RegExp("^(?=.*[!@#$%^&*])");
          var passwordRegexAll = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{6,})");


    
        if(email.length == "")
          {
            $("#p2").text("Veuillez saisir votre adresse e-mail");
            $("#email").focus();
            return false;
          }

          else if(!passwordregex6digits.test(pass))
          {
            $("#p3").text("Doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial");
            $("#password").focus();
            return false;
          }
          else if(!passwordregexLowercase.test(pass))
          {
            $("#p3").text("Doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial");
            $("#password").focus();
            return false;
          }

          else if(!passwordregexUppercase.test(pass))
          {
            $("#p3").text("Doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial");
            $("#password").focus();
            return false;
          }

          else if(!passwordregexNumber.test(pass))
          {
            $("#p3").text("Doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial");
            $("#password").focus();
            return false;
          }

          else if(!passwordRegexSpecial.test(pass))
          {
            $("#p3").text("Doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial");
            $("#password").focus();
            return false;
          }

          else if(!passwordRegexAll.test(pass))
          {
            $("#p3").text("Doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial");
            $("#password").focus();
            return false;
          }


          else if(confirmPassword != pass)
          {
            $("#p40").text("Le mot de passe ne correspond pas");
            $("#confirmPassword").focus();
            return false;
          }
        else
          {
            if(con == true)
              {
              
                return true;
              }
            else
              {
                return false;
              }
          }
      });
      
    }); 
  </script>
</body>
</html>