  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2 display:none" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="#">
        <img src="<?=$_ENV['PAGE_ICON']?>" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark"><?=$_ENV['PAGE_SIDEBAR']?></span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <?php 
            if($path_parts['filename'] == 'dashboard'){ ?>
              <a class="nav-link active bg-gradient-dark text-white" href="#">
                <i class="material-symbols-rounded opacity-5">dashboard</i>
                <span class="nav-link-text ms-1">Dashboard</span>
              </a>
            <?php 
            }else { ?>
              <a class="nav-link text-dark" href="dashboard">
                <i class="material-symbols-rounded opacity-5">dashboard</i>
                <span class="nav-link-text ms-1">Dashboard</span>
              </a>
            <?php
            }
          ?>
          
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/tables.html">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">Tables</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/billing.html">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Billing</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/virtual-reality.html">
            <i class="material-symbols-rounded opacity-5">view_in_ar</i>
            <span class="nav-link-text ms-1">Virtual Reality</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/rtl.html">
            <i class="material-symbols-rounded opacity-5">format_textdirection_r_to_l</i>
            <span class="nav-link-text ms-1">RTL</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/notifications.html">
            <i class="material-symbols-rounded opacity-5">notifications</i>
            <span class="nav-link-text ms-1">Notifications</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/profile.html">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/sign-in.html">
            <i class="material-symbols-rounded opacity-5">login</i>
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/sign-up.html">
            <i class="material-symbols-rounded opacity-5">assignment</i>
            <span class="nav-link-text ms-1">Sign Up</span>
          </a>
        </li>
        <li class="nav-item">
          <?php 
            if($path_parts['filename'] == 'centers'){ ?>
              <!-- <a class="nav-link active bg-gradient-dark text-white" href="#">
                <i class="material-symbols-rounded opacity-5">person</i>
                <span class="nav-link-text ms-1">Centers</span>
              </a> -->
            <?php 
            }else { ?>
              <!-- <a class="nav-link text-dark" href="centers">
                <i class="material-symbols-rounded opacity-5">person</i>
                <span class="nav-link-text ms-1">Centers</span>
              </a> -->
            <?php
            }
          ?>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
         <?php 
            if($path_parts['filename'] == 'portal'){ ?>
            <!--<a class="btn btn-outline-dark mt-4 w-100 active bg-gradient-dark text-white" href="#" type="button">Main Portal</a>-->
        <!--<a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/material-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a>
       -->
              
            <?php 
            }else { ?>
              <!--<a class="btn btn-outline-dark mt-4 w-100" href="../../../" type="button">Main Portal</a>-->
                <!--<a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/material-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a>
              -->
            <?php
            }
          ?>
          <a class="btn btn-outline-dark mt-4 w-100 active bg-gradient-dark text-white" href="logout/" type="button">Log Out</a>
         
      </div>
    </div>
  </aside>