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
                    <h4>Liste de produits :</h4>
                        <table class="table-bordered text-center" style="width: 90%">
                            <thead style="background: rgb(12, 23, 65);">
                                <tr>
                                    <th scope="col" class="text-white px-2">#</th>
                                    <th scope="col" class="text-white px-2">Marque</th>
                                    <th scope="col" class="text-white px-2">Nom du produit</th>
                                    <th scope="col" class="text-white px-2">Image</th>
                                    <th scope="col" class="text-white px-2">Créé à</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach($devices as $device)
                                        <tr>
                                            <th scope="row">{{$device->id}}</th>
                                            <th scope="row">{{$device->brand->product_name}}</th>
                                            <th scope="row">{{$device->product_name}}</th>
                                            <td class="py-2"><img src="{{$device->image}}  " style="height: 30px; width 20px;" alt=""></td>
                                            <td class="px-2">{{$device->created_at}} </td>
                                           
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>          
    </body>
</html>