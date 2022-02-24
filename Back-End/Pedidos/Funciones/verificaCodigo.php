<?php
    require "conecta.php";
    $con = conecta();

    $codigo = $_REQUEST['codigo'];
    $cantidad = $_REQUEST['cantidad'];
    $num = 0;

    if ($codigo) {
        $sql = "SELECT * FROM productos 
                WHERE id = '$codigo' 
                AND eliminado = 0 
                AND status = 1";
        $res = mysql_query($sql, $con);
        $num = mysql_num_rows($res);
        $stock = mysql_result($res, 0, "stock");
    }
    if ($cantidad > $stock) {
        $num = 2;
    }
    //echo $sql;
    echo $num;
?>