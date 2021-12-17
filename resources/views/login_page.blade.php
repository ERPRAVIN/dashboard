<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>LogIn</title> 
  </head>
  <body>
 
    <div class="container col-md-6" >
    <h1>LogIn Page</h1>
    @if (session('signin_fail'))
    <div class="alert alert-danger">
        {{ session('signin_fail') }}
    </div>
    @endif
    @if(!empty($success))
      <div class="alert alert-success"> {{ $success }}</div>
    @endif
    @if(!empty($successMsg))
    <div class="alert alert-success"> {{ $successMsg }}</div>
    @endif
    <form method="post" action="{{url('userLogin')}}">
      @csrf
      <div class="form-group">
        <input type="txt" class="form-control" id="email" value="{{old('email')}}" name="email" autocomplete="off" placeholder="Enter email" autofocus>
        @if ($errors->has('email'))
        <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" autocomplete="off" placeholder="Password" maxlength="10" autofocus> 
        @if ($errors->has('password'))
        <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>  
      </form>  <br> 
      <a href="forgot_password" style="color: red">Forgot Password</a><br>
    <a href="{{url('signup_page')}}">Don't have an account ? CREATE AN ACCOUNT</a>
    
    </div>

   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>