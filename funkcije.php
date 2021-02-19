<?php 

    function redirect($url){
        header("location: $url");
        exit();
    }

    function sifarnik($tabela){
        global $dbconn;
        $res = mysqli_query($dbconn, "SELECT * FROM $tabela ORDER BY naziv ASC");
        while($row = mysqli_fetch_assoc($res)){
            echo "<option value=\"".$row['id']."\">".$row['naziv']."</option>";
        }
    }

    function validacija($niz, $kljuc, $required = false, $default = "", $url = "" ){
        if(isset($niz[$kljuc]) && $niz[$kljuc]){
            return $niz[$kljuc];
        }else{
            redirect($url);
        }
    }

    function sledeciID($tabela){
        global $dbconn;
        return mysqli_fetch_row(mysqli_query($dbconn, "SELECT COALESCE(MAX(id), 0)+1 FROM $tabela"))[0];
    }

    function sacuvaj($tabela, $vrijednosti){
        global $dbconn;
        $novi_id = sledeciID($tabela);

        $cols = [ "`id`" ];
        $vals = [ "'".$novi_id."'" ];
        foreach($vrijednosti as $key => $val ){
            $cols[] = "`".$key."`";
            $vals[] = "'".$val."'";
        }
        $sql = "INSERT INTO $tabela ( ". implode(", ", $cols) ." ) VALUES  (". implode(", ", $vals) . ")" ;
        if(mysqli_query($dbconn, $sql)){
            return $novi_id;
        }else{
            return false;
        }
    }
?>