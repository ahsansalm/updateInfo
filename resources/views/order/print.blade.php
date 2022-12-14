@extends('layouts.informathic3')
@section('content')
<script type="text/javascript" src="{{asset('admin/assets/js/printPage.js')}}"></script>
<div class="row">
    <div class="col-12">  
        <form action="{{url('/order/approved/'.$device->id)}}" method='POST'>
            @csrf
            <div class="card">
                <div class="dashboard_image">
                    <h1 class="text-center mt-5">Détail de la commande de l’utilisateur</h1> </button>
                        </a>
                </div>
                <div class="card-body">



                    <table class="table">
                        <thead class="thead-custom">
                        <tr >
                            <th class="text-white" scope="col">Données produit</th>
                            <th class="text-white"  scope="col">Informations</th>
                            </tr>
                        </thead>
                        <tbody class="text-dark">
                        <tr>
                            <td><h6>Code produit:</h6></td>
                            <td colspan="2"><p>{{$device->product_code}}</p></td>
                            </tr>
                            
                            <tr>
                            <td><h6>Code à barre :</h6></td>
                            <td class="mt-2">
                            @php
                                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                            @endphp
                            {!! $generator->getBarcode($device->product_code, $generator::TYPE_CODE_128) !!}

                            </td>
                            </tr>
                        </tbody>
                        <button id="btn">Print</button>
                    </table>

                


                
                </div>
            </div>
        
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function(){
  $("#btn").click(function () {
    window.print();
});


});
</script>


@endsection