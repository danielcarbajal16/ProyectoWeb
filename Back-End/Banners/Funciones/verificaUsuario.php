<?php
    session_start();
    require "./conecta.php";
    $con = conecta();

    $pass = $_REQUEST['pass'];
    $correo  = $_REQUEST['correo'];
    $num = 0;
    $pass = md5($pass);

    if ($correo) {
        $sql = "SELECT * FROM administradores 
                WHERE correo = '$correo' 
                AND pass = '$pass'
                AND eliminado = 0
                AND status = 1";
        $res = mysql_query($sql, $con);
        $num = mysql_affected_rows();
    }
    //echo $sql;
    if ($num) {
        $idU = mysql_result($res, 0, "id");
        $nombre = mysql_result($res, 0, "nombre").' '.mysql_result($res, 0, "apellidos");
        $_SESSION['idU'] = $idU;
        $_SESSION['nombre'] = $nombre;
    }

    echo $num;
?>