<!DOCTYPE html>
<body>
    <h1>Order Details</h1>
    Customer Id: <h3>{{$order->cart->user_id}}</h3>
    Customer name: <h3>{{$order->cart->user->name}}</h3>
    Customer email: <h3>{{$order->cart->user->email}}</h3>
    Customer phone: <h3>{{$order->cart->user->phone}}</h3>
    Customer address: <h3>{{$order->address}}</h3>
  
    Product Id: <h3>{{$order->cart->prod_id}}</h3>
    Product name: <h3>{{$order->cart->product->prod_title}}</h3>
    Product price: <h3>{{$order->cart->product->prod_price}}$</h3>
    Product quantity: <h3>{{$order->cart->quantity}}</h3>
    Total Price: <h3>{{$order->cart->price}}$</h3>
    Payment status: <h3>{{$order->payment_status}}</h3>
    <br><br>
    @if($order->cart->product->prod_image==null) 
    <img src="images/no-image.png" alt="Product Image" width="450px" height="250px">
    @else
    <img src="images/products/{{$order->cart->product->prod_image}}" alt="Product Image" width="450px" height="250px">
    @endif
</body>
</html>