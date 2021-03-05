<?php 

    include '../db.php';
    include '../funkcije.php';

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        // debug($_POST);

        $vrijednosti = [];
        $vrijednosti_status_zaposlenja = [];
        $vrijednosti_opis_posla = [];

        $id = validacija($_POST, 'id', true, "", "./index.php?msg=err0");

        // validacija($niz, $kljuc, $required = false, $default = "", $url = "" )
        $vrijednosti['ime'] = validacija($_POST, 'ime', true, "", "./novi.php?msg=err1");
        $vrijednosti['prezime'] = validacija($_POST, 'prezime', true, "", "./novi.php?msg=err2");
        $vrijednosti['datum_rodjenja'] = validacija($_POST, 'datum_rodjenja', true, "", "./novi.php?msg=err3");
        $vrijednosti['grad_id'] = validacija($_POST, 'grad_id', true, "", "./novi.php?msg=err4");
        $vrijednosti['adresa'] = validacija($_POST, 'adresa', true, "", "./novi.php?msg=err5");
        $vrijednosti['pol'] = validacija($_POST, 'pol', true, "", "./novi.php?msg=err5.1");

        // TODO: FOTOGRAFIJA !!!

        // KONTAKT PODACI
        $vrijednosti['telefon1'] = validacija($_POST, 'telefon1', true, "", "./novi.php?msg=err6");
        $vrijednosti['telefon2'] = validacija($_POST, 'telefon2', false, "", "");
        $vrijednosti['email'] = validacija($_POST, 'email', true, "", "./novi.php?msg=err7");
        $vrijednosti['kancelarija'] = validacija($_POST, 'kancelarija', true, "", "./novi.php?msg=err8");

        // STATUS ZAPOSLENJA
        $vrijednosti_status_zaposlenja['datum_pocetka'] = validacija($_POST, 'datum_pocetka', true, "", "./novi.php?msg=err9");
        $vrijednosti_status_zaposlenja['vrsta_zaposlenja_id'] = validacija($_POST, 'vrsta_zaposlenja', true, "", "./novi.php?msg=err9");
        $vrijednosti_status_zaposlenja['banka_id'] = validacija($_POST, 'banka', true, "", "./novi.php?msg=err10");
        $vrijednosti_status_zaposlenja['broj_zr'] = validacija($_POST, 'broj_zr', true, "", "./novi.php?msg=err11");
        $vrijednosti_status_zaposlenja['napomena'] = validacija($_POST, 'napomena', false, "", "");

        // OPIS POSLA
        $vrijednosti_opis_posla['sektor_id'] = validacija($_POST, 'sektor_id', true, "", "./novi.php?msg=err12");
        $vrijednosti_opis_posla['naziv_pozicije'] = validacija($_POST, 'pozicija', true, "", "./novi.php?msg=err13");
        $vrijednosti_opis_posla['opis_posla'] = validacija($_POST, 'opis_posla', true, "", "./novi.php?msg=err14");
        $vrijednosti_opis_posla['plata'] = validacija($_POST, 'plata', true, "", "./novi.php?msg=err15");
        $vrijednosti_opis_posla['vjestine'] = validacija($_POST, 'vjestine', false, "", "");
        $vrijednosti_opis_posla['napomena'] = validacija($_POST, 'napomena', false, "", "");

        mysqli_query($dbconn, "BEGIN");

        if(izmijeni("radnik", $vrijednosti, $id)){
            $rz_id = mysqli_fetch_row(mysqli_query($dbconn, "select id from radnik_zaposlenje where radnik_id = $id"))[0];
            if(izmijeni("radnik_zaposlenje", $vrijednosti_status_zaposlenja, $rz_id)){
                $rp_id = mysqli_fetch_row(mysqli_query($dbconn, "select id from radnik_pozicija where radnik_id = $id"))[0];
                if(izmijeni("radnik_pozicija", $vrijednosti_opis_posla, $rp_id)){
                    mysqli_query($dbconn, "COMMIT");
                    redirect("./index.php?msg=uspjesna_izmjena");
                }else mysqli_query($dbconn, "ROLLBACK");
            }else mysqli_query($dbconn, "ROLLBACK");
        }else mysqli_query($dbconn, "ROLLBACK");
        
        redirect("./index.php?msg=neuspjesna_izmjena");

    }else{
        exit("Nepravilan metod!");
    }

?>