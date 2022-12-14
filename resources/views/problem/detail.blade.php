@extends('layouts.informathic2')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="dashboard_image" style="background: #0A0A0B !important;">
                <h1 class="text-center mt-5">Ecrivez votre réponse</h1> 
            </div>
            <div class="card-body text-dark">
                    <div class="row  text-center mt-5">
                        <div class="col-3">
                            <h6>Informations de l'utilisateur:</h6>
                            <hr>
                        </div>
                        <div class="col-9">
                            <input type="hidden" id="update_id" value="{{ $supports->id }}"  >
                            <p id="userId"hidden ></span>{{$supports->userId}}</p>
                                <p id="putProduct"><span class="text-dark">Nom: </span>{{$supports->user->firstname}},
                                <span class="text-dark">Adresse: </span>{{$supports->user->address}}, 
                                <span class="text-dark">Code: </span>{{$supports->user->code}},
                                <span class="text-dark">Téléphoner: </span>{{$supports->user->phone}},</p>
                            <hr>
                        </div>
                        <br>
                        <br>

                        <div class="col-3">
                            <h6>Information produit:</h6>
                            <hr>
                        </div>
                        <div class="col-9">
                        <p id="productId" hidden>{{$supports->id}}</p>
                                <p id="putProduct"><span class="text-dark">Des marques: </span>{{$supports->marks}},
                                <span class="text-dark">Nom: </span>{{$supports->product}}, 
                                <span class="text-dark">Service: </span>{{$supports->serviceRequest}},
                            <hr>
                        </div>
                        <br>
                        <br>

  

                    </div>


            </div>
        </div>


            
    </div>


    <div class="col-12">
        <div class="card-body text-dark">

            <div class="chat px-1">
                <div class="chat_message">
                  <div class="container mt-3">
                    <div class="row">
                        
                            <div class="col-6"  style="border-right: 2px solid white;">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="text-white text-center my-1">Users Problems</h3>
                                    </div>
                                    @foreach($chat as $sup)

                                    <div class="col-12 ">
                                        <div class="input-group  ">
                                            <div class="input-group-append">
                                                <img src="../../{{$sup->profile->photo}}" style="height: 35px; width: 35px;  border-radius: 50%;" alt="">
                                            </div>
                                            <input type="text" class="form-control ml-2" disabled value="{{$sup->problem}}">
                                        </div>   
                                    </div>
                                    @endforeach
                                </div>
                            </div>



                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="text-white text-center my-1">Your Replies</h3>
                                    </div>
                                    @foreach($reply as $rep)
                                    <div class="col-12" >
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <img src="../../{{$rep->profile->photo}}"  style="height: 35px; width: 35px;   border-radius: 50%;" alt="">
                                            </div>
                                            <input type="text" class="form-control ml-2" disabled value="{{$rep->answer}}">
                                        </div>

                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                  </div>

                
                <form action="" class="form_div">
                    <div class="input-group px-5">
                        <input type="text" class="form-control text-dark" id="answer" placeholder="Tapez ...">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary "  id="sendReply" type="button">
                                <i class="fa fa-mail-forward ml-2"  style="font-size:28px;"></i>
                            </button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">         
        <a href="{{url('/problem')}}">
            <button type="button" class="btn btn-block prev-step">Retour</button>
        </a>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function(){
    // data submit using ajax
    $("#sendReply").click(function () {
        var update_id = $("#update_id").val();
        var userId = $("#userId").text();
        var productId = $("#productId").text();
        var problem = $("#problem").val();
        var object = $("#object").text();
        var icon = $("#icon").text();
        var answer = $("#answer").val();
        $.ajax({
                    url: '{{ url('/problem/reply') }}',
                    type:'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data:{'update_id':update_id,'userId':userId,'productId':productId,'problem':problem,'object':object,'icon':icon,'answer':answer,},
                        success:function(success){   
                            if(success){
                                toastr.success(success.message,'Your answer has been send!');
                                window.location.reload()
                                
                            }              
                        }           
        }); 
    });
});
</script>
@endsection
