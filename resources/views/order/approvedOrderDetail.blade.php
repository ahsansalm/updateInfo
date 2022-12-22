@extends('layouts.informathic3')
@section('content')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript" src="http://www.position-absolute.com/creation/print/jquery.printPage.js"></script>



<div class="row">
    <div class="col-12">
        
                <div class="dashboard_image">
                    <h1 class="text-center mt-5">Détail de la commande de l’utilisateur</h1> </button>
                        </a>
                </div>
    </div>









                <div class="col-12 text-right">
                    <a href="{{url('orderDetailPDF/'.$device->id)}}" >
                                <button type="click" class="btn btn-sm btn-success float-right mt-2">Exporter PDF</button>
                    </a>


                    <a href="{{url('upload/pdf/page/'.$device->id)}}" >
                                <button type="click" class="btn btn-sm btn-primary float-right mt-2 mr-2">Télécharger le PDF</button>
                    </a>

                </div>








    <div class="col-12 mt-2">  
        <form action="{{url('/order/approved/'.$device->id)}}" method='POST'>
            @csrf
            <div class="card">
                
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-custom">
                        <tr >
                            <th class="text-white" scope="col">#</th>
                            <th class="text-white" scope="col">Données utilisateur</th>
                            <th class="text-white" scope="col">Informations</th>
                            </tr>
                        </thead>
                        <tbody class="text-dark">
                            <tr>
                            <th scope="row">1</th>
                            <td><h6>Nom d’utilisateur :</h6></td>
                            <td hidden><input type="hidden" value="{{$device->userId}}" name="userId"></td>
                            <td><p id="nameU">{{$device->user->firstname}} {{$device->user->lastname}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td><h6>E-mail de l’utilisateur:</h6></td>
                            <td><p id="emailU">{{$device->register->email}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td><h6>Adresse :</h6></td>
                            <td><p id="addressU">{{$device->user->address}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">4</th>
                            <td><h6>Code postal :</h6></td>
                            <td><p id="codeU">{{$device->user->postal}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">5</th>
                            <td><h6>Numéro de téléphone :</h6></td>
                            <td><p id="phoneU">{{$device->user->phone}}</p></td>
                            </tr>
                        </tbody>
                    </table>



                    <table class="table">
                        <thead class="thead-custom">
                        <tr >
                            <th class="text-white" scope="col">#</th>
                            <th class="text-white" scope="col">Données produit</th>
                            <th class="text-white" colspan="2" scope="col">Informations</th>
                            </tr>
                        </thead>
                        <tbody class="text-dark">
                            
                            <tr>
                            <th scope="row">1</th>
                            <td><h6>Code produit:</h6></td>
                            <td colspan="2"><p id="codeA">{{$device->product_code}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td hidden   id="userId2" >{{$device->userId}}</td>
                            <td hidden id="userId">{{$device->id}}</td>
                            <td><h6>Marques :</h6></td>
                            <td  colspan="2"><p  id="brandA">{{$device->marks}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td><h6>Produit:</h6></td>
                            <td  colspan="2"><p  id="productA">{{$device->product}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">4</th>
                            <td><h6>Demande de service :</h6></td>
                            <td hidden><input type="hidden" value="{{$device->serviceRequest}}" name="serviceId"></td>
                            <td  colspan="2" id="serviceA">{{$device->servicedata->service}}</td>
                            </tr>
                            <tr>
                            <th scope="row">5</th>
                            <td><h6>Commandez par l’intermédiaire de:</h6></td>
                            <td colspan="2" ><p  id="shipA">{{$device->shipment}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">6</th>
                            <td><h6>Prix :</h6></td>
                            <td  colspan="2" id="priceA">{{$device->parcel->totalPrice}}</td>
                            </tr>

                            <tr>
                            <th scope="row">7</th>
                            <td><h6>Mot de passe ou code PIN :</h6></td>
                            <td  colspan="2" id="pinA"><p>{{$device->pin}}</p></td>
                            </tr>

                            <tr>
                            <th scope="row">8</th>
                            <td><h6>Modèle de mot de passe :</h6></td>
                            <td  colspan="2"><p  id="pattA">{{$device->pattern}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">9</th>
                            <td><h6>Code à barre :</h6></td>
                            <td  colspan="2" class="mt-2">
                            <img id="printTable" src="{{$device->barcode}}" alt="">
                            <button class="btn btn-sm ml-3" type='button' id='buttonprint'>
                                <i class="fa fa-print" style="font-size:20px"></i>
                            </button>
                            </td>
                            </tr>

                        </tbody>
                        
                    </table>
                

                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{url('/userOrder')}}">
                                    <button type="button" class="default-btn prev-step btn-block btn-secondary">Retour</button>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <button type="button" class="default-btn next-step  btn-block btn-primary" id="refuse" >Refuser</button>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="default-btn next-step  btn-block btn-primary">A approuvé</button>
                            </div>

                            
                        </div>



                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-center text-dark my-2">Options de mise à jour utilisateur</h6>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="default-btn prev-step btn-block btn-secondary"  id="recieved">L'appareil sera reçu</button>
                            </div>

                            
                            <div class="col-md-4">
                                <button type="button" class="default-btn next-step  btn-block btn-primary" id="progress" >Réparation en cours</button>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="default-btn next-step  btn-block btn-primary" id="waiting">Salle d'attente</button>
                            </div>



                            <div class="col-md-4">
                                <button type="submit" class="default-btn next-step  btn-block btn-primary" id="repair">Réparation terminée</button>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="default-btn next-step  btn-block btn-primary" id="return">Retour au client</button>
                            </div>


                            <div class="col-md-4">
                                <button type="button" class="default-btn next-step  btn-block btn-primary" id="pay">Payé</button>
                            </div>

                            
                        </div>



                
            </div>
        
        </form>
    </div>
</div>
<script>
  function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('#buttonprint').on('click',function(){
printData();
})

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function(){

 




    // data submit using ajax
    $("#refuse").click(function () {
        var userId = $("#userId").text();
        var userId2 = $("#userId2").text();
        console.log(userId)
        $.ajax({
                    url: '{{ url('/order/refuse') }}',
                    type:'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data:{'userId':userId,'userId2':userId2},
                        success:function(success){   
                            if(success){
                                toastr.success(success.message,'Refus de commande!');
                                window.location.href = '/userOrder';
                                
                            }              
                        }           
        }); 
    }); 



    // for device revieved
    $("#recieved").click(function () {
        var userId = $("#userId").text();
        var userId2 = $("#userId2").text();
        console.log(userId)
        $.ajax({
                    url: '{{ url('/order/recieved') }}',
                    type:'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                   data:{'userId':userId,'userId2':userId2},
                        success:function(success){   
                            if(success){
                                toastr.success(success.message,'Lappareil sera reçu!');
                                window.location.href = '/userOrder';
                                
                            }              
                        }           
        }); 
    }); 



    // for device in progress
    $("#progress").click(function () {
        var userId = $("#userId").text();
        var userId2 = $("#userId2").text();
        console.log(userId)
        $.ajax({
                    url: '{{ url('/order/progress') }}',
                    type:'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                   data:{'userId':userId,'userId2':userId2},
                        success:function(success){   
                            if(success){
                                toastr.success(success.message,'Appareil en cours!');
                                window.location.href = '/userOrder';
                                
                            }              
                        }           
        }); 
    }); 



     // for device in waiting
     $("#waiting").click(function () {
        var userId = $("#userId").text();
        var userId2 = $("#userId2").text();
        console.log(userId)
        $.ajax({
                    url: '{{ url('/order/waiting') }}',
                    type:'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                   data:{'userId':userId,'userId2':userId2},
                        success:function(success){   
                            if(success){
                                toastr.success(success.message,'Appareil en salle dattente!');
                                window.location.href = '/userOrder';
                                
                            }              
                        }           
        }); 
    }); 


     // for device in repair
     $("#repair").click(function () {
        var userId = $("#userId").text();
        var userId2 = $("#userId2").text();
        console.log(userId)
        $.ajax({
                    url: '{{ url('/order/repair') }}',
                    type:'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                   data:{'userId':userId,'userId2':userId2},
                        success:function(success){   
                            if(success){
                                toastr.success(success.message,'Réparation terminée!');
                                window.location.href = '/userOrder';
                                
                            }              
                        }           
        }); 
    }); 



     // for device in return
     $("#return").click(function () {
        var userId = $("#userId").text();
        var userId2 = $("#userId2").text();
        console.log(userId)
        $.ajax({
                    url: '{{ url('/order/return') }}',
                    type:'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                   data:{'userId':userId,'userId2':userId2},
                        success:function(success){   
                            if(success){
                                toastr.success(success.message,'Retour au client!');
                                window.location.href = '/userOrder';
                                
                            }              
                        }           
        }); 
    }); 




         // for device in pay
         $("#pay").click(function () {
        var userId = $("#userId").text();
        $.ajax({
                    url: '{{ url('/order/pay') }}',
                    type:'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                   data:{'userId':userId,},
                        success:function(success){   
                            if(success){
                                toastr.success(success.message,'Vous avez payé cette commande!');
                                window.location.href = '/userOrder';
                                
                            }       
                        }           
        }); 
    }); 




        // upload pdf
    //     $("#upload").click(function () {
    //     var userId = $("#userId").text();
    //     var pdf = $("#pdf").val();
    //     console.log(userId)
    //     console.log(pdf)
    //     $.ajax({
    //                 url: '{{ url('/upload/pdf') }}',
    //                 type:'post',
    //                 headers: {
    //                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //                 },
    //                data:{'userId':userId,'pdf':pdf},
    //                     success:function(success){   
    //                         if(success){
    //                             toastr.success(success.message,'Vous avez payé cette commande!');
    //                             location.reload();
                                
    //                         }       
    //                     }           
    //     }); 
  
    // }); 




});
</script>


@endsection