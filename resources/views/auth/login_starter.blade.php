<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
  </head>
<body>
  <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-10 col-sm-5 col-md-4 py-3 text-center login-starter" style="display: block;">
      <h1 class="mb-3">Brand Name</h1>
      <a class="btn btn-secondary btn-cta-login" href="{{ route('login') }}" onclick="showLoginForm();">Login</a>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  @include('_partials._scripts')

  <script>
    function showLoginForm(){
      $('.btn-cta-login').text('Waiting ...');
      $('.btn-cta-login').attr("readonly", "readonly");
    }
  </script>
</body>
</html>