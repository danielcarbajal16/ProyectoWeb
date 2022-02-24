<?php
    session_start();

    if (!$_SESSION['idU']) {
        header("Location: ./index.php");
    }
    $name = $_SESSION['nombre'];
    require "./Funciones/conecta.php";
    $con = conecta();
    $id = $_REQUEST['id'];

    $sql = "SELECT * FROM administradores WHERE id = $id";
    $res = mysql_query($sql, $con);

    $nombre = mysql_result($res, 0, "nombre");
    $apellidos = mysql_result($res, 0, "apellidos");
    $correo = mysql_result($res, 0, "correo");
    $rol = mysql_result($res, 0, "rol");
    $status = mysql_result($res, 0, "status");
    $text_rol = ($rol == 1) ? 'Gerente' : 'Ejecutivo';
    $text_status = ($status == 1) ? "Activo" : "Inactivo";
    $arch_n = mysql_result($res, 0, "Archivo_n");
    $ext = substr(strrchr($arch_n, "."), 1);
    $arch = mysql_result($res, 0, "Archivo");
    $dir = "archivos/";
?>

<html>
    <head>
        <meta charset="utf-8">
        <div style="text-align: center;">
            <table align="center" style="width: 1200px; border: 1px solid #000000; border-collapse: separate; background-color: blue; font-family: helvetica;">
                <tr>
                    <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="./bienvenido.php">Inicio</a></th>
                    <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="./B2.php">Lista de Administradores</a></th>
                    <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="../Productos/lista_productos.php">Productos</a></th>
                    <td style="width: 300px; border: solid 1px #000000; background-color: skyblue; color: green; text-align: center; font-weight: bold;">Hola <?php echo $name?></td>
                    <!--<th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="./editar.php?id=<?php echo $id?>">Editar Administrador</a></th>-->
                    <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="../Pedidos/lista_pedidos.php">Pedidos</a></th>
                    <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="./cerrar_sesion.php">Cerrar sesión</a></th>
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
            window.location = "./B2.php";
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
            <th style="background-color: #FF3131;" colspan="5">Información detallada del usuario con ID <?php echo $id; ?></th>
        </tr>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Estatus</th>
            <th>Imagen</th>
        </tr>
        <tr>
            <td><?php echo "$nombre $apellidos"; ?></td>
            <td><?php echo "$correo"; ?></td>
            <td><?php echo "$text_rol"; ?></td>
            <td><?php echo "$text_status"; ?></td>
            <td><img src="<?php echo $dir."$arch.$ext" ?>" style="width: 110px; height: 110px;"/></td>
        </tr>
    </table><br>
    <div align="center">
        <button onclick="volver();">Volver al listado</button>
    </div>
    </body>
</html>