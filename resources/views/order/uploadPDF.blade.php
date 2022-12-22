@extends('layouts.informathic3')
@section('content')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript" src="http://www.position-absolute.com/creation/print/jquery.printPage.js"></script>



<div class="row">
    <div class="col-12">
        
                <div class="dashboard_image">
                    <h1 class="text-center mt-5">Télécharger le PDF</h1> </button>
                        </a>
                </div>
    </div>








    <div class="col-12 mt-2">  
        <form action="{{url('/upload/pdf/'.$device->id)}}" method='POST' enctype="multipart/form-data">
            @csrf
            <div class="card">
                
                <div class="card-body">
                    <label for=""><b class="text-dark">Télécharger le PDF:</b></label>
                <input type="file" id="pdf" name="pdf" class="form-control">
                <input type="hidden" id="pdf" name="userId" value="{{$device->userId}}" class="form-control">
                @error('pdf')
                    <span class="text-danger">{{$message}}</span>
                @enderror




                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{url('/userOrder')}}">
                                    <button type="button" class="default-btn prev-step btn-block btn-secondary">Retour</button>
                                </a>
                            </div>

                            <div class="col-md-6">
                                <button type="submit" class="default-btn next-step  btn-block btn-primary">Télécharger</button>
                            </div>

                            
                        </div>




                
            </div>
        
        </form>
    </div>
</div>



@endsection