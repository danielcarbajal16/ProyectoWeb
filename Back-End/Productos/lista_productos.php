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
    <title>Lista de Productos</title>
    <header align="center" style="font-weight: bold; font-size:large">Lista de Productos</header>
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script>
        function editar(id) {
            window.location = "./editar_productos.php?id="+id;
        }
        function detalle(id) {
            window.location = "./Ver_detalle.php?id="+id;
        }
        function deleteAdministrador(id){
            var nombre = $('#name'+id).val();
            console.log(nombre+' y '+id);
            if (id > 0){
                if (confirm("Estás seguro de eliminar la fila con ID " + id + "?")) {
                    $.ajax({
                        url 	: './elimina_productos.php',
                        type 	: 'post',
                        dataType : 'text',
                        data    : 'id='+id,
                        success :function(res){
                            if (res>0){
                                $('#Fila' + id).hide();
                                $('#mensaje').html('El usuario con ID: '+id+' ha sido eliminado');
                                setTimeout("$('#mensaje').html('');",5000);
                            }
                        }, error: function(){
                            alert ('Error al conectar al servidor...');
                        }
                    });
                }
            }
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
            width: 20%;
            border: 1px solid #000000;
            background-color: chartreuse;
        }
        td {
            width: 20%;
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
            $sql = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0";
            $res = mysql_query($sql, $con);
            $num = mysql_num_rows($res);
        ?>    
            <p style="text-align: center;">
            <a href="./alta_productos.php">Añadir productos</a><br>
            </p>
            <table align= "center">
            <th style="width: 10%;">Id</th>
            <th>Nombre</th>
            <th>Codigo</td>
            <th>Costo</th>
            <th colspan = "3">Acciones</th>
        <?php
            for ($i = 0; $i < $num;$i++) {
                $id = mysql_result($res, $i, "id");
                $nombre = mysql_result($res, $i, "nombre");
                $codigo = mysql_result($res, $i, "codigo");
                $costo = mysql_result($res, $i, "costo");
                //$stock = mysql_result($res, $i, "stock");
                echo "<tr id=\"Fila$id\">
                <td style=\"width: 10%;\">$id</td>
                <td align=\"center\" id = \"name$id\">$nombre</td>
                <td>$codigo</td>
                <td align=\"center\">$".number_format($costo, 2, '.', '')."</td>
                <td style=\"width: 10%;\" align=\"center\"><button onclick = \"editar($id);\">Editar</button></td>
                <td style=\"width: 10%;\" align=\"center\"><button onclick = \"deleteAdministrador($id);\">Eliminar</button></td>
                <td style=\"width: 10%;\" align=\"center\"><button onclick = \"detalle($id);\">Ver detalle</button></td>
                </tr>";
            }
            echo "</table>";
        ?>
        <div id="mensaje" class="error"></div>
</body>

</html>