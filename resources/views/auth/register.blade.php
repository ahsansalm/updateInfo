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
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- PLUGINS CSS STYLE -->
  <link href="{{asset('auth/assets/plugins/toaster/toastr.min.css')}}" rel="stylesheet" />
  <link href="{{asset('auth/assets/css/custom.css')}}" rel="stylesheet" />

  <link href="{{asset('auth/assets/plugins/nprogress/nprogress.css')}}" rel="stylesheet" />
  <link href="{{asset('auth/assets/plugins/flag-icons/css/flag-icon.min.css')}}" rel="stylesheet"/>
  <link href="{{asset('auth/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" />
  <link href="{{asset('auth/assets/plugins/ladda/ladda.min.css')}}" rel="stylesheet" />
  <link href="{{asset('auth/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
  <link href="{{asset('auth/assets/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
   <!-- toaster css -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
  <!-- SLEEK CSS -->
  <link id="sleek-css" rel="stylesheet" href="{{asset('auth/assets/css/sleek.css')}}" />
   <!-- toaster css -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
  <!-- FAVICON -->
  <link href="{{asset('auth/assets/img/favicon.png')}}" rel="shortcut icon" />
  <script src="{{asset('auth/assets/plugins/nprogress/nprogress.js')}}"></script>
  <!-- boostrap -->
  <!-- CSS only -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <!-- custom css -->
  <link href="{{asset('auth/assets/css/custom.css')}}" rel="stylesheet" />
<style>
    .errors {
      color: red !important;
   }
</style>

