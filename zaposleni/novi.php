<?php 

    include "../db.php";
    include "../funkcije.php";

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

    $dubina = 1;
    $aktivna_stranica = "zaposleni/novi.php";
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

                <label for="pol_select">Odaberite pol:</label>
                <select   name="pol" id="pol_select" class="form-control" >
                  <option value="Muški">Muški</option>
                  <option value="Ženski">Ženski</option>
                </select>

                <select name="grad_id" required id="grad_id_select" class="form-control mt-3">
                    <option value="">- odaberite grad -</option>
                    <?php sifarnik("grad"); ?>
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
              </div>
              </div>
          </div>

        </div>

        <div class="row">
          
          <div class="col-lg-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Status zaposlenja</h5>
              </div>
              <div class="card-body">

                <label for="datum_input">Datum početka:</label>
                <input type="date" required name="datum_pocetka" id="datum_input" class="form-control">

                <label for="datum_isteka_ugovora">Datum isteka ugovora:</label>
                <input type="date" required name="datum_isteka_ugovora" id="datum_isteka_ugovora" class="form-control">
                      
                <label for="vrsta_select">Vrsta zaposlenja:</label>
                <select required name="vrsta_zaposlenja" id="vrsta_select" class="form-control">
                    <option value="">- odaberite vrstu zaposlenja -</option>
                    <?php sifarnik("vrsta_zaposlenja"); ?>
                </select>

                <label for="banka_select">Banka:</label>
                <select required name="banka" id="banka_select" class="form-control">
                    <option value="">- odaberite banku -</option>
                    <?php sifarnik("banka"); ?>
                </select>

                <label for="broj_zr_input">Broj žiro računa:</label>
                <input type="text" class="form-control" required id="broj_zr_input" name="broj_zr" >

                <label for="napomena_txt">Napomena:</label>
                <textarea name="napomena" id="napomena_txt" class="form-control" rows="3"></textarea>

              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->

          <div class="col-lg-6">
              <div class="card card-primary card-outline">
              <div class="card-header">
                  <h5 class="m-0">Opis posla</h5>
              </div>
              <div class="card-body">

                  <label for="sektor_select">Sektor:</label>
                  <select required name="sektor_id" id="sektor_select" class="form-control">
                      <option value="">- odaberite sektor -</option>
                      <?php sifarnik("sektor"); ?>
                  </select>

                  <label for="pozicija_input">Pozicija:</label>
                  <input type="text" name="pozicija" required placeholder="Unesite naziv pozicije.." class="form-control">

                  <label for="opis_posla_txt">Opis posla:</label>
                  <textarea name="opis_posla" id="opis_posla_txt" class="form-control" rows="3"></textarea>

                  <label for="plata_input">Iznos plate:</label>
                  <input type="number" name="plata" required placeholder="Unesite iznos plate.." step="0.01" class="form-control">

                  <label for="vjestine_txt">Vještine:</label>
                  <textarea name="vjestine" id="vjestine_txt" class="form-control" rows="3"></textarea>

                  <label for="napomena_txt">Napomena:</label>
                  <textarea name="napomena" id="napomena_txt" class="form-control" rows="3"></textarea>

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
