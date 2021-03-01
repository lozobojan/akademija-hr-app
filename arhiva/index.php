<?php 

    include "../db.php";
    include "../funkcije.php";

    checkAuth($admin = true);

    $dodatni_uslovi = "";
    if(isset($_GET['filter_id']) && is_numeric($_GET['filter_id'])){
        $dodatni_uslovi .= " AND d.id = ".$_GET['filter_id'];
        $filter_id = $_GET['filter_id'];
    }else $filter_id = "";
    if(isset($_GET['filter_naziv']) && $_GET['filter_naziv'] != ""){
        $filter_naziv = strtolower($_GET['filter_naziv']);
        $dodatni_uslovi .= " AND lower(d.naziv) LIKE '%$filter_naziv%' ";
    }else $filter_naziv = "";
    if(isset($_GET['filter_zaposleni']) && $_GET['filter_zaposleni'] != ""){
        $filter_zaposleni = strtolower($_GET['filter_zaposleni']);
        $dodatni_uslovi .= " AND ( lower(r.ime) LIKE '%$filter_zaposleni%' OR lower(r.prezime) LIKE '%$filter_zaposleni%' ) ";
    }else $filter_naziv = "";
    if(isset($_GET['filter_tip_dokumenta']) && $_GET['filter_tip_dokumenta'] != ""){
        $filter_tip_dokumenta = strtolower($_GET['filter_tip_dokumenta']);
        $dodatni_uslovi .= " AND lower(td.naziv) LIKE '%$filter_tip_dokumenta%' ";
    }else $filter_tip_dokumenta = "";
    if(isset($_GET['filter_napomena']) && $_GET['filter_napomena'] != ""){
        $filter_napomena = strtolower($_GET['filter_napomena']);
        $dodatni_uslovi .= " AND lower(d.napomena) LIKE '%$filter_napomena%' ";
    }else $filter_napomena = "";
    if(isset($_GET['filter_datum']) && $_GET['filter_datum'] != ""){
        $filter_datum = $_GET['filter_datum'];
        $dodatni_uslovi .= " AND d.datum = '$filter_datum' ";
    }else $filter_datum = "";

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HR app | Arhiva</title>

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
    $aktivna_stranica = "arhiva/index.php";
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
            <h1 class="m-0">Arhivski modul</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Početna</a></li>
              <li class="breadcrumb-item active">Arhivski modul</li>
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
            <div class="col-12">
                <h4 class="mt-3">
                    Dokumenta u arhivi
                    <!-- <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal_novi_dokument">
                        Dodaj novi dokument
                    </button> -->
                </h4>
                <table id="tabela_dokumenata" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tip</th>
                            <th>Naziv</th>
                            <th>Zaposleni</th>
                            <th>Datum</th>
                            <th>Napomena</th>
                            <th>Preuzmi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <form method="GET" action="index.php#tabela_dokumenata">
                                <input type="hidden" name="id" value="<?=$id?>">
                                <td> <input type="text" value="<?=$filter_id?>" name="filter_id" class="form-control" placeholder="Pretraga" > </td>
                                <td> <input type="text" value="<?=$filter_tip_dokumenta?>" name="filter_tip_dokumenta" class="form-control" placeholder="Pretraga" > </td>
                                <td> <input type="text" value="<?=$filter_naziv?>" name="filter_naziv" class="form-control" placeholder="Pretraga" > </td>
                                <td> <input type="text" value="<?=$filter_zaposleni?>" name="filter_zaposleni" class="form-control" placeholder="Pretraga" > </td>
                                <td> <input type="date" value="<?=$filter_datum?>" name="filter_datum" class="form-control" placeholder="Pretraga" > </td>
                                <td> <input type="text" value="<?=$filter_napomena?>" name="filter_napomena" class="form-control" placeholder="Pretraga" > </td>
                                <td> <button type="submit" class="btn btn-primary d-none" > Pretraga </button> </td>
                            </form>
                        </tr>
                        <?php 
                            $sql_dok = "SELECT 
                                            d.*,
                                            DATE_FORMAT(d.datum, '%d.%m.%Y') as formatirani_datum,
                                            td.naziv as tip_dokumenta_naziv,
                                            r.ime as radnik_ime,
                                            r.prezime as radnik_prezime
                                        FROM `dokument` d
                                        JOIN tip_dokumenta td ON td.id = d.tip_dokumenta_id
                                        JOIN radnik r ON r.id = d.radnik_id
                                        where 1=1
                                        $dodatni_uslovi
                                        ORDER BY d.datum DESC
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
                                echo "  <td>".$row_dok['radnik_ime']." ".$row_dok['radnik_prezime']. "</td>";
                                echo "  <td>".$row_dok['formatirani_datum']."</td>";
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
            // include './modal_novi_dokument.php';
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
