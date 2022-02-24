<?php
    session_start();

    if(!$_SESSION['idU']) {
        header("Location: ./index.php");
    }

    //$_SESSION['idU'] = '25';
    //$_SESSION['nombre'] = "Daniel Carbajal";
    //$_SESSION['correo'] = "dancar@gmail.com";
    $idU = $_SESSION['idU'];
    $nombreUsuario = $_SESSION['nombre'];
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sistema de Administración</title>
        <style>
            table {
                width: 1200px;
                border: 1px solid #000000;
                border-collapse: separate;
                background-color: blue;
            }
            th {
                width: 150px;
                border: solid 1px #000000;
                background-color: skyblue;
            }
            td {
                width: 300px;
                border: solid 1px #000000; 
                background-color: skyblue;
                color: green;
                text-align: center;
                font-weight: bold;
            }
        </style>
    </head>
    <body background="./Imagenes/pizza.gif" style="font-family: helvetica;">
        <div style="text-align: center;">
            <table align="center">
                <tr>
                    <th><a href="./bienvenido.php">Inicio</a></th>
                    <th><a href="./B2.php">Lista de Administradores</a></th>
                    <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="../Productos/lista_productos.php">Productos</a></th>
                    <td>Hola <?php echo $nombreUsuario ?></td>
                    <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="../Banners/lista_banners.php">Banners</a></th>
                    <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="../Pedidos/lista_pedidos.php">Pedidos</a></th>
                    <th><a href="./cerrar_sesion.php">Cerrar sesión</a></th>
                </tr>
            </table>
        </div><br>
        <div align="center">
            <div style="text-align: center; background-color: skyblue; width: 500px">
                Bienvenido al sistema de Administración 
                <?php echo $nombreUsuario ?> 
            </div>
        </div>
    </body>
</html>