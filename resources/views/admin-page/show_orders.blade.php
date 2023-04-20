<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>All Orders</title>
    <!-- plugins:css -->
    @include('admin-page.css_section')
  </head>
  <body>
    <!-- container-scroller starts -->
    <div class="container-scroller">

      <!-- partial:partials/_sidebar.html -->
      @include('admin-page.sidebar_section')

      <!-- page-body-wrapper starts -->
      <div class="container-fluid page-body-wrapper">

        <!-- partial:partials/_navbar.html -->
        @include('admin-page.header_section') 
        
        <!-- main-panel -->
        <div class="main-panel">
            <div class="content-wrapper">
                @include('admin-page.session_section')

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">All Orders</h4>
                      
                        <form  action="" method="GET">
                            <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" name="search" class="form-control" value="{{old('search')}}" placeholder="Search an order its number, by name or product" aria-label="Search an order its number, by name or product" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                            </div>
                            </div>
                        </form>
                          
                        @if(isset($_GET["search"]) && $_GET["search"]!="") 
                        <div class="search-results">
                            <p>Search results for: '{{$_GET["search"]}}'</p>
                        </div>
                        @endif
                        
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th class="fix-left">No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Product ID</th>
                                <th>Product Title</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Payment Status</th>
                                <th>Delivery Status</th>
                                <th>Date Ordered</th>
                                <th>Image</th>
                                <th>Delivered</th>
                                <th>Cancel Order</th>
                                <th>Print PDF</th>
                                <th>Send Email</th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                <tr>

                                    <td class="fix-left">{{$order->id}}</td>
                                    <td>{{$order->cart->user->name}}</td>
                                    <td>{{$order->cart->user->email}}</td>
                                    <td>{{$order->address}}</td>
                                    <td>{{$order->cart->user->phone}}</td>
                                    <td>{{$order->cart->product->id}}</td>
                                    <td>{{$order->cart->product->prod_title}}</td>
                                    <td>{{$order->cart->quantity}}</td>
                                    <td>{{$order->cart->price}}</td>
                                    <td>
                                        @if ($order->payment_status=="paid")
                                        <span class="text-success">paid</span>
                                        @else
                                        <span class="text-primary">cash on delivery</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order->delivery_status=="processing")
                                        <span class="text-primary">processing</span>
                                        @elseif($order->delivery_status=="cancelled")
                                        <span class="text-danger">cancelled</span>
                                        @else
                                        <span class="text-success">delivered</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{explode(' ',$order->created_at)[0]}}
                                    </td>   
                                    <td>
                                        @if($order->cart->product->prod_image==null) 
                                        <img src="images/no-image.png" alt="Order Image" class="img_size">
                                        @else
                                        <img src="images/products/{{$order->cart->product->prod_image}}" alt="Order Image" class="img_size">
                                        @endif
                                    </td>
                                  
                                    <td>
                                        @if ($order->delivery_status=="processing")
                                        <a href="delivered/{{$order->id}}" class="btn btn-success">Delivered</a>
                                        @elseif($order->delivery_status=="cancelled")
                                        <span class="text-warning">Not Allowed</span>
                                        @else
                                        <span class="text-success">Delivered</span>
                                        @endif
                                    </td>
                                    <td>
                                    @if ($order->delivery_status=="processing")
                                        <a href="cancel_order/{{$order->id}}" class="btn btn-danger" onclick="return confirm('Are you sure to cancel this order?');">Cancel Order</a>
                                    @elseif($order->delivery_status=="delivered")
                                        <span class="text-warning">Not Allowed</span>
                                    @elseif($order->delivery_status=="cancelled")
                                        <span class="text-danger">Cancelled</span>
                                    @endif
                                    </td>
                                    <td>
                                        <a href="print_pdf/{{$order->id}}" class="btn btn-secondary">Print PDF</a>
                                    </td>
                                    <td>
                                        <a href="send_email/{{$order->id}}" class="btn btn-info">Send Email</a>
                                    </td>  
                              </tr>
                              @empty
                              <tr>
                                  <td colspan="16">No results found</td>
                              </tr>
                              @endforelse 

                            </tbody>
                          </table>
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="p-4" >
                                {{$orders->links("vendor.pagination.bootstrap-4")}}
                            </div>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
        
                {{-- <div class="div_center">
                    <h3 class="extra_paddings">All Orders</h3>

                    <div class="extra_paddings">
                        <form action="" method="GET">
                            <input type="text" name="search" style="width:30%; height:30px;" placeholder="Search for something">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>

                    @if(isset($_GET["search"]) && $_GET["search"]!="") 
                    <div style="text-align:center; font-size:30px; font-weight:bold; margin-top:20px;">
                        <p>Search results for: '{{$_GET["search"]}}'</p>
                    </div>
                    @endif
                  
                    <table class="table_center">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Product Title</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Payment Status</th>
                                <th>Delivery Status</th>
                                <th>Image</th>
                                <th>Delivered</th>
                                <th>Cancel Order</th>
                                <th>Print PDF</th>
                                <th>Send Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->cart->user->name}}</td>
                                <td>{{$order->cart->user->email}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->cart->user->phone}}</td>
                                <td>{{$order->cart->product->prod_title}}</td>
                                <td>{{$order->cart->quantity}}</td>
                                <td>{{$order->cart->price}}</td>
                                <td>{{$order->payment_status}}</td>
                                <td>{{$order->delivery_status}}</td>
                        
                            
                                <td>
                                    @if($order->cart->product->prod_image==null) 
                                    <img src="images/no-image.png" alt="Order Image" class="img_size">
                                    @else
                                    <img src="images/products/{{$order->cart->product->prod_image}}" alt="Order Image" class="img_size">
                                    @endif
                                </td>
                                <td>
                                    @if ($order->delivery_status=="processing")
                                    <a href="delivered/{{$order->id}}" class="btn btn-primary">Delivered</a>
                                    @elseif($order->delivery_status=="cancelled")
                                    <p style="color:rgb(172, 95, 0)">Not Allowed</p>
                                    @else
                                    <p style="color:green">Delivered</p>
                                    @endif
                                </td>     
                                
                                @if ($order->delivery_status=="processing")
                                    <td><a href="cancel_order/{{$order->id}}" class="btn" style="color:white; background-color:#505050" onclick="return confirm('Are you sure to cancel this order?');">Cancel Order</a></td>
                                @elseif($order->delivery_status=="delivered")
                                    <td class="price">Not Allowed</td>
                                @elseif($order->delivery_status=="cancelled")
                                    <td class="price">Cancelled</td>
                                @endif
                                <td>
                                    <a href="print_pdf/{{$order->id}}" class="btn btn-secondary">Print PDF</a>
                                </td>
                                <td>
                                    <a href="send_email/{{$order->id}}" class="btn btn-info">Send Email</a>
                                </td>                         
                            </tr>
                            @empty
                            <tr>
                                <td colspan="13">No results found</td>
                            </tr>
                            @endforelse 
                        </tbody>
                    </table>
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="p-4" >
                            {{$orders->links("vendor.pagination.bootstrap-4")}}
                        </div>
                    </div>
                </div> --}}
            </div>
              <!-- plugins:js -->
    @include('admin-page.footer_section')
    <!-- End custom js for this page -->
        </div>
        
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller ends -->


    <!-- plugins:js -->
    @include('admin-page.js_section')
    <!-- End custom js for this page -->
  </body>
</html>