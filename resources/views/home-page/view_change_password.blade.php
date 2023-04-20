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
                  Change <span>Password</span>
               </h2>
            </div> 
   
            @include('home-page.session_section')
     
            <img src="" alt="">
            <form method="POST" action="change_user_password">
               @csrf
               
               <label>Old Password: </label><input type="password" name="old_pass" class="fixed_in_height" placeholder="***********"><br>
               @error("old_pass") <p class="error">*{{$message}}</p> @enderror
               <label>New Password: </label><input type="password" name="new_pass" class="fixed_in_height" placeholder="***********"><br>
               @error("new_pass") <p class="error">*{{$message}}</p> @enderror
               <label>Repeat New Password: </label><input type="password" name="new_pass_confirmation" class="fixed_in_height" placeholder="***********"><br>
               @error("new_pass_confirmation") <p class="error">*{{$message}}</p> @enderror
               <input type="submit" value="Confirm">
           </form>
            <br>
         </div>
      
      @include('home-page.footer_section')

      <!-- rights reserved start -->
      @include('home-page.rights_section')
      <!-- rights reserved end -->
      
      @include('home-page.js_section')
   </body>
</html>