</head>
<body class="bg-light-gray" id="body">
    <nav class="navbar navbar-static-top navbar-expand-lg">

        <!-- search form -->
        <div class="search-form ">
        <div class="app-brand" style="background: white !important;">
            <span class="brand-name">
                <img src="{{asset('img/logo/logo.png')}}" style="max-width:160px !important;"alt="">
            </span>
                    
        </div>
        </div>

        <div class="navbar-right ">

        <ul class="nav navbar-nav">

            <!-- User Account -->
            <a href="{{url('/login')}}">
                <li class="mx-2">   
                    <button type="button" class="default-btn btn-block btn-secondary prev-step">Connexion</button>
                </li>
            </a>
            <a href="{{url('/register')}}">
                <li class="mx-2">   
                    <button type="button" class="default-btn btn-block btn-secondary prev-step">S'inscrire</button>
                </li>
            </a>
        </ul>
        </div>
    </nav>
    <div class="row justify-content-center mt-5 text-dark">
        <div class="col-md-9">
            <div class="card">
            <div class="card-header" style="background: #0C1741;">
            <div class="app-brand text-center py-3" style="background: #0C1741;">
                 
            <h4 class="brand-name">Création d'un compte client Informathic</h4>
              </div>
            </div>
                <div class="card-body p-5">
                    <section class="signup-step-container">
                        <div class="wizard">
                            <div class="wizard-inner">
                                <div class="connecting-line"></div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#step1"  style="pointer-events: none;"  data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Informations</i></a>
                                    </li>
                                    <li role="presentation" class="disabled">
                                        <a href="#step2"  style="pointer-events: none;"  data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>Identificants</i></a>
                                    </li>
                                    <li role="presentation" class="disabled">
                                        <a href="#step3"  style="pointer-events: none;"  data-toggle="tab" aria-controls="step3" role="tab"><span class="round-tab">3</span> <i>Informations personnelles</i></a>
                                    </li>
                                    <li role="presentation" class="disabled">
                                        <a href="#step4"  style="pointer-events: none;"  data-toggle="tab" aria-controls="step4" role="tab"><span class="round-tab">4</span> <i>Preferneces</i></a>
                                    </li>

                                    <li role="presentation" class="disabled" style="margin-left: 97%">
                                        <a href="#step5"  style="pointer-events: none;"   data-toggle="tab" aria-controls="step5" role="tab"><span class="round-tab">5</span> <i>Confirmation</i></a>
                                    </li>
                                    
                                </ul>
                            </div>
            
                            <form action="{{route('profile')}}" method="POST" enctype="multipart/form-data"  id="form" >
                                @csrf
                                <div class="tab-content" id="main_form">
                                    <div class="tab-pane active" role="tabpanel" id="step1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                    <h3 class=" text-center">Pourquoi créer un compte Informathic ?</h3>
                                                    <p>Pourquoi créer un compte Informathic ?</p>
                                                    <u>
                                                        <li>L'assistance à distance du Lundi au Samedi 9h30-12h30 et 14h-20h</li>
                                                        <li>L'accès à un espace client pour accéder rapidement à vos tickets, devis et factures.</li>
                                                        <li>Possibilité de déclencher une demande de SAV rapidement</li>
                                                    </u>
                                                    <p><b>La création de compte est gratuite, simple et rapide,</b> il suffit de vous laisser guider</p>
                                                    <h5>Note : Vous possédez déjà un compte si vous avez déjà eu un contact avec Informathic, merci de nous contacter afin d'obtenir vos identifiants</h5>
                                                    <h3 class=" text-center">Commencez la création de votre compte client</h3>
                                                    <h4><b>Les champs suivi d'un astérisque * sont obligatoires</b></h4>
                                                    <p>Tout est prêt, <b>cliquez</b> sur suivant pour <b>commencer</b>.</p>
                                                    <hr>
                                                </div>

                                            
                                            </div>
                                        <ul class="list-inline pull-right">
                                            <li><button type="button" class="default-btn next-step">Commencez la creation d'un compte Informathic</button></li>
                                        </ul>
                                    </div>

                                    
                                    <div class="tab-pane" role="tabpanel" id="step2">
                                        <div class="row">
                                            <div class="col-12 text-center mb-2">
                                                <h3>Vos identifiants de connection</h3>
                                                <hr>
                                            </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Votre adresse email  *</label> 
                                                <input class="form-control" type="email"  id="emailGet" name="email" placeholder=""> 
                                                <p id="p2" class="text-danger"></p>
                                                @error('email')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Confirmer votre adresse email *</label> 
                                                <input class="form-control" id="email_verification" name="email_verification" type="email" placeholder=""> 
                                                <p id="p30" class="text-danger"></p>

                                                @error('email_verification')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 text-center text-secondary">
                                            <h6>Votre adresse email sera votre identifiant de connexion, il vous sert aussi à retrouver votre mot de passe en cas d'oubli</h6>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                                <label>Votre mot de passe *</label> 
                                                <input class="form-control" id="passGet" type="password" name="password" placeholder=""> 
                                                <p id="p3" class="text-danger"></p>
                                                @error('password')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Confirmer votre mot de passe *</label> 
                                                <input class="form-control" name="confirmPassword" id="confirmPassword" type="password" name="name" placeholder=""> 
                                                <p id="p40" class="text-danger"></p>
                                                @error('confirmPassword')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-12 text-center text-secondary">
                                            <h6>Votre mot de passe doit avoir un minimum de 8 caractères pour des raisons de sécurité</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="default-btn prev-step btn-block btn-secondary">Retournez aux informations</button>

                                        </div>


                                        <div class="col-md-6">
                                            <button type="button" id="submit1" class="default-btn first-step  btn-block btn-primary">Etape suivante</button>
                                        </div>
                                        </div>
                                      
                                    </div>





                                    <div class="tab-pane" role="tabpanel" id="step3">
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nom*</label> 
                                                <input class="form-control" type="text" name="firstname" id="nameGet" placeholder=""> 
                                                <p id="p111" class="text-danger"></p>
                                                @error('name')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Prenom*</label> 
                                                <input class="form-control" type="text" id="name" name="lastname" placeholder=""> 
                                                <p id="p1" class="text-danger"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Adresse*</label> 
                                                <input class="form-control" type="text" id="getAddress" name="postal" placeholder=""> 
                                                <p id="p112" class="text-danger"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Adresse (suite) </label> 
                                                <input class="form-control" type="text" name="address" placeholder=""> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Code postal* </label> 
                                                <input class="form-control" type="text" id="codeGet" name="code" placeholder="">
                                                <p id="p113" class="text-danger"></p> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Ville* </label> 
                                                <input class="form-control" type="text" name="town" id="town" placeholder=""> 
                                                <p id="p114" class="text-danger"></p>
                                            </div>
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Téléphone portable*  </label> 
                                                <input type="text" id="getCell" name="phone"  class="form-control">
                                                <p id="p115" class="text-danger"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sélectionnez L'image </label> 
                                                <input type="file" name="photo" id="photo"  class="form-control">
                                                <p id="p116" class="text-danger"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="default-btn prev-step btn-block btn-secondary">Retournez aux informations</button>

                                        </div>


                                        <div class="col-md-6">
                                            <button type="button" id="submit2" class="default-btn second-step  btn-block btn-primary">Etape suivante</button>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" role="tabpanel" id="step4">
                                        <div class="all-info-container">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <h6>Vos préférences</h6>
                                                    <p>Sur cette page vous allez pouvoir définir vos préférences de contact</p>
                                                    <hr>
                                                </div>


                                                <div class="col-9">
                                                    <h6>Recevoir par email les offres commerciales d' Informathic.</h6>
                                                    <p>Promotion, nouveauté, actualité informatique</p>
                                                </div>
                                                <div class="col-1">
                                                    <div class="form-check">
                                                    <input  class="form-check-input" type="radio" name="email_info" value="yes">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                        Oui
                                                        </label>
                                                    </div>
                                                </div>
                                                <br>
                                                <br>
                                                <br>
                                    



                                          


                                                <div class="col-8">
                                                    <h6>Vos préférences de contact avec nos techniciens.</h6>
                                                </div>
                                                <div class="col-4">
                                                    <select class="form-control" name="preferenceNew" aria-label="Default select example">
                                                        <option selected value="Appel sur telephone Portable">Appel sur telephone Portable</option>
                                                        <option value="SMS">SMS</option>
                                                    </select>
                                                </div>
                                                
                                                <br>
                                                <br>
                                                <br>


                                                <div class="col-8 mt-3">
                                                <h6>A quelle tranche horaire pouvons-nous vous contacter.</h6>
                                                </div>
                                                <div class="col-2">
                                                    <label class="col-form-label"><b>De temps</b></label> 
                                                    <input type="time" id="time" name="time" class="form-control">
                                                    <p id="p1111" class="text-danger"></p>
                                                </div>
                                                <div class="col-2">
                                                    <label class="col-form-label"><b>À l'heure</b></label> 
                                                    <input type="time" id="totime" name="totime" class="form-control">
                                                    <p id="p100000" class="text-danger"></p>
                                                </div>

                                                
                                                <div class="col-md-6 mt-2">
                                                    <button type="button" class="default-btn prev-step btn-block btn-secondary">Retournez aux informations</button>

                                                </div>


                                                <div class="col-md-6 mt-2">
                                                    <button type="button" id="submit3" class="default-btn  next-step btn-block btn-primary">Etape suivante</button>
                                                </div>

                                                
                                            </div>
                                        </div>
                                        
                                    </div>




                                    <div class="tab-pane" role="tabpanel" id="step5">
                                        <div class="all-info-container">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <h6>Récapitulatif</h6>
                                                    <p>Vous retrouvez sur cette page un récapitulatif des informations que vous avez saisies.<br>
                                                    Si vous avez besoin d'effectuer une modification, vous pouvez cliquer sur le bouton "Retournez aux préférences".</p>
                                                    <hr>
                                                </div>

                                                <div class="col-6">
                                                    <h6>Nom et prénom</h6>
                                                </div>
                                                <div class="col-6">
                                                    <p id="putName"></p>
                                                </div>
                                                <br>
                                                <br>


                                                <div class="col-6">
                                                    <h6>Votre identifiant de connexion</h6>
                                                </div>
                                                <div class="col-6">
                                                    <p id="putEmail"></p>
                                                </div>
                                                <br>
                                                <br>

                                                <div class="col-6">
                                                    <h6>Votre mot de passe </h6>
                                                </div>
                                                <div class="col-6">
                                                    <span><span id="putPass" style="display:none"></span><i class="fa fa-eye  getpassword" style="font-size:26px"></i></span>
                                                </div>
                                                <br>
                                                <br>

                                                <div class="col-6">
                                                    <h6>Votre adresse</h6>
                                                </div>
                                                <div class="col-6">
                                                    <p id="putAdd"></p>
                                                </div>
                                                <br>
                                                <br>

                                                <div class="col-6">
                                                    <h6>code postal</h6>
                                                </div>
                                                <div class="col-6">
                                                    <p id="putCode"></p>
                                                </div>
                                                <br>
                                                <br>

                                                <div class="col-6">
                                                    <h6>Votre téléphone</h6>
                                                </div>
                                                <div class="col-6">
                                                    <p id="putCell"></p>
                                                </div>
                                                <br>
                                                <br>

                                                

                                                <div class="col-12">
                                                    <hr>
                                                </div>

                                                <div class="col-md-12 text-center">
                                                <div class="alert alert-success" role="alert">
                                                <p>Une dernière étape
                                                    <br>
                                                Valider votre adresse email
                                                <br>
                                                Nous vous avons envoyé un email contenant un lien de validation à votre adresse email
                                                <br>
                                                Il nous faut une adresse email valide pour le bon fonctionnement de votre espace client, vérifier dans vos email la présence d'un email de la part de :
                                                " contact@informathic.fr "
                                                <br>
                                                Je ne retrouve pas l'email de validation
                                                Vérifier dans la catégorie Spam de votre boite mail.
                                                <br>
                                                Si vous ne recevez pas l'email, contactez nous par téléphone afin de valider votre inscription</p>  
                                            </div>
                                                
                                                </div>

                                                
                                            </div>
                                        </div>
                                        
                                       <div class="row">
                                            <div class="col-6">
                                                    <button type="button" class="default-btn btn-block btn-secondary prev-step">Retournez aux preferences</button>
                                                </div>
                                                <div class="col-6">
                                                <button type="submit" class="default-btn btn-block btn-success click-page-new">Valider I'enregistrement</button>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="clearfix"></div>
                                </div>
                                <p class="pt-3">Retour à la 
                                    <a  style="color: #0C1741;" href="{{url('/login')}}">
                                        Connexion</a>
                                </p>
                            </form>
                        </div>
                    
                    </section>

                </div>
            </div>
        </div>
    </div>






    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- custom js -->
