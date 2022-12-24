@extends('layouts.informathic')
@section('content')



<link rel="stylesheet" type="text/css" href="{{asset('auth/assets/css/patternLock.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('auth/assets/css/patternLock-theme.css')}}" />
        
<style>


</style>

<div class="bg-white border rounded">
    <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="dashboard_image" >
                            <h1 class="mt-5">Votre demande de service</h1> 
                        </div>
                    </div>
                </div>

                <form action="{{url('user/add/request/data')}}" method="POST">
                    @csrf
              
                    <div class="row text-dark mt-4">
                        <input type="hidden" name="userId" value="{{auth()->user()->id}}">      
                       <div class="col-md-4">
                            <label for=""><b>Marque</b></label>
                            <input type="text" class="form-control"  id="brand" name="brand" placeholder="Marque...">
                            <p id="p2" class="text-danger"></p>
                        </div>

                        <div class="col-md-4">
                            <label for=""><b>Produit</b></label>
                            <input type="text" class="form-control" id="product" name="product" placeholder="Nom du produit...">
                            <p id="p22" class="text-danger"></p>
                        </div>


                        <div class="col-md-4">
                            <label for=""><b>Service</b></label>
                            <input type="text" class="form-control" id="service"  name="service" placeholder="Nom du service...">
                            <p id="p222" class="text-danger"></p>
                        </div>


                        <div class="col-md-5  mt-2">
                            <label for=""><b>My Problem:</b></label>
                            <textarea name="" name="problemDetect" class="form-control" rows="3"></textarea>
                        </div>



                        <div class="col-md-7  mt-2">
                            <label for=""><b>Si votre appareil a déjà été réparé, merci de nous indiquer la nature de la réparation:</b></label>
                            <textarea name="" name="information" class="form-control" rows="3"></textarea>
                        </div>



                        

                        <div class="col-md-6 mt-3">
                            <h6><b>MODÈLE de mot de passe</b></h6>
                            <div id="div3" class="selectGroup mt-2"></div>
                        </div>
                        
                        <div class="col-md-6 mt-3">
                            <h6><b>Mot de passe NIP</b></h6>
                            <div id="div2" class="selectGroup mt-2"></div>
                        </div>
                        <div class="col-lg-6 mt-2"> 
                            <div id="PassPat" >
                                <!-- <canvas id="mycanvas" width="350" height="350" class="glowing-border">
                                </canvas>
                                    <p id="pattern"> no </p> -->

                                    <div id="patternTimeout"></div>
                                    <input type="hidden" name="pattern" id="pattern">


                                    <!-- <p id="result"> hre  </p> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="pin"  id="PassPin" class="form-control" >
                        </div>



                    </div>

                    <div class="row">
                        
                        <div class="col-md-6 mt-2 text-dark">
                            <h6 class="mt-3"><b>Pour R2, la compensation est jusqu'à 200$ et remise en main propre</b></h6>
                        </div>
                        <div class="col-md-6 mt-2">
                            <select name="shipment" id="shipment" class="form-control" id="">
                                <option value="R1(Envoyer un colis par la poste)">R1 (Envoyer un colis par la poste)</option>
                                <option value="R2(Demander un rendez-vous pour prendre soin de l'appareil)">R2 (Demander un rendez-vous pour prendre soin de l'appareil)</option>

                            </select>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{url('/SendParcel')}}">
                                <button type="button" class="default-btn prev-step btn-block btn-secondary">Retour</button>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" id="submit1" class="default-btn next-step  btn-block btn-primary">Envoyer un colis</button>
                        </div>
                    </div> 
               </form> 

        </div>
    </div>
