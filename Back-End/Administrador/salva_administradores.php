<?php
    require "../Administrador/Funciones/conecta.php";
    $con = conecta();

    $nombre = $_REQUEST['nombre'];
    $apellido = $_REQUEST['apellido'];
    $correo = $_REQUEST['correo'];
    $rol = $_REQUEST['rol'];
    $pass = $_REQUEST['pasw'];
    $archivo_n = $_FILES['archivo']['name'];
    $temp = $_FILES['archivo']['tmp_name'];
    $archName = substr($archivo_n, 0,strripos($archivo_n, "."));
    $ext = substr(strrchr($archivo_n, "."), 1);
    $archivo = md5_file($temp);
    $dir = "archivos/";

    if ($pass != '') {
        $pass = md5($pass);
    }

    $sql = "INSERT INTO administradores VALUES (0, '$nombre', '$apellido', '$correo', '$pass', '$rol','$archivo_n', '$archivo', 1, 0)";
    //echo $sql;
    $res = mysql_query($sql, $con);
    if ($archivo_n != '') {
        $fileName1 = "$archivo.$ext";
        copy($temp, $dir.$fileName1);
    }

    header("location: B2.php");
?>