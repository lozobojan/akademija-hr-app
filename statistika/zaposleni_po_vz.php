<?php 

    include "../db.php";
    include "../funkcije.php";

    // checkAuth($admin = true);

    $bg_color = [ '#00a65a', '#f56954', '#3c8dbc', '#d2d6de', '#d2d6aa',  '#d2d9de', '#d2d7de'];

    $sql = "SELECT 
                    naziv, 
                    count(*)
                from vrsta_zaposlenja vz
                join radnik_zaposlenje rz on rz.vrsta_zaposlenja_id = vz.id
                group by naziv
                order by 2 DESC
            ";
    $res = mysqli_query($dbconn, $sql);

    $labels = [];
    $values = [];
    $colors = [];

    $cnt = 0;
    while($row = mysqli_fetch_row($res)){
        $labels[] = $row[0];
        $values[] = $row[1];
        $colors[] = $bg_color[$cnt];
        $cnt++;
    }

    echo json_encode( [ 'labels' => $labels, 'values' => $values, 'colors' => $colors ] );
    exit;

?>