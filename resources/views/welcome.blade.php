<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="col-sm-6 mx-auto">
            <div class="card mt-5 shadow bg-secondary rounded" style="height:370px;">
            @if(session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
@endif
<form method='POST' action="{{ route('handlelogin')}}" class="text-white pl-2 mt-2 mx-auto">
    @csrf
    <div class="formheading text-center text-white">
        <h1>Login Form</h1>
    </div>
    <div class="mb-3">
        <label for="inputEmail" class="form-label">Email address</label>
        <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text text-dark">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="inputPassword" class="form-label">Password</label>
        <input type="password" class="form-control" id="inputPassword" name="password">
    </div>
    <div class="button text-center">
        <button type="submit" class="btn btn-primary">Submit</button><br>
        <a href="{{ route('userRegister')}}" class="text-white">Registration Here</a>
    </div>
</form>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"></script>
    <scipt src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  </body>
</html>
    
