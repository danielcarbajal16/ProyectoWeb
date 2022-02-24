<?php
    session_start();

    if (!$_SESSION['idU']) {
        header("Location: ../Administrador/index.php");
    }
    $name = $_SESSION['nombre'];
    require "./Funciones/conecta.php";
    $con = conecta();
    $idPedido = $_REQUEST['id'];

    $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $idPedido";
    $res = mysql_query($sql, $con);
    $num = mysql_num_rows($res);

    $nombre = mysql_result($res, 0, "nombre");
    $total = 0;
?>

<html>
    <head>
        <meta charset="utf-8">
        <div style="text-align: center;">
            <table align="center" style="width: 1200px; border: 1px solid #000000; border-collapse: separate; background-color: blue; font-family: helvetica;">
                <tr>
                    <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="../Administrador/bienvenido.php">Inicio</a></th>
                    <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="../Administrador/B2.php">Lista de Administradores</a></th>
                    <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="../Productos/lista_productos.php">Productos</a></th>
                    <td style="width: 300px; border: solid 1px #000000; background-color: skyblue; color: green; text-align: center; font-weight: bold;">Hola <?php echo $name?></td>
                    <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="../Pedidos/lista_pedidos.php">Pedidos</a></th>
                    <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="../Administrador/cerrar_sesion.php">Cerrar sesión</a></th>
                </tr>
            </table>
        </div><br>
        <title>Ver detalles</title>
        <div align="center">
            <div style="background-color: green; width: 140px;">
                <header align="center" style="font-weight: bold; font-size:large; color:silver">Ver detalles</header>
            </div>
        </div><br>
    </head>
    <script>
        function volver() {
            window.location = "./lista_pedidos.php";
        }
    </script>
    <style>
        table {
            width: 600px;
            border-collapse: separate;
            border: 1px solid #000000;
        }
        th {
            width: 25%;
            border: 1px solid #000000;
            background-color: #6AED62;

        }
        td {
            width: 25%;
            border: solid 1px #000000;
            text-align: center;
            background-color: #FF9713;
        }
    </style>
    <body background="./Imagenes/cat.gif">
    <table align="center">
        <tr>
            <th style="background-color: #FF3131;" colspan="4">Información detallada del pedido con ID <?php echo $id; ?></th>
        </tr>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Costo Unitario</th>
            <th>Subtotal</th>
        </tr>
        <?php
                for ($i = 0; $i < $num;$i++) {
                    $idProducto = mysql_result($res, $i, "id_producto");
                    $cantidad = mysql_result($res, $i, "cantidad");
                    $precio = mysql_result($res, $i, "precio");
                    $subtotal = $cantidad*$precio;
                    $total = $total+$subtotal;
                    $sql = "SELECT * FROM productos 
                    WHERE id = '$idProducto'";
                    $res = mysql_query($sql, $con);
                    $nombre = mysql_result($res, 0, "nombre");
                    $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $idPedido";
                    $res = mysql_query($sql, $con);
                    echo "<tr>
                    <td>$nombre</td>
                    <td>$cantidad</td>
                    <td>$".number_format($precio, 2, '.', ',')."</td>
                    <td>$".number_format($subtotal, 2, '.', ',')."</td>
                    </tr>";
                }
                echo "<tr>
                <td colspan=\"3\">Total</td>
                <td>$".number_format($total, 2, '.', ',')."</td>
                </tr>";
            ?>
    </table><br>
    <div align="center">
        <button onclick="volver();">Volver al listado</button>
    </div>
    </body>
</html>