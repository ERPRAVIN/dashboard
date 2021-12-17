<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Add</title>
  </head>
  <body>
        <!-- Form to add Product -->
        <div class="container-fluid " align="center">
        <div class="col-md-4" align="left">      
            <form  method="POST" action="/product.update" enctype="multipart/form-data">
            @csrf
                <h2>Fill Data</h2>
                <div class="form-group">                    
                    <input type="hidden" class="form-control" id="product_id" name="product_id" value="{{$productArr->id}}" >        	
                </div> <br>
                <div class="form-group">                    
                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{$productArr->product_name}}"  placeholder="Enter Product Name"  > 
                    @if ($errors->has('product_name'))
                    <span class="text-danger">{{ $errors->first('product_name') }}</span>
                    @endif          	
                </div> <br>

                <div class="form-group">
                    <input type="text" class="form-control" id="product_price" name="product_price" value="{{$productArr->product_price}}"   placeholder="Enter Product Price" >
                    @if ($errors->has('product_price'))
                    <span class="text-danger">{{ $errors->first('product_price') }}</span>
                    @endif  
                </div>   <br>

                <div class="form-group">
                    <h5>Select Product pic to upload:</h5>
                    <input type="file" id="product_image" name="product_image"  > <br>
                    @if ($errors->has('product_image'))
                    <span class="text-danger">{{ $errors->first('product_image') }}</span>
                    @endif  
                </div><br>

                <div class="form-group">
                <img src="{{'/storage/product/'.$productArr->product_image}}" height="100" width="100" >    
                </div><br>    
                <div class="form-group ">
                    <button type="submit" class="btn btn-success btn-lg btn-block"  >Update Product</button>     
                </div>
            </form>     
            
          
        </div>  
        </div> 



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
