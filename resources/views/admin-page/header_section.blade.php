<nav class="navbar p-0 fixed-top d-flex flex-row">
  <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
    <a class="navbar-brand brand-logo-mini" href="admin"><img src="images/admin/logo-mini.svg" alt="logo" /></a>
  </div> 
  <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
    <ul class="navbar-nav w-100">
      <li class="nav-item w-100">
        <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" action="view_show_products" method="GET">
          <input type="text" class="form-control" placeholder="Search products by product name or category" name="search-admin" autocomplete="off" style="color:#6c7293">
        </form>
      </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right">
    {{-- ajax per tu update chati --}}
    <script>
      $(document).ready(function(){
        $("#chat").html('{!! view("admin-page.messages", ["contacts" => $contacts])->render() !!}');
      });

      function updateMessageDropdown() {
        $.get('admin/messages', function(html) {
            $('#chat').html(html);
        });
      }
      setInterval(updateMessageDropdown, 10000);
    </script>

  <div id="chat"></div>
    {{-- <li class="nav-item dropdown border-left">
        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="mdi mdi-email"></i>
          <span class="count bg-success"></span>
        </a>
      
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
          <h6 class="p-3 mb-0">Messages</h6>
          <div id="contact-messages"></div>
          
          @foreach ($contacts as $contact)
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item" href="all_messages">
              <div class="preview-item-content">
                 
                <php $name = explode("@",$contact->email)[0]; ?>
                <p class="preview-subject ellipsis mb-1">{{$name}} send you a message</p>
                <p class="text-muted mb-0">{{$contact->created_at}}</p>
              </div>
            </a>
          @endforeach
          
          <div class="dropdown-divider"></div>
          <p class="p-3 mb-0 text-center"><a href="all_messages" style="text-decoration:none; color:white;">View all messages</a></p>
        </div>
      </li> --}}
      @auth
        <li class="nav-item">
            <form method="POST" action="logout">
              @csrf
              <button class="nav-link text-danger bg-transparent border-0" type="submit">Logout</button>
            </form>
        </li>
      @else
        <li class="nav-item">
            <a class="nav-link btn text-info" href="login">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn text-success" href="register">Register</a>
        </li>
      @endauth 
        </ul>
  </div>
</nav>
