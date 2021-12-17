
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>SignUpPa</title>
  </head>
  <body>
    
    <div class="container col-md-6" >
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if (session('fail'))
    <div class="alert alert-danger">
        {{ session('fail') }}
    </div>
    @endif
    <h1>Registration</h1>
    <form method="POST" action="register">
    @csrf
      <div class="form-group">
        <input type="txt" class="form-control" id="name" name="name" autocomplete="off" value="{{old('name')}}" placeholder="Enter Your Name" autofocus>
        @if ($errors->has('name'))
          <span class="text-danger">{{ $errors->first('name') }}</span>
          @endif
      </div>
      <div class="form-group">
        <input type="txt" class="form-control" name="mobile" autocomplete="off" value="{{old('mobile')}}" placeholder="Enter Your Mobile No"  maxlength="10" autofocus>
        @if ($errors->has('mobile'))
        <span class="text-danger">{{ $errors->first('mobile') }}</span>
        @endif
      </div>
      <div class="form-group">
        <input type="txt" class="form-control" name="email" autocomplete="off" value="{{old('email')}}" placeholder="Enter email" autofocus>
        @if ($errors->has('email'))
        <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="password" autocomplete="off" placeholder="Password" maxlength="10" autofocus>
        @if ($errors->has('password'))
        <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
       
      </div>
      
      <a href="{{ url('/') }}" style="color: red">Already have an account? Sign-in</a><br>
      <button type="submit" class="btn btn-primary">Submit</button> 
    </form>
    </div>

   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>