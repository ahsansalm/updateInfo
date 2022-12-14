@extends('layouts.informathic')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

    <div class="row">
            <div class="col-12">
                <div class="card">
                   <div class="row text-center">
                        <div class="col-12">
                            <div class="dashboard_image">
                                <h1 class="brand_device mt-5">Tous les utilisateurs</h1> 
                            </div>
                            
                        </div>
                        
                        <div class="col-12">
                            <a href="{{url('userPDF')}}">
                            <input type="hidden" class="form-control" value="{{$search}}" name="search" placeholder="Ordre de recherche par nom d'utilisateur...">
                                <button type="button" class="btn btn-sm btn-success float-right m-2">Exporter PDF</button>
                            </a>
                        </div>
                   </div>
                   
                    <div class="card-body">
                    <form action="{{url('search/usersadmin')}}">
                <div class="row">
                        <div class="col-10">
                            <input type="search" class="form-control"  value="{{$search}}" name="search" placeholder="Chercher...">
                        </div>
                        <div class="col-2">
                         <button type="submit" class="btn btn-block btn-primary">Chercher</button>

                        </div>
                    </div>
               </form>
                    <!-- users -->
                            <table class="table table-bordered w-100 text-dark mt-2 " id="users-table">
                                <thead style="background: rgb(12, 23, 65);">
                                    <tr>
                                        <th scope="col" class="text-white">#</th>
                                        <th scope="col" class="text-white">Prénom</th>
                                        <th scope="col" class="text-white">E-mail</th>
                                        <th scope="col" class="text-white">Statut</th>
                                        <th scope="col" class="text-white" style="width: 80px;">Option</th>
                                    </tr>
                                </thead>

                                @php($i=1)
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row"><b class="text-dark">{{$i++}}</b></th>
                                    <td><b class="text-dark">{{$user->name}}</b></td>
                                    <td>{{$user->email}}</td>
                                    @if($user->status =='Actif')
                                    <td><span class="badge bg-success">{{$user->status}}</span></td>     
                                    @else
                                    <td><span class="badge bg-danger">{{$user->status}}</span></td>                                      @endif

                                    <td>
                                    <a class="btn btn-sm btn-primary" href="{{URL('/User/detail/'.$user->id)}}">Détail </a>
                                    </td>

                                </tr>
                            @endforeach


                                
                               
                            </table>
                    </div>
                </div>
            </div>
        </div>

    


@endsection