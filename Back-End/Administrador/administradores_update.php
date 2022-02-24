<?php
    require "./Funciones/conecta.php";
    $con = conecta();

    $id = $_REQUEST['id_sel'];
    $nombre = $_REQUEST['nombre'];
    $apellidos = $_REQUEST['apellido'];
    $correo = $_REQUEST['correo'];
    $pass = $_REQUEST['pasw'];
    $rol = $_REQUEST['rol'];
    $archivo_n = $_FILES['archivo']['name'];
    $temp = $_FILES['archivo']['tmp_name'];
    $archName = substr($archivo_n, 0,strripos($archivo_n, "."));
    $ext = substr(strrchr($archivo_n, "."), 1);
    $archivo = md5_file($temp);
    $dir = "archivos/";
    $tx = '';

    if ($pass != '') {
        $pass = md5($pass);
        $tx = ", pass = '$pass'";
    }
    if ($archivo_n != '') {
        $fileName1 = "$archivo.$ext";
        $tx = $tx.", archivo_n = '$archivo_n', archivo = '$archivo'";
        copy($temp, $dir.$fileName1);
    }

    $sql = "UPDATE administradores SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo',
    rol = '$rol' $tx WHERE id = '$id'";

    //echo $sql;
    $res = mysql_query($sql, $con);

    header("Location: B2.php");
?>