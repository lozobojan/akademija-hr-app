<?php  
    include '../db.php';
    include '../funkcije.php';
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
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
            <h1 class="m-0">Zaposleni</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Početna</a></li>
              <li class="breadcrumb-item active">Zaposleni</li>
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
          <div class="col-lg-12">
            
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0">Svi zaposleni</h5>
                </div>
                <div class="card-body">
                    <table id="tabela_zaposlenih" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Ime i prezime</th>
                        <th>Grad</th>
                        <th>Adresa</th>
                        <th>Datum rođenja</th>
                        <th>Kancelarija</th>
                        <th>...</th>
                        <th>...</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "
                                    SELECT  r.*, 
                                            g.naziv as grad
                                    FROM radnik r
                                    LEFT JOIN grad g ON g.id = r.grad_id
                                    WHERE r.obrisan <> true
                                    ORDER BY r.ime ASC
                            ";
                            $res = mysqli_query($dbconn, $sql);
                            while($radnik = mysqli_fetch_assoc($res)){
                                $id = $radnik['id'];
                                $link_izmjena = "<a href=\"izmjena.php?id=$id\" ><i class=\"fa fa-edit\"></i></a>";
                                $link_brisanje = "<a href=\"#\" onclick=\"brisi($id)\" ><i class=\"fa fa-times\"></i></a>";
                                $link_pregled = "<a href=\"./detalji.php?id=$id\" > ".$radnik['ime']." ".$radnik['prezime']." </a>";
                                echo "<tr>";
                                echo "  <td>$link_pregled</td>";
                                echo "  <td>".$radnik['grad']."</td>";
                                echo "  <td>".$radnik['adresa']."</td>";
                                echo "  <td>".$radnik['datum_rodjenja']."</td>";
                                echo "  <td>".$radnik['kancelarija']."</td>";
                                echo "  <td>$link_izmjena</td>";
                                echo "  <td>$link_brisanje</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Ime i prezime</th>
                        <th>Grad</th>
                        <th>Adresa</th>
                        <th>Datum rođenja</th>
                        <th>Kancelarija</th>
                        <th>...</th>
                        <th>...</th>
                    </tr>
                    </tfoot>
                    </table>
                </div>
                </div>

          </div>
        </div>
        <!-- /.row -->
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
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script>

    // napraviti da se potvrda radi iz modala
    function brisi(id){
      if( confirm("Da li ste sigurni?") ){
        location.href = "./brisi.php?id="+id;
      }
    }

</script>

<script>
  $(function () {
    $('#tabela_zaposlenih').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>


</body>
</html>
