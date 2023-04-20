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
      <title>Famms</title>

      

      @include('home-page.css_section')

      <style>
         /* stilet extra */
         .product_section .options .option2 {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 30px;
            width: 165px;
            text-align: center;
            -webkit-transition: all .3s;
            transition: all .3s;
            margin: 5px 0;
         }
      </style>

      <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

      <script type="text/javascript">
         function reply(caller){
            var commentId = $(caller).attr('data-commentId');
            var replyBox = document.getElementById('comment_id');
            replyBox.value=commentId;
            $('.replyClass').insertAfter($(caller));
            $('.replyClass').show();
         }

         function close_reply(caller){
            $('.replyClass').hide();
         }
      </script>
   </head> 
   <body>
      

      <div class="hero_area" style="min-height: 100vh;">
         <!-- header section strats -->
         @include('home-page.header_section')
         <!-- end header section -->
         @include('home-page.session_section')
         <!-- slider section -->
         @include('home-page.slider_section')
         <!-- end slider section -->
      </div>
      <!-- why section -->
      @include('home-page.why_section')
      <!-- end why section -->
      
      <!-- arrival section -->
      @include('home-page.arrival_section')
      <!-- end arrival section -->
      
      <!-- product section -->
      @include('home-page.product_section')
      <!-- end product section -->
      {{-- <hr> --}}
      <!--comment and reply section--> 
      {{-- @include('home-page.comment_section') --}}
      <!--end comment and reply section-->

      <!-- subscribe section -->
      @include('home-page.subscribe_section')
      <!-- end subscribe section -->
 
      <!-- client section -->
      @include('home-page.client_section')
      <!-- end client section -->

      <!-- footer start -->
      @include('home-page.footer_section')
      <!-- footer end -->

      <!-- rights reserved start -->
      @include('home-page.rights_section')
      <!-- rights reserved end -->


      @include('home-page.js_section')

   </body>
</html>
