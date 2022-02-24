<?php
    session_start();

    if(!$_SESSION['idU']) {
        header("Location: ../Administrador/index.php");
    }
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
    <title>Alta Productos</title>
    <header align="center" style="font-weight: bold; font-size:large">Alta Productos</header>
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script>
        function verCode(){
            var id 	= $('#id_sel').val();
            var codigo	= $('#codigo').val();
            if (codigo != ''){
                $.ajax({
                    url 	: './Funciones/verificaCodigo.php',
                    type 	: 'post',
                    dataType : 'text',
                    data    : 'id='+id+'&codigo='+codigo,
                    success :function(res){
                        if (res>0){
                            $('#mensaje').html('El codigo: '+codigo+' ya está registrado');
                            $('#codigo').val('');
                            setTimeout("$('#mensaje').html('');",5000);
                        }
                    }, error: function(){
                        alert ('Error al conectar al servidor...');
                    }
                });
            }
        }
        function valida() {
            var ok = true;
            var nombre = document.forma01.nombre.value;
            var codigo = document.forma01.codigo.value;
            var desc = document.forma01.descripcion.value;
            var costo = document.forma01.costo.value;
            var stock = document.forma01.stock.value;
            if (nombre == "" || codigo == "" || desc == "" || costo == "" || stock == "" || $('#archivo').get(0).files.length === 0) {
                ok = false;
                console.log("No nombre");
            }

            if (costo < 1) {
                ok = false;
                $('#messCost').html('Valor no aceptado');
                $('#costo').val('');
                setTimeout("$('#messCost').html('');",5000);
            }

            if (stock < 0) {
                ok = false;
                $('#messStock').html('Valor no aceptado');
                $('#stock').val('');
                setTimeout("$('#messStock').html('');",5000);
            }

            if (ok == false) {
                $('#error').html('Faltan campos por llenar');
                setTimeout("$('#error').html('');",5000);
            }
            else {
                document.forma01.method = 'post';
                document.forma01.action = 'salva_productos.php';
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
        body {
            background: linear-gradient(red, yellow);
        }
    </style>
</head>

<body>
        <div align="center">
        <br><button onclick="window.location= './lista_productos.php';">Regresar al listado.</button><br><br>
            <form enctype="multipart/form-data" name="forma01" action="" method="">
                <label>
                    Nombre:
                    <input id="campo1" type="text" name="nombre" placeholder="Escribe el nombre del producto" required>
                </label>
                <br><br>
                <label>
                    Código:
                    <input id="codigo" type="text" name="codigo" placeholder="Escribe el codigo del producto" onblur="verCode();">
                </label>
                <div id="mensaje" class="error"></div><br><br>
                <label>Descripción:</label>
                <textarea name="descripcion" id="descripcion" placeholder="Escriba aquí la descripción del producto" cols="30" rows="5"></textarea>
                <br><br>
                <label for="costo">Costo:</label>
                <input type="number" name="costo" id="costo" placeholder="Escribe un precio" min="1">
                <div id="messCost" class="error"></div><br><br>
                <label for="stock">Stock:</label>
                <input type="number" name="stock" id="stock" placeholder="Productos en almacén" min="0">
                <div id="messStock" class="error"></div><br><br>
                <label for="foto">Foto:</label>
                <input type="file" id="archivo" name="archivo">
                <br><br>
                <input style="margin-right: 50px;" onClick="valida();" type="button" value="Enviar"/>
                <input type="hidden" id="id_sel" name="id_sel" value="0"/>
                <input type="reset" value="Borrar" /><br>
                <div id="error" class="error"></div>
            </form>
        </div>
</body>

</html>