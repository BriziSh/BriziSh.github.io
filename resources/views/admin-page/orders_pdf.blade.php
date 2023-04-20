
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>All Cancelled Orders</title>
    <style>
        .img_size{
            width:70px!important;
            height:70px!important;
            }
    </style>
    {{-- @include('admin-page.css_section') --}}
  </head>
  <body>
        <div>
            <h3>
                @if(!$orders->isEmpty()) All Orders Cancelled for Product: '{{$orders[0]->prod_title}}'
                @else No Orders Cancelled
                @endif
            </h3>
            <table border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>No.</th>
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
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->address}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->prod_id}}</td>
                        <td>{{$order->prod_title}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->payment_status}}</td>
                        <td>{{$order->delivery_status}}</td>
                        <td>
                            @if ($order->prod_image == null)
                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/no-image.png'))) }}" alt="Order Image" class="img_size">
                            @else
                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/products/' . $order->prod_image))) }}" alt="Order Image" class="img_size">
                            @endif
                        </td>
                        
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12">No results found</td>
                    </tr>
                    @endforelse 
                </tbody>
            </table>
        </div>
  </body>
</html>