<?php 

    include 'db.php';
    include 'funkcije.php';

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $korisnicko_ime = validacija($_POST, 'korisnicko_ime', true, "", "./login.html?msg=err2");
        $lozinka = validacija($_POST, 'lozinka', true, "", "./login.html?msg=err3");

        $lozinka = md5($lozinka);
        $sql = "SELECT * FROM korisnik WHERE korisnicko_ime = '$korisnicko_ime' AND lozinka = '$lozinka' ";
        $res = mysqli_query($dbconn, $sql);

        if(mysqli_num_rows($res) > 0 ){
            $korisnik = mysqli_fetch_assoc($res);
            $_SESSION['prijava'] = true;
            $_SESSION['korisnik_id'] = $korisnik['id'];
            $_SESSION['uloga_id'] = $korisnik['uloga_id'];
            $_SESSION['korisnik_ime_prezime'] = $korisnik['ime']." ".$korisnik['prezime'];
            redirect('./index.php?msg=welcome');
        }else{
            redirect('./login.html?msg=pogresni_kredencijali');
        }

    }else{
        redirect('./login.html?msg=err1');
    }

?>