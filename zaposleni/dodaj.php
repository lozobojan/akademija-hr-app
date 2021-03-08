<?php 

    include '../db.php';
    include '../funkcije.php';

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $vrijednosti = [];
        $vrijednosti_status_zaposlenja = [];
        $vrijednosti_opis_posla = [];

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
        $vrijednosti_status_zaposlenja['datum_isteka_ugovora'] = validacija($_POST, 'datum_isteka_ugovora', false, "", "");

        // OPIS POSLA
        $vrijednosti_opis_posla['sektor_id'] = validacija($_POST, 'sektor_id', true, "", "./novi.php?msg=err12");
        $vrijednosti_opis_posla['naziv_pozicije'] = validacija($_POST, 'pozicija', true, "", "./novi.php?msg=err13");
        $vrijednosti_opis_posla['opis_posla'] = validacija($_POST, 'opis_posla', true, "", "./novi.php?msg=err14");
        $vrijednosti_opis_posla['plata'] = validacija($_POST, 'plata', true, "", "./novi.php?msg=err15");
        $vrijednosti_opis_posla['vjestine'] = validacija($_POST, 'vjestine', false, "", "");
        $vrijednosti_opis_posla['napomena'] = validacija($_POST, 'napomena', false, "", "");

        // upisujemo radnika u bazu podataka
        mysqli_query($dbconn, "BEGIN");
        $novi_id = sacuvaj( "radnik", $vrijednosti );
        
        if($novi_id){
            
            // dodajemo vezane vrijednosti
            $vrijednosti_status_zaposlenja['radnik_id'] = $novi_id;
            $vrijednosti_opis_posla['radnik_id'] = $novi_id;

            $novi_id_status = sacuvaj("radnik_zaposlenje", $vrijednosti_status_zaposlenja);
            $novi_id_pozicija = sacuvaj("radnik_pozicija", $vrijednosti_opis_posla);

            if($novi_id_status && $novi_id_pozicija){
                mysqli_query($dbconn, "COMMIT");
                redirect("./index.php?msg=uspjesno_dodavanje");
            }else{
                mysqli_query($dbconn, "ROLLBACK");
                exit("Greska pri dodavanju u vezane tabele!");
            }

        }else{
            mysqli_query($dbconn, "ROLLBACK");
            exit("Greska pri upitu za dodavanje!");
        }

    }else{
        exit("Nepravilan metod!");
    }

?>