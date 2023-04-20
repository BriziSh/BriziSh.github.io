<!DOCTYPE html>
<html lang="en">
<head>
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
              <div >
                <a href="{{url('/')}}"><img class="logo-image" src="images/logoja.png" alt="#"/></a>
              </div>
              
              <p class="login-card-description">Sign into your account</p>
              <form action="{{route('authenticateUser')}}" method="POST" class="margin-center">
                @csrf
                  <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email address"  value={{old('email')}}>
                    @error('email')<span class='error'>*{{$message}}</span>@enderror
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    @error('password')<span class='error'>*{{$message}}</span>@enderror<br>
                  </div>
                  <input class="btn btn-block login-btn mb-4" type="submit" value="Login">
                </form>
                <a href="{{route('forgotPassword')}}" class="forgot-password-link">Forgot password?</a>
                <p class="login-card-footer-text">Don't have an account? <a href="register" class="text-reset">Register here</a></p>
                <nav class="login-card-footer-nav">
                  <a href="terms_of_use" target="_blank">Terms of use.</a>
                  <a href="privacy_policy" target="_blank">Privacy policy</a>
                </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  @include('pages.js_section')

</body>
</html>
