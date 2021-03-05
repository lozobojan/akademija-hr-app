<?php 

    include "../db.php";
    include "../funkcije.php";

    // checkAuth($admin = true);

    $bg_color = [ '#00a65a', '#f56954', '#3c8dbc', '#d2d6de', '#d2d6aa',  '#d2d9de', '#d2d7de'];

    $sql = "SELECT 
                s.naziv, 
                (select count(*) from radnik_pozicija rp where rp.sektor_id = s.id ) as br_zaposlenih
            from sektor s
            order by 2 desc";
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