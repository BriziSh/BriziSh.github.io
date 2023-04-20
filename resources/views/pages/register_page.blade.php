<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register</title>
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
              <p class="login-card-description">Create a new account</p>
              <form action="{{route('createUser')}}" method="POST" class="margin-center">
                @csrf
                  <div class="form-group">
                    <label for="name" class="sr-only">Full name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" value={{old('name')}}>                    @error('email')<span class='error'>*{{$message}}</span>@enderror
                    @error('name')<span class='error'>*{{$message}}</span>@enderror
                  </div>
                  <div class="form-group mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email Address"  value={{old('email')}}>
                    @error('email')<span class='error'>*{{$message}}</span>@enderror
                  </div>

                  {{-- fshije --}}      
                  {{-- <div class="form-group mb-4">
                    <label for="phone" class="sr-only">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number"  value={{old('phone')}}>
                    @error('phone')<span class='error'>*{{$message}}</span>@enderror
                  </div> --}}
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    @error('password')<span class='error'>*{{$message}}</span>@enderror
                  </div>
                  <div class="form-group mb-4">
                    <label for="password_confirmation" class="sr-only">Confirm password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re-enter Password">
                  </div>
                  <input class="btn btn-block login-btn mb-4" type="submit" value="Signup">
                </form>
                <p class="login-card-footer-text">You already have an account? <a href="login" class="text-reset">Login here</a></p>
                <nav class="login-card-footer-nav" style="margin-top: -30px">
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
