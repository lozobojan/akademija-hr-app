<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?=putanja($dubina)?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=putanja($dubina)?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <!-- citati iz sesije -->
          <a href="#" class="d-block">Prijavljeni korisnik</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">

            <?php explode('/', $aktivna_stranica)[0] == 'zaposleni' ? $active = 'active' : $active = "";  ?>
            <a href="<?=putanja($dubina)?>zaposleni" class="nav-link <?=$active?> ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Zaposleni
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <?php explode('/', $aktivna_stranica)[0] == 'zaposleni' && explode('/', $aktivna_stranica)[1] == 'index.php' ? $active = 'active' : $active = "";  ?>
                <a href="<?=putanja($dubina)?>zaposleni" class="nav-link <?=$active?> ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lista zaposlenih</p>
                </a>
              </li>
              <li class="nav-item">
                <?php explode('/', $aktivna_stranica)[0] == 'zaposleni' && explode('/', $aktivna_stranica)[1] == 'novi.php' ? $active = 'active' : $active = "";  ?>
                <a href="<?=putanja($dubina)?>zaposleni/novi.php" class="nav-link <?=$active?> ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Novi zaposleni</p>
                </a>
              </li>
            </ul>
          </li>
          
          <?php
            if(isAdmin()){
              explode('/', $aktivna_stranica)[0] == 'arhiva' && explode('/', $aktivna_stranica)[1] == 'index.php' ? $active = 'active' : $active = "";
              echo "<li class=\"nav-item  \">
                    <a href=\"arhiva/index.php\" class=\"nav-link $active \">
                      <i class=\"nav-icon fas fa-th\"></i> <p>Arhiva</p>
                    </a>
                  </li>";
            }
          ?>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>