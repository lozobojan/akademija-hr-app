<?php 

    include '../db.php';
    include '../funkcije.php';

    $id = validacija($_GET, 'id', true, "", "./index.php?msg=err0");

    if(is_numeric($id)){
        
        if(brisi("radnik", $id)){
            redirect("./index.php?msg=uspjesno_brisanje");
        }else{
            redirect("./index.php?msg=neuspjesno_brisanje");
        }

    }
?>