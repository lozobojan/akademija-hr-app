<?php 

    require '../vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    include "../db.php";
    include "../funkcije.php";

    $sql = "SELECT 
                s.naziv, 
                COALESCE(avg(rp.plata), 0) as prosjecna_plata
            from sektor s 
            left join radnik_pozicija rp on rp.sektor_id = s.id
            group by s.naziv
            order by 2 desc";
    $res = mysqli_query($dbconn, $sql);


    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'Sektor');
    $sheet->setCellValue('B1', 'Prosječna plata');

    $red_xlsx = 3;
    while($row = mysqli_fetch_row($res)){
        $sheet->setCellValue('A'.$red_xlsx, $row[0]);
        $sheet->setCellValue('B'.$red_xlsx, $row[1]);
        $red_xlsx++;
    }

    $writer = new Xlsx($spreadsheet);
    $fileName = 'plate_po_sektorima_'.time().'.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
    $writer->save('php://output');

?>