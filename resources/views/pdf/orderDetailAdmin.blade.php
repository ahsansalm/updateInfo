<html>
    <head>
         <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>PDF User</title>
        <!-- CSS only -->
        <style>

        </style>
    </head>
    <body>
              <div class="container-fluid" style="font-size: 15px;">
                <div class="row">
                    <div class="col-12">
                    <h4 class="text-center">Détail de la commande de l'utilisateur :</h4>
                    <table class="table-bordered text-center" style="width: 90%;">
                    <thead style="background: rgb(12, 23, 65);">
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



                    <table class="table-bordered text-center" style="width: 90%;">
                        <thead style="background: rgb(12, 23, 65);">
                        <tr >
                            <th class="text-white" scope="col">#</th>
                            <th class="text-white" scope="col">Données produit</th>
                            <th class="text-white"  scope="col">Informations</th>
                            </tr>
                        </thead>
                        <tbody class="text-dark">
                            
                            <tr>
                            <th scope="row">1</th>
                            <td><h6>Code produit:</h6></td>
                            <td ><p id="codeA">{{$device->product_code}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td hidden   id="userId2" >{{$device->userId}}</td>
                            <td hidden id="userId">{{$device->id}}</td>
                            <td><h6>Marques :</h6></td>
                            <td ><p  id="brandA">{{$device->marks}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td><h6>Produit:</h6></td>
                            <td ><p  id="productA">{{$device->product}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">4</th>
                            <td><h6>Demande de service :</h6></td>
                            <td hidden><input type="hidden" value="{{$device->serviceRequest}}" name="serviceId"></td>
                            <td  id="serviceA">{{$device->servicedata->service}}</td>
                            </tr>
                            <tr>
                            <th scope="row">5</th>
                            <td><h6>Commandez par l’intermédiaire de:</h6></td>
                            <td ><p  id="shipA">{{$device->shipment}}</p></td>
                            </tr>
                            <tr>
                            <th scope="row">6</th>
                            <td><h6>Prix :</h6></td>
                            <td  id="priceA">{{$device->parcel->totalPrice}}</td>
                            </tr>

                            <tr>
                            <th scope="row">7</th>
                            <td><h6>Mot de passe ou code PIN :</h6></td>
                            <td  id="pinA"><p>{{$device->pin}}</p></td>
                            </tr>

                            <tr>
                            <th scope="row">8</th>
                            <td><h6>Modèle de mot de passe :</h6></td>
                            <td ><p  id="pattA">{{$device->pattern}}</p></td>
                            </tr>
<!-- 
                            <th scope="row">9</th>
                            <td><h6>Code à barre :</h6></td>
                            <td class="mt-2">
                            <img id="printTable" src="../../{{$device->barcode}}" alt="">
                            <button class="btn btn-sm ml-3" type='button' id='buttonprint'>
                                <i class="fa fa-print" style="font-size:20px"></i>
                            </button>
                            </td>
                            </tr> -->
                        </tbody>
                        
                    </table>
                
                    </div>


                </div>
              </div>          
    </body>
</html>