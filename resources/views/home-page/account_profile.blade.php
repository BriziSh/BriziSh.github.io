<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="home-files/images/favicon.png" type="">
      <title>Famms - Products</title>
    
      @include('home-page.css_section')
   </head> 
   <body>
      <!-- header section strats -->
      @include('home-page.header_section')
      <!-- end header section -->
      
      <!-- product section -->
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Account <span>Settings</span>
               </h2>
            </div> 
   
            @include('home-page.session_section')
     
            <img src="" alt="">
            <form method="POST" action="account_profile">
               @csrf
               @php $user = auth()->user() @endphp
               
               <label>Name: </label><input type="text" name="name" class="fixed_in_height" value="{{$user->name}}"><br>
               @error("name") <p class="error">*{{$message}}</p> @enderror
               <label>Email: </label><input type="text" name="email" class="fixed_in_height" value="{{$user->email}}" readonly><br>
               <label>Phone: </label><input type="text" name="phone" class="fixed_in_height" value="{{$user->phone}}"><br>
               @error("phone") <p class="error">*{{$message}}</p> @enderror
               <input type="submit" value="Confirm">
           </form>
            <br>
            <a href="view_user_password" style="color:#828B; text-decoration:underline">Change Password>></a>
         </div>
      
      @include('home-page.footer_section')

      <!-- rights reserved start -->
      @include('home-page.rights_section')
      <!-- rights reserved end -->
      
      @include('home-page.js_section')
   </body>
</html>