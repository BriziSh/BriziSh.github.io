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
      <title>Brizi - Contact</title>
      
      @include('home-page.css_section')

   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home-page.header_section')
    </div>
    
        <div class="heading_container heading_center">
            <h2>
               Contact <span>Us</span>
            </h2>
         </div> 

         <br>
         <!-- end header section -->
      
             
      @include('home-page.session_section')

      
      <div class="div_center">
       
        {{-- <h3>Contact Us</h3> --}}
        
        <p>
            For immediate assistance, Brizi customers can contact us by email at brizi.sh195@gmail.com, or by telephone Toll Free at +355 69 984 9080
            <br>
            Need help with an order? Having difficulty using our site? Please use this form for all customer service questions or problems.
        </p>
    

{{-- id="issue_form" --}}
      <form action="send_issue" method="POST" onsubmit="myFunction()" class="contact-form">
        @csrf
        <label>Your email:</label><br>
        <input type="text" name="email" class="fixed_in_height search-box" value="{{old('email')}}"><br>
        @error("email") <p class="error">*{{$message}}</p> @enderror

        <label>Issue object:</label><br>
        <input type="radio" name="subject" id="radioselect" checked> 
        <select id="subselect" class="fixed_in_height search-box" onfocus="document.getElementsByName('subject')[0].checked=true">
            <option value="">Select from this list</option>
            <option>Where is my order</option>
            <option>Change my order</option>
            <option>Help me find a product</option>
            <option>I'd like to change my account information</option>
        </select><br>
        <input type="radio" name="subject" id="radiowrite">
        <input type="text" placeholder="Write your own subject" id="subwrite" class="fixed_in_height search-box" onfocus="document.getElementsByName('subject')[1].checked=true"><br>
        @error("subject") <p class="error">*{{$message}}</p> @enderror

        <label>Order Number:</label><br>
        <input type="text" placeholder="Order No. from Orders" value="{{old('numorder')}}" name="numorder" class="fixed_in_height search-box"><br>
        @error("numorder") <p class="error">*{{$message}}</p> @enderror
        
        <label>Description of issue or question:</label><br>
        <textarea name="description">{{old('description')}}</textarea>
        @error("description") <p class="error">*{{$message}}</p> @enderror

        <input type="submit" value="Send">
      </form>
    </div>
      <!-- footer start -->
      @include('home-page.footer_section')
      <!-- footer end -->

      <!-- rights reserved start -->
      @include('home-page.rights_section')
      <!-- rights reserved end -->
      
      @include('home-page.js_section')

   </body>
</html>