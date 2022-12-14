@extends('layouts.informathic3')
@section('content')
<div class="row">
    <div class="col-12">  
        <form action="{{url('/order/notes/'.$device->id)}}" method='POST'>
            @csrf
            <div class="card">
                <div class="dashboard_image">
                    <h1 class="text-center mt-5">Notes d'administration</h1> </button>
                        </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="thead-custom">
                        <tr >
                            <th class="text-white" scope="col">Remarque privée</th>
                            <th class="text-white" scope="col">Avis public</th>
                            </tr>
                        </thead>
                        <tbody class="text-dark">
                            <tr>
                            <td>
                                <textarea rows="3" name="privateNote" value="{{$device->privateNote}}" class="form-control">{{$device->publicNote}}</textarea>
                            </td>
                            <td>
                                <textarea   rows="3"name="publicNote" value="{{$device->publicNote}}"class="form-control">{{$device->privateNote}}</textarea>
                            </td>
                            </tr>
                        </tbody>
                    </table>

                

                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{url('/userOrder')}}">
                                    <button type="button" class="default-btn prev-step btn-block btn-secondary">Retour</button>
                                </a>
                            </div>

                            <div class="col-md-6">
                                <button type="submit" class="default-btn next-step  btn-block btn-primary">Ajouter</button>
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