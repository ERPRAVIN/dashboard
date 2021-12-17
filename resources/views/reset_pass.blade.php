<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Reset Password</title>
  </head>
  <body>
 
    <div class="container col-md-6" >
    <h1>Reset Password</h1>
     
    <form method="post" action="/ResetPassword"> 
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
      @csrf
     
      <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" autocomplete="off" placeholder="Enter Old Password" maxlength="10">
        @if ($errors->has('password'))
        <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="newpassword" name="newpassword" autocomplete="off" placeholder="Enter New Password" maxlength="10">
        @if ($errors->has('newpassword'))
        <span class="text-danger">{{ $errors->first('newpassword') }}</span>
        @endif
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" autocomplete="off" placeholder="Re-enter New Password" maxlength="10">
        @if ($errors->has('confirmpassword'))
        <span class="text-danger">{{ $errors->first('confirmpassword') }}</span>
        @endif
      </div>
      <button type="submit" class="btn btn-primary">Change Password</button> <br>  
    </form>
    </div>

   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>