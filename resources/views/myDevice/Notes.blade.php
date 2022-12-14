@extends('layouts.informathic3')
@section('content')
<div class="row">
    <div class="col-12">  
        <form>
            <div class="card">
                <div class="dashboard_image">
                    <h1 class="text-center mt-5">Bordereau de colis</h1> </button>
                        </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="thead-custom">
                        <tr >
                            <th class="text-white" scope="col">Remarque public</th>
                            <!-- <th class="text-white" scope="col">Avis public</th> -->
                            </tr>
                        </thead>
                        <tbody class="text-dark">
                            <tr>
                            <td>
                                <textarea rows="3" name="publicNote" disabled value="{{$devices->publicNote}}" class="form-control">{{$devices->publicNote}}</textarea>
                            </td>
                            <!-- <td>
                                <textarea   rows="3"name="privateNote" value="{{$devices->privateNote}}"class="form-control">{{$devices->privateNote}}</textarea>
                            </td> -->
                            </tr>
                        </tbody>
                    </table>

                

                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{url('/MyDevices')}}">
                                    <button type="button" class="default-btn prev-step btn-block btn-secondary">Retour</button>
                                </a>
                            </div>
                        </div>

                
            </div>
        
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function(){
    // data submit using ajax
    $("#refuse").click(function () {
        var userId = $("#userId").text();
        console.log(userId)
        $.ajax({
                    url: '{{ url('/order/refuse') }}',
                    type:'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data:{'userId':userId},
                        success:function(success){   
                            if(success){
                                toastr.success(success.message,'Refus de commande!');
                                window.location.href = '/public/userOrder';
                                
                            }              
                        }           
        }); 
    }); 
});
</script>

@endsection