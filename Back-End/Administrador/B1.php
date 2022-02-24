<html>

<head>
    <title>Eliminar Filas con JS</title>
    <header align="center" style="font-weight: bold; font-size:large">Lista de administradores</header>
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script>
        function eliminar(id) {
            window.location = "./elimina_administradores.php?id="+id;
        }
    </script>
    <style>
        table {
            width: 750px;
            border-collapse: separate;
            border: 1px solid #000000; 
        }
        th {
            width: 20%;
            border: 1px solid #000000;
            background-color: chartreuse;
        }
        td {
            width: 20%;
            border: 1px solid #000000;
            background-color: skyblue;
        }
    </style>
</head>

<body>
        <?php
            require "./Funciones/conecta.php";
            $con = conecta();

            $sql = "SELECT * FROM administradores WHERE Status = 1 AND Eliminado = 0";
            $res = mysql_query($sql, $con);
            $num = mysql_num_rows($res);
            
            echo "<p style=\"text-align: center;\">";
            echo "<a href= \"./alta_administradores.php\">Crear nuevo registro</a><br><br>";
            echo "</p>";
            echo "<table align= \"center\">";
            echo "<th>Id</th>
            <th>Nombre</th>
            <th>Correo</td>
            <th>Rol</th>
            <th>Eliminar</th>";
            for ($i = 0; $i < $num;$i++) {
                $id = mysql_result($res, $i, "Id");
                $nombre = mysql_result($res, $i, "Nombre");
                $apellidos = mysql_result($res, $i, "Apellidos");
                $correo = mysql_result($res, $i, "Correo");
                $rol = mysql_result($res, $i, "Rol");
                $text_rol = ($rol == 1) ? 'Gerente' : 'Administrador';
                echo "<tr>
                <td>$id</td>
                <td align=\"center\">$nombre $apellidos</td>
                <td>$correo</td>
                <td align=\"center\">$text_rol</td>
                <td align=\"center\"><button onclick = \"eliminar($id);\">Eliminar</button></td>
                </tr>";
            }
            echo "</table>";
        ?>
</body>

</html>