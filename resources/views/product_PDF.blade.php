<!doctype html>
<html lang="en">
  <head>
    <title>Student pdf</title>
  </head>
  <body>
    <div class="container">
        <h1>Product Name:  {{$product_name}}</h1>  <br>
        <h1>Product Price: {{$product_price}}</h1> <br>

        </div>
    <div class="container">
        <img src="{{public_path('/storage/product/'.$product_image)}}" height="200" width="200" >
    </div>

  </body>
</html>
