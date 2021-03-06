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
    <div class="col-10 col-sm-5 col-md-5 col-lg-3 py-3 login-form">
      <div class="logo-brand text-center">
        <img src="{{ url('images/logo.gif') }}" alt="Logo" height="100">
      </div>
      <div class="card mt-4">
        <div class="card-header">
          <h3 class="text-center">Login Page</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('login_action') }}" method="POST" onsubmit="submitLoginForm();">
            @csrf
            <div class="mb-3 row">
              <label for="username" class="col-sm-4 col-form-label">Username</label>
              <div class="col-sm-8">
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" autofocus>
                @error('username')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="mb-3 row">
              <label for="password" class="col-sm-4 col-form-label">Password</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" id="password" name="password">
              </div>
            </div>
            <div class="mb-3 row">
              <div class="offset-sm-4 col-sm-8">
                <button type="submit" class="btn btn-secondary btn-login">Login</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div> 
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  @include('_partials._scripts')

  <script>
    function submitLoginForm(){
      $('.btn-login').html('Waiting ...');
      $('.btn-login').attr('disabled', true);
    }
  </script>
</body>
</html>