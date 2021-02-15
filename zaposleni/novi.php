<?php 

    include "../db.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php

    include '../nav.php'; 
    include '../aside.php';
    
  ?>  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Novi zaposleni</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Pocetna</a></li>
              <li class="breadcrumb-item active">Novi zaposleni</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <form action="./dodaj.php" method="POST" enctype="multipart/form-data">
        <div class="row">
          
          <div class="col-lg-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Opšti podaci</h5>
              </div>
              <div class="card-body">
                <label for="ime_input">Ime:</label>
                <input type="text" required name="ime" placeholder="Unesite ime.." class="form-control">
                <label for="prezime_input">Prezime:</label>
                <input type="text" required name="prezime" placeholder="Unesite prezime.." class="form-control">
                <label for="datum_input" required>Datum rođenja:</label>
                <input type="date" name="datum_rodjenja" class="form-control">
                <label for="jmbg_input">JMBG:</label>
                <input type="text" name="jmbg" required min="13" max="13" placeholder="Unesite JMBG.." class="form-control">
                <select name="grad_id" required id="grad_id_select" class="form-control mt-3">
                    <option value="">- odaberite grad -</option>
                    <?php 
                        $res_grad = mysqli_query($dbconn, "SELECT * FROM grad ORDER BY naziv ASC");
                        while($row_grad = mysqli_fetch_assoc($res_grad)){
                            echo "<option value=\"".$row_grad['id']."\">".$row_grad['naziv']."</option>";
                        }
                    ?>
                </select>
                <label for="adresa_input">Adresa:</label>
                <input type="text" name="adresa" required placeholder="Unesite adresu.." class="form-control">
                <label for="fotografija_input">Fotografija:</label>
                <input type="file" name="fotografija" class="form-control">
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->

        <div class="col-lg-6">
            <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0">Kontakt podaci</h5>
            </div>
            <div class="card-body">
                <label for="telefon1_input">Mobilni telefon:</label>
                <input type="text" name="telefon1" required placeholder="Unesite telefon.." class="form-control">
                <label for="telefon2_input">Fiksni telefon:</label>
                <input type="text" name="telefon2" placeholder="Unesite telefon.." class="form-control">
                <label for="email_input">Email adresa:</label>
                <input type="email" name="email" placeholder="Unesite email.." class="form-control">
                <label for="kancelarija_input">Kancelarija adresa:</label>
                <input type="text" name="kancelarija" placeholder="Unesite broj kancelarije.." class="form-control">

                <button class="btn btn-success btn-block mt-4 mb-2">Dodaj</button>
            </div>
            </div>
        </div>

        </div>
        <!-- /.row -->
        </form>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php  include '../footer.php';  ?>
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>