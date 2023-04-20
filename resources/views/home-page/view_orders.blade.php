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
      <title>Famms - Orders</title>
     
      @include('home-page.css_section')

   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home-page.header_section')
         <!-- end header section -->
      </div>  

      @include('home-page.session_section')

      <div class="div_center">
        <div class="extra_paddings">
            <form action="" method="GET">
                <input type="text" name="search-user" class="search-box" placeholder="Search for something">
                <input type="submit" value="Search" class="search-btn">
            </form>
        </div>

        @if(isset($_GET["search-user"]) && $_GET["search-user"]!="") 
        <div class="search-results">
            <p>Search results for: '{{$_GET["search-user"]}}'</p>
        </div>
        @endif

        <table class="table_center" >
            <thead>
                <tr>
                    <th>ORDER</th>
                    <th>PRODUCT TITLE</th>
                    <th>QUANTITY</th>
                    <th>PRICE</th>
                    <th>ADDRESS</th>
                    <th>PAYMENT STATUS</th>
                    <th>DELIVERY STATUS</th>
                    <th>TIME ORDERED</th>
                    <th>IMAGE</th>
                    {{-- <th>CANCEL ORDER</th> --}}
                </tr>
            </thead>
            <tbody>
             
                @forelse ($orders as $order)
                       <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->cart->product->prod_title}}</td>
                        <td>{{$order->cart->quantity}}</td>
                        <td>${{$order->cart->price}}</td>
                        <td>{{$order->address}}</td>
                        <td>{{$order->payment_status}}</td>
                        <td>{{$order->delivery_status}}</td>
                        <td>{{explode(' ',$order->created_at)[0]}}</td>
                        <td>
                            @if($order->cart->product->prod_image==null) 
                            <img src="images/no-image.png" alt="Product Img" style="width:80px; height:80px;" class="table_img_size">
                            @else
                            <img src="images/products/{{$order->cart->product->prod_image}}" alt="Product Img"  class="table_img_size">
                            @endif
                        </td>
                        {{-- @if ($order->delivery_status=="processing")
                            <td><a href="cancel_order/{{$order->id}}" class="btn" style="color:white; background-color:#505050" onclick="return confirm('Are you sure to cancel this order?');">Cancel Order</a></td>
                        @elseif($order->delivery_status=="delivered")
                            <td class="price">Not Allowed</td>
                        @elseif($order->delivery_status=="cancelled")
                            <td class="price">Cancelled</td>
                        @endif --}}
                    </tr>
                @empty
                <tr>
                <td colspan="9">No results</td>
                </tr>
                @endforelse
           
            </tbody>
        </table>
        <div class="d-flex align-items-center justify-content-center">
            <div class="p-1">
                {{$orders->links("vendor.pagination.bootstrap-4")}}
            </div>
        </div>
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