<script src="{{asset('auth/assets/js/app.js')}}"></script>
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
<!-- sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  @if(session('success'))
    <script>
      swal('{{session('success')}}')
    </script>
  @endif
<script>


    
        
        // ------------step-wizard-------------


   

$("#emailGet").keyup(function(){
  var email = $(this).val();
  $("#putEmail").html(email);
  
  
});
$("#nameGet").keyup(function(){
  var email = $(this).val();
  $("#putName").html(email);
  
  
});

$("#codeGet").keyup(function(){
  var email = $(this).val();
  $("#putCode").html(email);
  
  
});
$("#passGet").keyup(function(){
  var pass = $(this).val();
  $("#putPass").html(pass);
  
  
});


$("#getAddress").keyup(function(){
  var add = $(this).val();
  $("#putAdd").html(add);
  
  
});


$("#getCell").keyup(function(){
  var cell = $(this).val();
  $("#putCell").html(cell);
  
  
});


$(".getpassword").click(function(){
    $("#putPass").css('display','block');
  
  
});

</script>
    

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>



<script>
    $("#submit1").click(function() {

        var email = $("#emailGet").val();
        var email_verification = $("#email_verification").val();
        var pass = $("#passGet").val();
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
            $("#emailGet").focus();
            return false;
          }
          else if(!regExpEmail.test(email))
          {
            $("#p2").text("Veuillez saisir votre adresse e-mail");
            $("#emailGet").focus();
            return false;
          }
          else if(email_verification != email)
          {
            $("#p30").text("L'e-mail ne correspond pas");
            $("#email_verification").focus();
            return false;
          }

        



          else if(!passwordregex6digits.test(pass))
          {
            $("#p3").text("Doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial");
            $("#passGet").focus();
            return false;
          }
          else if(!passwordregexLowercase.test(pass))
          {
            $("#p3").text("Doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial");
            $("#passGet").focus();
            return false;
          }

          else if(!passwordregexUppercase.test(pass))
          {
            $("#p3").text("Doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial");
            $("#passGet").focus();
            return false;
          }

          else if(!passwordregexNumber.test(pass))
          {
            $("#p3").text("Doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial");
            $("#passGet").focus();
            return false;
          }

          else if(!passwordRegexSpecial.test(pass))
          {
            $("#p3").text("Doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial");
            $("#passGet").focus();
            return false;
          }

          else if(!passwordRegexAll.test(pass))
          {
            $("#p3").text("Doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial");
            $("#passGet").focus();
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
                return false;
              }
          
      });

  
 



    $('#submit2').click(function(){
        var name = $("#name").val();
        var nameGet = $("#nameGet").val();
        var getAddress = $("#getAddress").val();
        var codeGet = $("#codeGet").val();
        var town = $("#town").val();
        var getCell = $("#getCell").val();
       
        if(nameGet.length == "")
          {
            $("#p111").text("Le nom de famille est requis");
            $("#nameGet").focus();
            return false;
          }

        else if(name.length == "")
          {
            $("#p1").text("S'il vous plaît entrez votre nom");
            $("#name").focus();
            return false;
          }
          else if(getAddress.length == "")
          {
            $("#p112").text("L'adresse est obligatoire");
            $("#getAddress").focus();
            return false;
          }
          else if(codeGet.length == "")
          {
            $("#p113").text("Le courrier est requis");
            $("#codeGet").focus();
            return false;
          }
          else if(town.length == "")
          {
            $("#p114").text("Ville requise");
            $("#town").focus();
            return false;
          }
          else if(getCell.length == "")
          {
            $("#p115").text("téléphone requis");
            $("#getCell").focus();
            return false;
          }
        //   else if(photo.extension != "jpg")
        //   {
        //     $("#p116").text("téléphone requis");
        //     $("#photo").focus();
        //     return false;
        //   }
        //   else if(address.length == "")
        //   {
        //     $("#p116").text("S'il vous plaît entrez votre nom");
        //     $("#nameGet").focus();
        //     return false;
        //   }
          else
          {
                return false;
              }
    });





    // $('#submit3').click(function(){
    //     var time = $("#time").val();
    //     var totime = $("#totime").val();
    //     if(time.length == "")
    //       {
    //         $("#p1111").text("Veuillez remplir ceci");
    //         $("#nameGet").focus();
    //         return false;
    //       }

    //     else if(totime.length == "")
    //       {
    //         $("#p100000").text("Veuillez remplir ceci");
    //         $("#name").focus();
    //         return false;
    //       }
    //       else if(email_verification != email)
    //       {
    //         $("#p30").text("L'e-mail ne correspond pas");
    //         $("#email_verification").focus();
    //         return false;
    //       }
    //       else
    //       {
    //             return false;
    //           }
    // });
</script>



</body>
</html>