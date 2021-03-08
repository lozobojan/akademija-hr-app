<?php 

    include "../db.php";
    include "../funkcije.php";

    checkAuth($admin = true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HR app | Statistika</title>

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
    $aktivna_stranica = "statistika/index.php";
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
            <h1 class="m-0">Statistika</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Početna</a></li>
              <li class="breadcrumb-item active">Statistički modul</li>
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
                
                <?php 
                    // ukupan broj zaposlenih
                    $broj_zaposlenih = mysqli_fetch_assoc(mysqli_query($dbconn, "SELECT count(*) as cnt FROM `radnik` WHERE obrisan != 1"))['cnt'];    
                    $prosjecna_starost = mysqli_fetch_row(mysqli_query($dbconn, "SELECT avg( ceil(abs( datediff(r.datum_rodjenja, CURRENT_TIMESTAMP ) ) / 365) ) as starost from radnik r where obrisan != 1"))[0];    
                ?>
                <h4>Ukupan broj zaposlenih: <?=$broj_zaposlenih?>   (prosječna starost: <?=number_format($prosjecna_starost, 1, ',', '')?> ) </h4>

            </div>
        </div>

        <div class="row mt-4">
            <div class="col-6">
                <!-- PIE CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Zaposleni po statusu</h3>

                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-6">
                <!-- PIE CHART 2 -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Zaposleni po sektorima</h3>

                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-6">
                <!-- PIE CHART 3 -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Zaposleni po vrsti zaposlenja</h3>

                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart3" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->

                    <?php 
                      $prosjecan_staz = mysqli_fetch_row(mysqli_query($dbconn, "SELECT avg(YEAR(CURRENT_TIMESTAMP) - YEAR(datum_pocetka)) from radnik_zaposlenje"))[0];
                    ?>
                    <p class="text-center" >Prosječan radni staž: <?=round($prosjecan_staz, 1)?> godina</p>

                </div>
                <!-- /.card -->
            </div>
        </div>

        <div class="row mt-4">
          <div class="col-12">
            <a href="./izvjestaj_prosjecna_plata.php" class="btn btn-primary" >Izvještaj o plati po sektorima</a>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php  
        include '../footer.php';
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
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>

<?php 
    // popunjavamo dijagram PHP-om
    $sql_neaktivni = "SELECT count(*) from radnik_zaposlenje rz
                        join radnik r on r.id = rz.radnik_id
                        where r.obrisan != 1
                        and `status` = 0
                    ";
    $sql_aktivni = "SELECT count(*) from radnik_zaposlenje rz
                            join radnik r on r.id = rz.radnik_id
                            where r.obrisan != 1
                            and `status` = 1
                        ";
    $broj_neaktivnih = mysqli_fetch_row(mysqli_query($dbconn, $sql_neaktivni))[0];
    $broj_aktivnih = mysqli_fetch_row(mysqli_query($dbconn, $sql_aktivni))[0];

?>

<script>
    var pieChartData = {
      labels: [
          'Aktivni',
          'Neaktivni'
      ],
      datasets: [
        {
          data: [<?=$broj_aktivnih?>, <?=$broj_neaktivnih?>],
          backgroundColor : [ '#00a65a', '#f56954'],
        }
      ]
    }

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = pieChartData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

</script>

<!-- popunjavamo drugi grafik koristeci AJAX -->
<script>
    $(document).ready( () => {

        $.ajax({
            type: "GET",
            url: "./zaposleni_po_sektoru.php",
            success: (response) => {
                let response_arr = JSON.parse(response);
                let pieChartData = {
                    labels: response_arr.labels,
                    datasets: [
                        {
                            data: response_arr.values,
                            backgroundColor : response_arr.colors,
                        }
                    ]
                }
                
                let pieChartCanvas = $('#pieChart2').get(0).getContext('2d')
                let pieData        = pieChartData;
                let pieOptions     = {
                    maintainAspectRatio : false,
                    esponsive : true,
                }
                
                let pieChart = new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: pieData,
                    options: pieOptions
                })

            }
        });

        $.ajax({
            type: "GET",
            url: "./zaposleni_po_vz.php",
            success: (response) => {
                let response_arr = JSON.parse(response);
                let pieChartData = {
                    labels: response_arr.labels,
                    datasets: [
                        {
                            data: response_arr.values,
                            backgroundColor : response_arr.colors,
                        }
                    ]
                }
                
                let pieChartCanvas = $('#pieChart3').get(0).getContext('2d')
                let pieData        = pieChartData;
                let pieOptions     = {
                    maintainAspectRatio : false,
                    esponsive : true,
                }
                
                let pieChart = new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: pieData,
                    options: pieOptions
                })

            }
        });

    });
</script>

</body>
</html>
