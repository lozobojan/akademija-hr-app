<?php 

    include "../db.php";
    include "../funkcije.php";

    if(isset($_GET['naziv']) && $_GET['naziv'] != ""){
        var_dump($_GET);
        exit;
    }
    $id = validacija($_GET, 'id', false, "", "./index.php" );

    $dodatni_uslovi = "";
    if(isset($_GET['filter_id']) && is_numeric($_GET['filter_id'])){
        $dodatni_uslovi .= " AND d.id = ".$_GET['filter_id'];
        $filter_id = $_GET['filter_id'];
    }else $filter_id = "";
    if(isset($_GET['filter_naziv']) && $_GET['filter_naziv'] != ""){
        $filter_naziv = $_GET['filter_naziv'];
        $dodatni_uslovi .= " AND d.naziv LIKE '%$filter_naziv%' ";
    }else $filter_naziv = "";
    if(isset($_GET['filter_tip_dokumenta']) && $_GET['filter_tip_dokumenta'] != ""){
        $filter_tip_dokumenta = $_GET['filter_tip_dokumenta'];
        $dodatni_uslovi .= " AND td.naziv LIKE '%$filter_tip_dokumenta%' ";
    }else $filter_tip_dokumenta = "";
    if(isset($_GET['filter_napomena']) && $_GET['filter_napomena'] != ""){
        $filter_napomena = $_GET['filter_napomena'];
        $dodatni_uslovi .= " AND d.napomena LIKE '%$filter_napomena%' ";
    }else $filter_napomena = "";
    if(isset($_GET['filter_datum']) && $_GET['filter_datum'] != ""){
        $filter_datum = $_GET['filter_datum'];
        $dodatni_uslovi .= " AND d.datum = '$filter_datum' ";
    }else $filter_datum = "";

    $sql = "
            SELECT 
                *,
                rz.napomena as napomena2,
                g.naziv as grad_naziv,
                vz.naziv as vrsta_zaposlenja_naziv,
                b.naziv as banka_naziv,
                s.naziv as sektor_naziv
            FROM radnik r
            JOIN radnik_pozicija rp ON r.id = rp.radnik_id
            JOIN radnik_zaposlenje rz ON r.id = rz.radnik_id
            JOIN grad g ON g.id = r.grad_id
            JOIN vrsta_zaposlenja vz ON vz.id = rz.vrsta_zaposlenja_id
            JOIN banka b ON b.id = rz.banka_id
            JOIN sektor s ON s.id = rp.sektor_id
            WHERE r.id = $id
    ";
    $radnik = mysqli_fetch_assoc(mysqli_query($dbconn, $sql));
    if(is_null($radnik)){
        redirect("./index.php?msg=err1");
    }
    
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
            <h1 class="m-0">Detalji zaposlenog</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Pocetna</a></li>
              <li class="breadcrumb-item active">Detalji zaposlenog</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="row">
          
          <div class="col-lg-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Opšti podaci</h5>
              </div>
              <div class="card-body">
                <p>Ime: <?=$radnik['ime']?></p>
                <p>Prezime: <?=$radnik['prezime']?></p>
                <p>Datum rodjenja: <?=$radnik['datum_rodjenja']?></p>
                <p>JMBG: <?=$radnik['jmbg']?></p>
                <p>Grad: <?=$radnik['grad_naziv']?></p>
                <p>Adresa: <?=$radnik['adresa']?></p>
            
                <!-- fotografija -->

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
                  <p>Mobilni telefon: <?=$radnik['telefon1']?> </p>
                  <p>Fiksni telefon: <?=$radnik['telefon2']?> </p>
                  <p>Email adresa: <?=$radnik['email']?> </p>
                  <p>Kancelarija: <?=$radnik['kancelarija']?> </p>
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

                <p>Datum početka: <?=$radnik['datum_pocetka']?> </p>
                <p>Vrsta zaposlenja: <?=$radnik['vrsta_zaposlenja_naziv']?> </p>
                <p>Banka: <?=$radnik['banka_naziv']?> </p>
                <p>Broj žiro računa: <?=$radnik['broj_zr']?> </p>
                <p>Napomena: <?=$radnik['napomena']?> </p>

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
                
                <p>Sektor: <?=$radnik['sektor_naziv']?> </p>
                <p>Pozicija: <?=$radnik['naziv_pozicije']?> </p>
                <p>Opis posla: <?=$radnik['opis_posla']?> </p>
                <p>Iznos plate: <?=$radnik['plata']?> </p>
                <p>Vještine: <?=$radnik['vjestine']?> </p>
                <p>Napomena: <?=$radnik['napomena2']?> </p>

              </div>
              </div>
          </div>

        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-12">
                <h4 class="mt-3">
                    Dokumenta za ovog zaposlenog
                    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal_novi_dokument">
                        Dodaj novi dokument
                    </button>
                </h4>
                <table id="tabela_dokumenata" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tip</th>
                            <th>Naziv</th>
                            <th>Datum</th>
                            <th>Napomena</th>
                            <th>Preuzmi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <form method="GET" action="detalji.php#tabela_dokumenata">
                                <input type="hidden" name="id" value="<?=$id?>">
                                <td> <input type="text" value="<?=$filter_id?>" name="filter_id" class="form-control" placeholder="Pretraga" > </td>
                                <td> <input type="text" value="<?=$filter_tip_dokumenta?>" name="filter_tip_dokumenta" class="form-control" placeholder="Pretraga" > </td>
                                <td> <input type="text" value="<?=$filter_naziv?>" name="filter_naziv" class="form-control" placeholder="Pretraga" > </td>
                                <td> <input type="date" value="<?=$filter_datum?>" name="filter_datum" class="form-control" placeholder="Pretraga" > </td>
                                <td> <input type="text" value="<?=$filter_napomena?>" name="filter_napomena" class="form-control" placeholder="Pretraga" > </td>
                                <td> <button type="submit" class="btn btn-primary d-none" > Pretraga </button> </td>
                            </form>
                        </tr>
                        <?php 
                            $sql_dok = "SELECT 
                                            d.*,
                                            td.naziv as tip_dokumenta_naziv
                                        FROM `dokument` d
                                        JOIN tip_dokumenta td ON td.id = d.tip_dokumenta_id
                                        where radnik_id = $id
                                        $dodatni_uslovi
                                        ";
                                        // exit("<pre>".$sql_dok."</pre>");
                            $res_dok = mysqli_query($dbconn, $sql_dok);
                            while($row_dok = mysqli_fetch_assoc($res_dok)){
                                $putanja = $row_dok['putanja'];
                                $link_preuzmi = "<a download href=\"$putanja\"> <i class=\"fa fa-download\" ></i> </a>";
                                echo "<tr>";
                                echo "  <td>".$row_dok['id']."</td>";
                                echo "  <td>".$row_dok['tip_dokumenta_naziv']."</td>";
                                echo "  <td>".$row_dok['naziv']."</td>";
                                echo "  <td>".$row_dok['datum']."</td>";
                                echo "  <td>".$row_dok['napomena']."</td>";
                                echo "  <td>".$link_preuzmi."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php  
            include '../footer.php';
            include './modal_novi_dokument.php';
    ?>
  
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
