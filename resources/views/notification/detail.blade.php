@extends('layouts.informathic')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="dashboard_image" style="background: #0A0A0B !important;">
            <h1 class="text-center mt-5">Detail:</h1> 
        </div>
    </div>

    <div class="col-12">
        <div class="card-body text-dark">
                        <p  id="userId" hidden  value="{{auth()->user()->id}}">{{auth()->user()->id}}</p>
            <div class="chat px-1">
                <div class="chat_message">
                  <div class="container">
                    <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    @foreach($reply as $rep)
                                    <div class="col-12 mt-5" >
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <img src="../../{{$rep->profile->photo}}"  style="height: 35px; border-radius: 50%;" alt="">
                                            </div>
                                            <input type="text" class="form-control ml-2" disabled value="{{$rep->answer}}">
                                        </div>

                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    @foreach($supports as $sup)

                                    <div class="col-12 mt-3 mb-4 ">
                                        <div class="input-group  ">
                                        <input type="text" class="form-control mr-2" disabled value="{{$sup->problem}}">
                                            <div class="input-group-append">
                                                <img src="../../{{auth()->user()->profile->photo}}" style="height: 35px; width: 35px;  border-radius: 50%;" alt="">
                                            </div>
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
                        <input type="text" class="form-control text-dark" id="problem" placeholder="Tapez ...">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary " value="{{$sup->productId}}" id="sendPrblem" type="button">
                                <i class="fa fa-mail-forward ml-2"  style="font-size:28px;"></i>
                            </button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">         
        <a href="{{url('/notification')}}">
            <button type="button" class="btn btn-block prev-step">Retour</button>
        </a>
    </div>
</div>
                                        



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function(){
    // data submit using ajax
    $("#sendPrblem").click(function () {
        var productId = $(this).val();
        var userId = $("#userId").text();
        var problem = $("#problem").val();
        var object = $("#object").val();
        var icon = $("#icon").val();
        $.ajax({
                    url: '{{ url('/support/add/new') }}',
                    type:'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data:{'userId':userId,'productId':productId,'problem':problem,'object':object,'icon':icon,},
                        success:function(success){   
                            if(success){
                                toastr.success(success.message,'Le problème a été envoyé!');
                                location.reload();
                                
                            }              
                        }           
        }); 
    });
});
</script>
@endsection
