<?php
    require "./Funciones/conecta.php";
    $con = conecta();

    $sql = "SELECT * FROM administradores WHERE Status = 1 AND Eliminado = 0";
    $res = mysql_query($sql, $con);
    $num = mysql_num_rows($res);

    echo "<a href= \"./alta_administradores.php\">Alta de Administradores</a><br><br>";
    for ($i = 0; $i < $num;$i++) {
        $id = mysql_result($res, $i, "Id");
        $nombre = mysql_result($res, $i, "Nombre");
        $apellidos = mysql_result($res, $i, "Apellidos");
        echo "$id --- $nombre $apellidos";
        echo "--------<a href=\"./elimina_administradores.php?id=$id\">Presiona para eliminar</a><br>";
    }
?>