</div>
<script src="{{asset('admin/assets/js/PatternLock.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    function addItem(value,innerHTML) {
        document.getElementById('seriveData').value = value;
        document.getElementById("putProduct").innerHTML = innerHTML;
    }

    function addBenifit(value,innerHTML) {
        // alert(value)
        document.getElementById('benifitData').value=value;
        document.getElementById("benifitDataText").value = innerHTML;

        document.getElementById('putBenifit').innerHTML=value;
        document.getElementById("putPrice").innerHTML = innerHTML;
    }
   





    
    
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
     
      
    $(document).ready(function(){
        
    
        $(".brand_id").click(function(){
            var id = $(this).val();
            var name = $(this).text();
            $(".BrandValue").val(id);
            $("#putBrand").html(name);
        });
        $(".brand_null").click(function(){
            $(".BrandValue").val('');
            $(".seriveData").val('');
        });
        

        $(".product_data").click(function(){
            var id = $(".BrandValue").val();
            if(id.length == "")
                {
                    $("#p111").text("Le nom de famille est requis");
                    $("#id").focus();
                    return false;
                }
                else{
                    $.ajax({
                        url:'{{ url('/brand/fetach/data') }}',
                        type:'get',
                        data:{'id':id},
                        success:function(output_sub){
                            $('.select_product').html(output_sub);
                        }
                    });
                }
        });



        $(".service_data").click(function(){
            var value = $("#seriveData").val();
            if(value.length == "")
                {
                    $("#p111").text("Le nom de famille est requis");
                    $("#value").focus();
                    return false;
                }
                else{
                    $.ajax({
                    url:'{{ url('/product/fetach/data') }}',
                    type:'get',
                    data:{'value':value},
                    success:function(newOutput){
                        $('.select_service').html(newOutput);
                    }
                    });
                }
        });





        $(".next-benifit").click(function(){
            var value = $("#benifitData").val();
            if(value.length == "")
                {
                    $("#p111").text("Le nom de famille est requis");
                    $("#value").focus();
                    return false;
                }
                else{
                    return true;
                }
        });

        
        $(".hide_benifits").click(function(){
            $("#seriveData").val('');
        });
        $(".hideServicebenifit").click(function(){
            $("#benifitData").val('');
        });


        $("#problemDetect").keyup(function(){
            var problem = $(this).val();
            $('#putInfo').text(problem); 
        });


        $("#information").keyup(function(){
            var info = $(this).val();
            $('#putproblemDetect').text(info); 
        });

        $("#returnChoice").keyup(function(){
            var newchoice = $(this).val();
            $('#putReturnChoice').text(newchoice); 
        });


    // data submit using ajax
        $("#submitData").click(function () {

            var userId = $("#userId").text();
            var marks = $("#putBrand").text();
            var product = $("#putProduct").text();
            var service = $("#putBenifit").text();
            var information = $("#putInfo").text();
            var problem = $("#putproblemDetect").text();
            var price = $("#putPrice").text();
            var returnChoice = $("#putReturnChoice").text();
            var shipment = $("#shipment").val();
            var pin = $("#PassPin").val();
            var pattern = $("#pattern").text();

            $.ajax({
                    url:'{{ url('/insert/parcel')}}',
                    type:'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data:{'userId':userId,'marks':marks,'product':product,'service':service,
                        'information':information,'shipment':shipment,'problem':problem,'returnChoice':returnChoice,'price':price,
                        'pin':pin,'pattern':pattern,
                    },
                        success:function(success){
                            if(success){
                                window.location.href = '/SuccessParcel';
                            }             
                        }           
            });
        });
    });



    $(document).ready(function () {
        $('#PassPin').hide();
        $('#PassPat').hide();
        function toggleValueChanged(selectedValue) {
            console.log(selectedValue)
          if(selectedValue == '1'){
            $('#PassPin').hide();
          }
          else{
            $('#PassPin').show();
          }
        }

        function toggleValueChanged2(selectedValue) {
            console.log(selectedValue)
          if(selectedValue == '1'){
            $('#PassPat').hide();
          }
          else{
            $('#PassPat').show();
          }
        }



        let opt = [
          { value: 1, label: "No" },
          { value: 2, label: "Yes" },
        ];
        $("#div1").setupToggles();

        $("#div2").setupToggles({
          toggleOptions: opt,
          defaultValue: 1,
          onSelectedValueChange: toggleValueChanged,
        });

        $("#div3").setupToggles({
          toggleOptions: opt,
          defaultValue: 1,
          onSelectedValueChange: toggleValueChanged2,
        });
      });

   
</script>



<script src="{{asset('auth/assets/js/jquery-1.11.1.min.js')}}"></script>

        <script src="{{asset('admin/assets/js/jquery.patternlock.js')}}"></script>
 <!-- here is the passwrod patter -->
 <script type="text/javascript">
            $(document).ready(function(){
                $('#patternTimeout').patternLock({
                    timeout: 4000,
                    drawEnd: function(value) {
                        $('#pattern').val(value);
                    }
                });
            });
        </script>




<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>



<script>
    $("#submit1").click(function() {
        var brand = $("#brand").val();
        var product = $("#product").val();
        var service = $("#service").val();

      if(brand.length == "")
          {
            $("#p2").text("Le nom de la marque est requis");
            $("#brand").focus();
            return false;
          }
          else if(product.length == "")
          {
            $("#p22").text("Le nom du produit est requis");
            $("#product").focus();
            return false;
          }
          else if(service.length == "")
          {
            $("#p222").text("Le nom du service est requis");
            $("#service").focus();
            return false;
          }

          
      });
</script>
 

@endsection