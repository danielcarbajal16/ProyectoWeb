<?php
    require "../Back-End/Administrador/Funciones/conecta.php";
    $con = conecta();

    $id = $_REQUEST['id'];
    $num = 0;

    if ($id > 0) {
        //$sql = "DELETE FROM pedidos_productos WHERE id = $id";
        $sql = "UPDATE pedidos SET status = 1 WHERE id = $id";
        $res = mysql_query($sql, $con);
        $num = mysql_affected_rows();
    }

    echo $num;
?>