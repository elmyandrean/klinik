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
    <div class="col-10 col-sm-4 col-md-3 py-3">
      <h1 class="text-center mb-3">Brand Name</h1>
      <div class="card">
        <div class="card-header">
          <h3 class="text-center">Login Page</h3>
        </div>
        <div class="card-body">
          <form action="#" method="POST">
            @csrf
            <div class="mb-3 row">
              <label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9">
                <input type="text" readonly class="form-control" id="staticEmail" value="email@example.com">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="inputPassword">
              </div>
            </div>
            <div class="mb-3 row">
              <div class="offset-sm-3 col-sm-9">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div> 
  </div>
</body>
</html>