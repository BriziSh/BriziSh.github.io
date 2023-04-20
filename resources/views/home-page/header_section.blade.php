<header class="header_section no">
    <div class="container">
       <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand no" href="{{url('/')}}"><img class="logo-image-header"  src="images/logoja.png"  alt="#" /></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""> </span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav">
                <li class="nav-item active">
                   <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                @foreach($categories as $category)
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">{{$category->category_name}} <span class="caret"></span></a>
                     @php  $subcategories=$category->subcategories @endphp
                     @if(!$subcategories->isEmpty())
                     <ul class="dropdown-menu">
                           @foreach($subcategories as $subcategory)
                           <li><a href="view_products/{{$subcategory->category_id}}/{{$subcategory->id}}">{{$subcategory->subcategory_name}}</a></li>
                           @endforeach
                           <li><a href="view_products/{{$subcategory->category_id}}">All Category</a></li>
                     </ul>
                     @endif
                  </li>
                @endforeach
           
                <li class="nav-item">
                   <a class="nav-link" href="view_contact">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="show_cart">Cart @if (Auth::check() && Auth::user()->usertype=='0')[<span>{{$num_carts}}</span>]@endif</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="view_orders">Orders @if (Auth::check() && Auth::user()->usertype=='0')[<span>{{$num_orders}}</span>]@endif</a>
               </li>
           
               
               @if (Auth::check() && Auth::user()->usertype=='0')
                   {{-- profile te emri funksionalitetet--}}
                  <li class="nav-item">
                     <a class="nav-link" href="view_account_profile"><span>{{auth()->user()->name}}</span></a>
                  </li>
                  <li class="nav-item">
                     <form method="POST" action="logout">
                        @csrf
                        <button class="nav-link" type="submit">Logout</button>
                     </form>
                  </li>
                  
               @else
                  <li class="nav-item">
                     <a class="nav-link btn" href="login">Login</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link btn" href="register">Register</a>
                  </li>
               @endif
           
             </ul>
          </div>
       </nav>
    </div>
 </header>