@extends('layouts.informathic2')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="col-12 text-center">
                <div class="dashboard_image" >
                    <h1 class="brand_device mt-5">Voir ma facture</h1> 
                </div>
            </div>
            <div class="card-body">
            <form action="{{url('search/bill')}}">
                <div class="row">
                       <div class="col-10">
                            <input type="search" class="form-control"  value="{{$search}}"   name="search" placeholder="Rechercher une commande par nom de produit...">
                        </div>
                        <div class="col-2">
                         <button type="submit" class="btn btn-block btn-primary">Chercher</button>

                        </div>
                    </div>
               </form>
                    <table class="table mt-2">
                        <thead style="background: rgb(12, 23, 65);">
                        <tr>
                                <th scope="col" class="text-white">#</th>
                                <th scope="col" class="text-white">Titre</th>
                                <th scope="col" class="text-white">Prix ​​total</th>
                                <th scope="col" class="text-white">Date</th>
                                <th scope="col" class="text-white">Statut</th>
                                <th scope="col" class="text-white">Payer Statut</th>
                                <th scope="col" class="text-white">Payer</th>
                                    <th scope="col" class="text-white">Un d. Payé</th>
                                <th scope="col" class="text-white" style="width: 80px;">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($invoices as $invoice)
                                <tr>
                                    <th scope="row"><b class="text-dark">{{$i++}}</b></th>
                                    <td>{{$invoice->neww->product}}</td>
                                    <td><b class="text-dark">{{$invoice->totalPrice}}</b></td>
                                    <td>{{$invoice->date}}</td>
                                    @if($invoice->status =='Approuvé')
                                    <td><span class="badge badge-success">{{$invoice->status}}</span></td>
                                      @elseif($invoice->status =='en attendant')
                                        <td><span class="badge" style="background: #FF7F50">{{$invoice->status}}</span></td>
                                    @else
                                    <td><span class="badge badge-danger">{{$invoice->status}}</span></td>
                                    @endif

                                    @if($invoice->payStatus =='Payé')
                                    <td><span class="badge badge-primary">{{$invoice->payStatus}}</span></td>
                                    @else
                                    <td><span class="badge badge-danger">{{$invoice->payStatus}}</span></td>
                                    @endif

                                    @if($invoice->adminPaid =='Payé')
                                    <td><span class="badge bagde-sm bg-primary">Payé</span></td>
                                        @else
                                    <td><span class="badge bagde-sm bg-danger">{{$invoice->adminPaid}}</span></td>
                                    @endif


                                   

                                    <td>
                                            <a href="{{url('/Mybill/Payer/'.$invoice->id)}}">
                                                <button type="button" class="btn btn-success btn-sm">Payer</button>
                                            </a>
                                    </td>

                                    <td>
                                            <a href="{{url('/Mybill/Detail/'.$invoice->id)}}">
                                                <button type="button" class="btn btn-outline-primary btn-sm"><i style="font-size: 16px;" class="fa fa-eye pl-2"></i></button>
                                            </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    </div>
@endsection