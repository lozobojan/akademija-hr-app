<?php 

    include '../db.php';
    include '../funkcije.php';

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        isset($_POST['ime']) && $_POST['ime'] != "" ? $ime = $_POST['ime'] : redirect("./novi.php?msg=err1");
        isset($_POST['prezime']) && $_POST['prezime'] != "" ? $prezime = $_POST['prezime'] : redirect("./novi.php?msg=err2");
        isset($_POST['datum_rodjenja']) && $_POST['datum_rodjenja'] != "" ? $datum_rodjenja = $_POST['datum_rodjenja'] : redirect("./novi.php?msg=err3");
        isset($_POST['grad_id']) && $_POST['grad_id'] != "" ? $grad_id = $_POST['grad_id'] : redirect("./novi.php?msg=err4");
        isset($_POST['adresa']) && $_POST['adresa'] != "" ? $adresa = $_POST['adresa'] : redirect("./novi.php?msg=err5");

        // TODO: FOTOGRAFIJA !!!

        isset($_POST['telefon1']) && $_POST['telefon1'] != "" ? $telefon1 = $_POST['telefon1'] : redirect("./novi.php?msg=err6");
        isset($_POST['telefon2']) && $_POST['telefon2'] != "" ? $telefon2 = $_POST['telefon2'] : $telefon2 = "";
        isset($_POST['email']) && $_POST['email'] != "" ? $email = $_POST['email'] : redirect("./novi.php?msg=err8");
        isset($_POST['kancelarija']) && $_POST['kancelarija'] != "" ? $kancelarija = $_POST['kancelarija'] : redirect("./novi.php?msg=err9");

        $sql_insert = "INSERT INTO radnik (
                                            ime,
                                            prezime,
                                            datum_rodjenja,
                                            grad_id,
                                            adresa,
                                            telefon1,
                                            telefon2,
                                            email,
                                            kancelarija
                                        )
                        VALUES          (
                                            '$ime',
                                            '$prezime',
                                            '$datum_rodjenja',
                                             $grad_id,
                                            '$adresa',
                                            '$telefon1',
                                            '$telefon2',
                                            '$email',
                                            '$kancelarija'
                                        )
                                        ";
        $res_insert = mysqli_query($dbconn, $sql_insert);
        if($res_insert){
            redirect("./index.php?msg=uspjesno_dodavanje");
        }else{
            echo "Greska pri upitu: ";
            echo "<pre>".$sql_insert."</pre>";
            exit;
        }

    }else{
        exit("Nepravilan metod!");
    }

?>