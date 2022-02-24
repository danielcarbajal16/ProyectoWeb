<?php
    require "./Funciones/conecta.php";
    $con = conecta();

    $nombre = $_REQUEST['nombre'];
    $archivo_n = $_FILES['archivo']['name'];
    $temp = $_FILES['archivo']['tmp_name'];
    //$archName = substr($archivo_n, 0,strripos($archivo_n, "."));
    $ext = substr(strrchr($archivo_n, "."), 1);
    $archivo = md5_file($temp);
    $dir = "archivos/";

    $sql = "INSERT INTO banners VALUES (0, '$nombre', '$archivo.$ext', 1, 0)";
    //echo $sql;
    $res = mysql_query($sql, $con);
    if ($archivo_n != '') {
        $fileName1 = "$archivo.$ext";
        copy($temp, $dir.$fileName1);
    }

    header("location: lista_banners.php");
?>