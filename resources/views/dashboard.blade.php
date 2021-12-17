
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Dashboard</title>


    <style>
          /* The side navigation menu */
    .sidebar {
      margin: 0;
      padding: 0;
      width: 200px;
      background-color: #f1f1f1;
      position: fixed;
      height: 100%;
      overflow: auto;
     }



    /* Sidebar links */
    .sidebar a {
      height: 58px;
      display: block;
      color: black;
      padding: 16px;
      text-decoration: none;
     }

     .sidebar div.dash{
      height: 58px;
      background-color: #04AA6D;
      color: white;
      padding: 16px;
      text-decoration: none;
      background-color: #04AA6D;

     }

    /* Active/current link */
    .sidebar a.active {
      /* background-color: #04AA6D;
      color: white; */
      height: 58px;
      background-color: #04AA6D;
      color: white;
      padding: 16px;
      text-decoration: none;
      background-color: #04AA6D;
      }

    /* Links on mouse-over */
    .sidebar a.link:hover:not(.active) {
      background-color: #555;
      color: white;
      }

    /* Page content. The value of the margin-left property should match the value of the sidebar's width property */
    div.content {
      margin-left: 184px;
      padding: 0px 0px;
      height: 100%;

      }
      div.search {
      margin-top: 4px;
      margin-bottom: 4px;
      margin-left: 18px;
      padding: 0px 0px;

      }



            #table
            {
                width:90%;
            }
            th{
              text-align: center;
            }
            td
            {
                text-align: center;
                color: #344b79;
                background-color: whitesmoke;
                font-size: 18px;
            }
            div.pagination{
              justify-content: center;

              font-size: 10px;
            }

    /* On screens that are less than 700px wide, make the sidebar into a topbar */
    @media screen and (max-width: 700px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
      .sidebar a {float: left;}
      div.content {margin-left: 0;}
      }

    /* On screens that are less than 400px, display the bar vertically, instead of horizontally */
    @media screen and (max-width: 400px) {
      .sidebar a {
        text-align: center;
        float: none;
      }
      }
    </style>



  </head>
  <body>


    <!-- The sidebar -->
    <div class="sidebar ">
    <a href="{{ url('dashboard') }}" class="bg-dark text-light"> <h3>Dashboard</h3></a>

      <a href="{{ url('reset') }}">Change Password</a>
      <a href="{{ url('logout') }}">Logout</a>
    </div>

    <!-- Page content -->
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
            <div class="container col-md-9" >
              <div class="navbar-brand" >Products</div >
            </div>
            <div class="container col-md-3">
              <div class="navbar-brand" >
              @php $authemail = auth()->user()->name; @endphp
                <h5 >User:{{$authemail}}</h5>
              </div>
            </div>
        </nav>
          <div class="container"> @if(session()->has('successMsg'))
                    <div class="alert alert-success">
                        {{ session()->get('successMsg') }}
                    </div>
                @endif
                @if(session()->has('deleteMsg'))
                    <div class="alert alert-danger">
                        {{ session()->get('deleteMsg') }}
                    </div>
                @endif
          </div>


        <div class="container search"  >
          <div class="row" align="center">
          <div class="col-md-6" align="left">
            <form class="form-inline" action="/search" method="POST" role="search">
              @csrf
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
          </div>
          <div class="col-md-6"  >
          <a href="/add_product" ><button type="button" class="btn btn-success">Add New Record</button></a>
          </div>
          </div>
        </div>


        <div class="container" align="center">
            <table class="table">
              <thead >
                <tr >
                    <th  scope="col">#</th>
                    <th  scope="col">Product Image</th>
                    <th  scope="col">Product name</th>
                    <th  scope="col">Product Price</th>
                    <th  scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                $i = 1;
                @endphp
                @if(!empty($productArr) && $productArr->count())
                  @foreach($productArr as $product)
                      <tr>
                        <td>{{$i}}</td>
                        <td><img src="{{asset('/storage/product/'.$product->product_image)}}" height="20" width="100" ></td>
                          <td>{{ $product->product_name }}</td>
                          <td>{{$product->product_price}}  Rs.</td>
                          <td><a href="{{ url('delete', $product->id) }}" Onclick="return ConfirmDelete();"><button  type="button" class="btn btn-danger">Delete</button></a>
                              <a href="{{ url('update', $product->id) }}"  ><button type="button" class="btn btn-primary">update</button></a>
                              <a href="{{ url('generatepdf', $product->id) }}"><button type="button" class="btn btn-primary">Zip</button></a>
                              <a href="{{ url('downloadpdf', $product->id) }}"><button type="button" class="btn btn-primary">Pdf</button></a>
                          </td>
                      </tr>
                      @php
                $i += 1;
                @endphp
                @endforeach
                @else
                  <tr>
                      <td colspan="10">There are no data.</td>
                  </tr>
                @endif
              </tbody>
            </table>
             <div class="pagination">
             {{ $productArr->links() }}
        </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
      function ConfirmDelete()
      {
        return confirm("Are you sure you want to delete?");
      }
    </script>
  </body>
</html>
