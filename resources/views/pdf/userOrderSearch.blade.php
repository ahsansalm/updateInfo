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
              <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                    <h4>Commande de l'utilisateur :</h4>
                        <table class="table-bordered text-center" style="width: 90%">
                            <thead style="background: rgb(12, 23, 65);">
                                <tr>
                                    <th scope="col" class="text-white">#</th>
                                    <th scope="col" class="text-white">Nom d'utilisateur</th>
                                    <th scope="col" class="text-white">Des marques</th>
                                    <th scope="col" class="text-white">Produit</th>
                                    <th scope="col" class="text-white">Demande de service</th>
                                    <th scope="col" class="text-white">Statut</th>
                                    <th scope="col" class="text-white">Prix</th>
                                    <th scope="col" class="text-white">Prix ​​d'achat</th>
                                    <th scope="col" class="text-white">Date</th>
                                </tr>

                            </thead>
                            <tbody>
                            @foreach($devices as $device)
                                        <tr>
                                        <th scope="row"><b class="text-dark">{{$device->productId}}</b></th>
                                            <th scope="row" hidden><b class="text-dark">{{$device->id}}</b></th>
                                            <td><b>{{$device->user->firstname}} {{$device->user->lastname}} </b></td>
                                            <td><b class="text-dark">{{$device->marks}}</b></td>
                                            <td>{{$device->product}}</td>
                                            <td>{{$device->servicedata->service}}</td>
                                            <td><span class="badge bagde-sm bg-success">{{$device->status}}</span></td>
                                            <td>{{$device->servicedata->price}} €</td>
                                            <td>{{$device->servicedata->purchase_price}} €</td>
                                            <td>{{$device->date}} </td>
                                        </tr>
                                @endforeach
                            </tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>          
    </body>
</html>