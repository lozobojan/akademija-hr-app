  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li> -->
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3" method="GET" action="<?=putanja($dubina)?>zaposleni/index.php" >
      <div class="input-group input-group-sm">
        <?php  
              if( isset($_GET['filter_zaposleni']) && $_GET['filter_zaposleni'] != "" ){
                $filter_zaposleni = $_GET['filter_zaposleni'];
              }else{
                $filter_zaposleni = "";
              }
        ?>
        <input class="form-control form-control-navbar" name="filter_zaposleni" type="search" value="<?=$filter_zaposleni?>" placeholder="Pretraga">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
    
    <?php 

      $sql_obavjestenja = "SELECT
	
                              radnik.id,
                              radnik.ime,
                              radnik.prezime,
                              sektor.naziv as sektor,
                              DATEDIFF(radnik_zaposlenje.datum_isteka_ugovora, CURRENT_TIMESTAMP) as dana_do_isteka
                          
                          from radnik_zaposlenje 
                          join radnik on radnik.id = radnik_zaposlenje.radnik_id
                          join radnik_pozicija on radnik.id = radnik_pozicija.radnik_id
                          join sektor on sektor.id = radnik_pozicija.sektor_id
                          where DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 30 DAY) > radnik_zaposlenje.datum_isteka_ugovora";
      $res_obavjestenja = mysqli_query($dbconn, $sql_obavjestenja);
      $broj_obavjestenja = mysqli_num_rows($res_obavjestenja);
              
    ?>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"><?=$broj_obavjestenja?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header"><?=$broj_obavjestenja?> novih obavještenja</span>
          <div class="dropdown-divider"></div>
          
          <?php 

              while($row_obavjestenja = mysqli_fetch_assoc($res_obavjestenja)){

                  echo '<div class="dropdown-divider"></div>
                          <a href="'.putanja($dubina).'/zaposleni/detalji.php?id='.$row_obavjestenja['id'].'" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i>'.$row_obavjestenja['ime'].' '.$row_obavjestenja['prezime'].'
                            <span class="float-right text-muted text-sm">'.$row_obavjestenja['dana_do_isteka'].' dana</span>
                          </a>
                        <div class="dropdown-divider"></div>
                        ';
              }
              
          ?>
          <!-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> -->
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <!-- <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="<?=putanja($dubina)?>odjava.php" role="button"> -->
        <a class="nav-link" href="<?=putanja($dubina)?>odjava.php" role="button">
          <i class="fas fa-lock"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->