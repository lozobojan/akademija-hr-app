<?php 

    include "../db.php";
    include "../funkcije.php";

    // var_dump($_FILES);
    // exit;

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $vrijednosti = [];
        $vrijednosti['radnik_id'] = validacija($_POST, 'radnik_id', true, "", "./detalji.php?msg=err0");
        $vrijednosti['naziv'] = validacija($_POST, 'naziv', true, "", "./detalji.php?msg=err1");
        $vrijednosti['datum'] = validacija($_POST, 'datum', true, "", "./detalji.php?msg=err2");
        $vrijednosti['napomena'] = validacija($_POST, 'napomena', true, "", "./detalji.php?msg=err3");
        $vrijednosti['tip_dokumenta_id'] = validacija($_POST, 'tip_dokumenta_id', true, "", "./detalji.php?msg=err4");
        
        $vrijednosti['putanja'] = uploadFile("dokument", uniqid() );
        $novi_id = sacuvaj( "dokument", $vrijednosti );

        if($novi_id){
            redirect("./detalji.php?id=".$vrijednosti['radnik_id']."&msg=uspjesno_dodavanje_dokumenta");
        }else{
            redirect("./detalji.php?id=".$vrijednosti['radnik_id']."&msg=neuspjesno_dodavanje_dokumenta");
        }

    }else{
        exit("Nedozvoljen metod!");
    }
?>