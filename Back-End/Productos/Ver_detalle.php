<?php
    session_start();

    if (!$_SESSION['idU']) {
        header("Location: ../Administrador/index.php");
    }
    $name = $_SESSION['nombre'];
    require "./Funciones/conecta.php";
    $con = conecta();
    $id = $_REQUEST['id'];

    $sql = "SELECT * FROM productos WHERE id = $id";
    $res = mysql_query($sql, $con);

    $nombre = mysql_result($res, 0, "nombre");
    $codigo = mysql_result($res, 0, "codigo");
    $desc = mysql_result($res, 0, "descripcion");
    $costo = mysql_result($res, 0, "costo");
    $stock = mysql_result($res, 0, "stock");
    $status = mysql_result($res, 0, "status");
    $text_status = ($status == 1) ? "Activo" : "Inactivo";
    $arch_n = mysql_result($res, 0, "archivo_n");
    $ext = substr(strrchr($arch_n, "."), 1);
    $arch = mysql_result($res, 0, "archivo");
    $dir = "archivos/";
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
                <!--<th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="./Ver_detalle.php?id=<?php echo $idU?>">Detalles de Administrador</a></th>-->
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
            window.location = "./lista_productos.php";
        }
    </script>
    <style>
        table {
            width: 600px;
            border-collapse: separate;
            border: 1px solid #000000;
        }
        th {
            width: 20%;
            border: 1px solid #000000;
            background-color: #6AED62;

        }
        td {
            width: 20%;
            border: solid 1px #000000;
            text-align: center;
            background-color: #FF9713;
        }
    </style>
    <body background="./Imagenes/cat.gif">
    <table align="center">
        <tr>
            <th style="background-color: #FF3131;" colspan="5">Información detallada del producto con ID <?php echo $id; ?></th>
        </tr>
        <tr>
            <th>Nombre</th>
            <th>Codigo</th>
            <th>Costo</th>
            <th>Stock</th>
            <th>Estatus</th>
        </tr>
        <tr>
            <td><?php echo "$nombre"; ?></td>
            <td><?php echo "$codigo"; ?></td>
            <td>$<?php echo number_format($costo, 2, '.', ','); ?></td>
            <td><?php echo "$stock"; ?></td>
            <td><?php echo "$text_status"; ?></td>
        </tr>
        <tr>
            <th colspan="5">Descripción</th>
        </tr>
        <tr>
            <td colspan="5"><?php echo "$desc"; ?></td>
        </tr>
        <tr>
            <th colspan="5">Imagen</th>
        </tr>
        <tr>
            <td colspan="5"><img src="<?php echo $dir."$arch.$ext" ?>" style="width: 200px; height: 200px;"/></td>
        </tr>
    </table><br>
    <div align="center">
        <button onclick="volver();">Volver al listado</button>
    </div>
    </body>
</html>