<?php
    require "../Back-End/Administrador/Funciones/conecta.php";
    $con = conecta();

    $id = $_REQUEST['id'];
    $cantidad = $_REQUEST['cantidad'];
    $num = 0;

    if ($id > 0) {
        $sql = "UPDATE pedidos_productos SET cantidad = $cantidad WHERE id_producto = $id";
        //$sql = "UPDATE productos SET eliminado = 1 WHERE id = $id";
        $res = mysql_query($sql, $con);
        $num = mysql_affected_rows();
    }

    echo $num;
?>