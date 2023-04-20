<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Forgot Password</title>

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
              <p class="login-card-description">Forgot your password?</p>
              <p>No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p><br>
              <form action="{{route('sendReset')}}" method="POST" class="margin-center">
                @csrf
                  <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email address"  value={{old('email')}}>
                    @error('email')<span class='error'>*{{$message}}</span>@enderror
                  </div>
                  <input class="btn btn-block login-btn mb-4" type="submit" value="Email Password Reset Link">
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
