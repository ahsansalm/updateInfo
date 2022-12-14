<html>
    <head>
         <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>PDF Inventaire</title>
        <!-- CSS only -->
        <style>

/*---------- TABLES ----------*/
/*----- basics -----*/
.user_pdf {
  border-collapse: collapse;
  border-bottom: 1px solid rgb(0, 0, 0, 0.2);

  max-width: 2000px;
  width: 100%;

  margin: 10px auto 20px auto;
}

/*----- table headings -----*/
.user_pdf th {
  background-color: #0c1741;
  border: 1px solid black;
  padding: 10px;
  color: white;
  text-align: left;
  font-size: 18px;
}


/*----- table data (a cell) -----*/
.user_pdf td {
  padding: 8px;
  border-bottom: 1px solid black;
  border: 1px solid rgb(0, 0, 0, 0.2);
}


/*----- table row hover animation -----*/
.user_pdf tr {
  transition: background-color 0.5s;
}
.user_pdf tr:hover {
  background-color: #e8e8e8;
}

.user_pdf td {
  transition: background-color 0.4s;
}
        </style>
    </head>
    <body>
        <h4>Détail de l'inventaire :</h4>
            <table class="user_pdf">
                <tr>
                    <th>#</th>
                    <th>Marque</th>
                    <th>Produit</th>
                    <th>Service</th>
                    <th>Prix ​​d'achat</th>
                    <th>Prix ​​de vente</th>
                    <th>Stocker</th>
                </tr>
                
            @foreach($services as $service)
                <tr>
                    <td>{{$service->id}}</td>
                    <td>{{$service->brand->product_name}}</td>
                    <td>{{$service->product->product_name}}</td>
                    <td>{{$service->service}}</td>
                    <td>{{$service->purchase_price}}</td>
                    <td>{{$service->price}}</td>
                    <td>{{$service->stock}}</td>
                </tr>
            @endforeach    
                
            </table>
    </body>
</html>