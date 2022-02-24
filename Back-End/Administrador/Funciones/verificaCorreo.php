<?php
    require "conecta.php";
    $con = conecta();

    $id = $_REQUEST['id'];
    $correo = $_REQUEST['correo'];
    $num = 0;

    if ($correo) {
        $tx = ($id > 0) ? "AND id != $id" : '';
        $sql = "SELECT * FROM administradores 
                WHERE correo = '$correo' 
                AND eliminado = 0 $tx";
        $res = mysql_query($sql, $con);
        $num = mysql_num_rows($res);
    }

    echo $num;
?>