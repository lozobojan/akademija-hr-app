<?php 

    function redirect($url){
        header("location: $url");
        exit();
    }

    function debug($var){
        var_dump($var);
        exit;
    }

    function sifarnik($tabela, $selected_id = null){
        global $dbconn;
        $res = mysqli_query($dbconn, "SELECT * FROM $tabela ORDER BY naziv ASC");
        while($row = mysqli_fetch_assoc($res)){
            $selected_temp = "";
            if($selected_id != null && $row['id'] == $selected_id ) $selected_temp = "selected";
            echo "<option value=\"".$row['id']."\" $selected_temp >".$row['naziv']."</option>";
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

    function izmijeni($tabela, $vrijednosti, $id){
        global $dbconn;
        $cols = [];
        foreach($vrijednosti as $key => $val ){
            $cols[] = " `$key` = '$val' ";
        }
        $sql = " UPDATE $tabela SET ".implode(", ", $cols)." WHERE id = $id ";
        if(mysqli_query($dbconn, $sql)){
            return true;
        }else{
            return false;
        }
    }

    function brisi($tabela, $id, $soft = true){
        global $dbconn;
        if($soft){
            $sql = " UPDATE $tabela SET obrisan = true WHERE id = $id ";
        }else{
            $sql = " DELETE FROM $tabela WHERE id = $id ";
        }
        if(mysqli_query($dbconn, $sql)){
            return true;
        }else{
            return false;
        }
    }

    function putanja($dubina){
        $res = "";
        while($dubina > 0){
            $res .= "../";
            $dubina--;
        }
        return $res;
    }

    function uploadFile( $file, $subfolder ){
        $original_name = $_FILES[$file]['name'];
        $tmp_name = $_FILES[$file]['tmp_name'];
        // originalna ekstenzija
        $temp_arr = explode(".", $original_name );
        $ext = $temp_arr[ count($temp_arr)-1 ];
        
        mkdir("../uploads/".$subfolder);
        $new_file_name = "../uploads/".$subfolder."/".uniqid().".".$ext;
        copy($tmp_name, $new_file_name);

        return $new_file_name;
    }
?>