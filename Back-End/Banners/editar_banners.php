<?php
    session_start();

    if (!$_SESSION['idU']) {
        header("Location: ../Administrador/index.php");
    }
    $idU = $_SESSION['idU'];
    $name = $_SESSION['nombre'];
    require "./Funciones/conecta.php";
    $con = conecta();
    $id = $_REQUEST['id'];

    $sql = "SELECT * FROM banners WHERE id = $id";
    $res = mysql_query($sql, $con);

    $nombre = mysql_result($res, 0, "nombre");
    $arch = mysql_result($res, 0, "archivo");
    $ext = substr(strrchr($arch, "."), 1);
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
                <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="../Banners/lista_banners.php">Banners</a></th>
                <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="../Administrador/cerrar_sesion.php">Cerrar sesión</a></th>
            </tr>
        </table>
    </div><br>
    <title>Edición de Banners</title>
    <header align="center" style="font-weight: bold; font-size:large ">Edición de Banners</header>
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script>
        function valida() {
            var ok = true;
            var nombre = document.forma01.nombre.value;
            if (nombre == "") {
                ok = false;
                console.log("No nombre");
            }

            if (ok == false) {
                $('#error').html('Faltan campos por llenar');
                setTimeout("$('#error').html('');",5000);
            }
            else {
                document.forma01.method = 'post';
                document.forma01.action = 'banners_update.php';
                document.forma01.submit();
            }
            return ok;
        }
    </script>
    <style>
        .error {
            display: inline;
            color: red;
        }
    </style>
</head>

<body style = "background: linear-gradient(green, skyblue);">
    <div align="center">
    <br><button onclick="window.location= './lista_banners.php';">Regresar al listado.</button><br><br>
        <form enctype="multipart/form-data" name="forma01" action="banners_update.php" method="POST">
            <label>
                Nombre:
                <input id="campo1" type="text" name="nombre" placeholder="Escribe tu nombre" value="<?php echo $nombre; ?>" required>
            </label>
            <br><br>
            <input type="file" id="archivo" name="archivo"/><br><br>
            <input onClick="valida();" type="button" value="Actualizar"/>
            <input type="hidden" id="id_sel" name="id_sel" value="<?php echo $id;?>"/><br>
            <div id="error" class="error"></div>
        </form>
    </div>

</body>

</html>