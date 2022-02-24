<?php
    require "./Funciones/conecta.php";
    $con = conecta();

    $id = $_REQUEST['id_sel'];
    $nombre = $_REQUEST['nombre'];
    $archivo_n = $_FILES['archivo']['name'];
    $temp = $_FILES['archivo']['tmp_name'];
    $archName = substr($archivo_n, 0,strripos($archivo_n, "."));
    $ext = substr(strrchr($archivo_n, "."), 1);
    $archivo = md5_file($temp);
    $dir = "archivos/";
    $tx = '';

    if ($archivo_n != '') {
        $fileName1 = "$archivo.$ext";
        $tx = $tx.", archivo = '$archivo.$ext'";
        copy($temp, $dir.$fileName1);
    }

    $sql = "UPDATE banners SET nombre = '$nombre' $tx WHERE id = '$id'";
    //echo $sql;
    $res = mysql_query($sql, $con);

    header("Location: lista_banners.php");
?>