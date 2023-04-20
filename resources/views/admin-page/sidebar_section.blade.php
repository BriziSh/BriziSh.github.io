<nav class="sidebar sidebar-offcanvas" id="sidebar">  
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="admin"><img src="images/admin/logo.png" alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini" href="admin"><img src="images/admin/logo-mini.png" alt="logo" /></a>
    </div>
    <ul class="nav">
      <li class="nav-item profile"> 
        <div class="profile-desc">
          <div class="profile-pic">
            <div class="count-indicator">
              @if (auth()->user()->image)
                  <img class="img-xs rounded-circle " src="images/admin/{{auth()->user()->image}}" alt="">
              @else
                  <img class="img-xs rounded-circle " src="images/no-profile.jpeg" alt="">
              @endif
              <span class="count bg-success"></span>
            </div>
            <div class="profile-name">
              <h5 class="mb-0 font-weight-normal">{{auth()->user()->name}}</h5>
              <span>Admin User</span>
            </div>
          </div>
          <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
          <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
            <a href="view_account_settings" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-settings text-primary"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="view_change_password" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-onepassword  text-info"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="" onclick="changePhoto(); event.preventDefault();" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-folder-multiple-image text-success"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Change Profile Photo</p>
              </div>
            </a>
          </div>
        </div>
      </li>
      <li class="nav-item nav-category">
        <span class="nav-link">Navigation</span>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="admin">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-icon">
            <i class="mdi mdi-archive"></i>
          </span>
          <span class="menu-title">Products</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="view_add_products">Add Products</a></li>
            <li class="nav-item"> <a class="nav-link" href="view_show_products">Show Products</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="category">
          <span class="menu-icon">
            <i class="mdi mdi-reorder-horizontal"></i>
          </span>
          <span class="menu-title">Category</span>
        </a>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="show_orders">
          <span class="menu-icon">
            <i class="mdi mdi-send"></i>
          </span> 
          <span class="menu-title">Orders</span>
        </a>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="view_email_all">
          <span class="menu-icon">
            <i class="mdi mdi-account-multiple"></i>
          </span>
          <span class="menu-title">Subscribers</span>
        </a>
      </li>
    </ul>
  </nav>