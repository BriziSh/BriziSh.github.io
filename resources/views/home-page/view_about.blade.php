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
      <title>Famms - About Us</title>
     
      @include('home-page.css_section')
   </head>
   <body>
      <div class="hero_area" style="min-height: 100vh;">
         <!-- header section strats -->
         @include('home-page.header_section')
         <!-- end header section -->
      

      <section class="slider_section ">
        <div class="slider_bg_box">
           <img src="images/template1.jpg" alt="">
        </div>
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
           <div class="carousel-inner">
              <div class="carousel-item active">
                 <div class="container ">
                    <div class="row">
                       <div class="col-md-7 col-lg-6 ">
                          <div class="detail-box">
                             <h1>
                                <span>
                                 Hello & welcome 
                                </span>
                                to Brizi!
                             </h1>
                             <p>
                              Hello and welcome to Brizi, the place to find the best skincare products for every taste and occasion. We thoroughly check the quality of our products, working only with reliable suppliers so that you only receive the best quality.
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
              <div class="carousel-item ">
                 <div class="container ">
                    <div class="row">
                       <div class="col-md-7 col-lg-6 ">
                          <div class="detail-box">
                             <h1>
                                <span>
                                High
                                </span>
                                Quality
                             </h1>
                             <p>
                              We at Famms believe in high quality and exceptional customer service. We strive to deliver the best products at the most affordable prices, and ship them accross Albania.
                             </p>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
              <div class="carousel-item">
                 <div class="container ">
                    <div class="row">
                       <div class="col-md-7 col-lg-6 ">
                          <div class="detail-box">
                             <h1>
                                <span>
                                Costumers
                                </span>
                                Our Priority!
                             </h1>
                             <p>
                              The interests of our customers are always top priority for us, so we hope you will enjoy our products as much as we enjoy making them available to you. 
                             </p>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
           <div class="container">
              <ol class="carousel-indicators">
                 <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
                 <li data-target="#customCarousel1" data-slide-to="1"></li>
                 <li data-target="#customCarousel1" data-slide-to="2"></li>
              </ol>
           </div>
        </div>
     </section>
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