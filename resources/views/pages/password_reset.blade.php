<!DOCTYPE html>
<html lang="en">
<head>
  <base href="http://localhost/e-commerce/public/home-file">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  @include('pages.css_section')

</head>
<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">

      @include('pages.session_section')

      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="images/login.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7 text-center">
            <div class="card-body">
              <a href="{{url('/')}}"><img class="logo-image" src="images/logoja.png" alt="#" /></a>
              <p class="login-card-description">Choose a new password</p>
              <form action="{{route('confirmNewPassword')}}" method="POST" class="margin-center">
                @csrf
                
                  <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email address" value="{{$user_email}}" readonly>
                    @error('email')<span class='error'>*{{$message}}</span>@enderror
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">New Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="New Password">
                    @error('password')<span class='error'>*{{$message}}</span>@enderror
                  </div>
                  <div class="form-group mb-4">
                    <label for="password_confirmation" class="sr-only">Confirm new password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re-enter New Password">
                  </div>
                  <input class="btn btn-block login-btn mb-4" type="submit" value="Confirm">
                </form>
                <a href="login" class="login-card-footer-text">&lt;&lt;&lt; Go back to Login page</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  @include('pages.js_section')

</body>
</html>
