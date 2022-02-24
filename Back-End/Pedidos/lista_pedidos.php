<?php
    session_start();

    if (!$_SESSION['idU']) {
        header("Location: ../Administrador/index.php");
    }
    require "./Funciones/conecta.php";
    $con = conecta();
    $idU = $_SESSION['idU'];
    $name = $_SESSION['nombre'];
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
    <title>Lista de Pedidos</title>
    <header align="center" style="font-weight: bold; font-size:large">Lista de Pedidos</header>
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script>
        function detalle(id) {
            window.location = "./Ver_detalle.php?id="+id;
        }
    </script>
    <style>
        table {
            width: 750px;
            border-collapse: separate;
            border: 1px solid #000000;
            background-color: blue; 
        }
        th {
            width: 25%;
            border: 1px solid #000000;
            background-color: chartreuse;
        }
        td {
            width: 25%;
            border: 1px solid #000000;
            background-color: skyblue;
            text-align: center;
        }
        .error {
            color: red;
        }
    </style>
</head>

<body>
        <?php
            $sql = "SELECT * FROM pedidos WHERE status = 1 ORDER BY id";
            $res = mysql_query($sql, $con);
            $num = mysql_num_rows($res);
        ?>    
            <!--<p style="text-align: center;">
            <a href="./alta_pedidos.php">Añadir pedidos</a><br>
            </p>--><br>
            <table align= "center">
            <th>Id</th>
            <th>Fecha</th>
            <th>Usuario</td>
            <th>Acciones</th>
        <?php
            for ($i = 0; $i < $num;$i++) {
                $id = mysql_result($res, $i, "id");
                $fecha = mysql_result($res, $i, "fecha");
                $usuario = mysql_result($res, $i, "usuario");
                echo "<tr id=\"Fila$id\">
                <td style=\"width: 10%;\">$id</td>
                <td align=\"center\" id = \"name$id\">$fecha</td>
                <td>$usuario</td>
                <td align=\"center\"><button onclick = \"detalle($id);\">Ver detalle</button></td>
                </tr>";
            }
        ?>
            </table>
        <div id="mensaje" class="error"></div>
</body>

</html>