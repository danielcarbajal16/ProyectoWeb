<?php
    session_start();

    require "./Funciones/conecta.php";
    $con = conecta();

    $idProducto = $_REQUEST['producto'];
    $cantidad = $_REQUEST['cantidad'];
    //echo $idProducto.' '.$cantidad;

    $fecha = date("Y-m-d",mktime(0,0,0,date("m")-1,rand(1,36),date("Y")));
    //echo "<br>".$_SESSION['nombre'];
    if ($_SESSION['nombre']) {
        $usuario = $_SESSION['nombre'];
    }
    else {
        $_SESSION['nombre'] = time()+rand();
    }
    //echo "<br>".$usuario;
    //Verifica que haya o no un pedido abierto
    $sql = "SELECT * FROM pedidos WHERE status = 0 AND usuario = '$usuario'";
    //echo $sql;
    $res = mysql_query($sql, $con);
    $num = mysql_num_rows($res);
    //echo " ".$num;
    if ($num == 1) {
        $idPedido = mysql_result($res, 0, "id");
    } else {
        $sql = "INSERT INTO pedidos VALUES (0, '$fecha', '$usuario', 0)";
        $res = mysql_query($sql, $con);
        $sql = "SELECT * FROM pedidos WHERE status = 0 AND usuario = '$usuario'";
        //echo $sql;
        $res = mysql_query($sql, $con);
        $idPedido = mysql_result($res, 0, "id");
    }   


    //saca costo actual
    $sql = "SELECT * FROM productos WHERE id = $idProducto";
    //echo "<br>".$sql;
    $res = mysql_query($sql, $con);
    $costo = mysql_result($res, 0, "costo");

    //verifica existencia del producto
    $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $idPedido AND id_producto = $idProducto";
    //echo "<br>".$sql;
    $res = mysql_query($sql, $con);
    $num = mysql_num_rows($res);
    if ($num == 1) {
        //Actualiza cantidad
        $idPP = mysql_result($res, 0, "id");
        $sql = "UPDATE pedidos_productos SET cantidad = cantidad + $cantidad WHERE id = $idPP";
        //echo "<br>".$sql;
        $res = mysql_query($sql, $con);
    }
    else {
        $sql = "INSERT INTO pedidos_productos VALUES (0, $idPedido, $idProducto, $cantidad, $costo)";
        $res = mysql_query($sql, $con);
        //echo "<br>".$sql;
    }

    header("location: lista_pedidos.php");
?>