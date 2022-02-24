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
                <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="../Administrador/cerrar_sesion.php">Cerrar sesión</a></th>
            </tr>
        </table>
    </div><br>
    <title>Alta Pedidos</title>
    <header align="center" style="font-weight: bold; font-size:large">Alta Pedidos</header>
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script>
        function verCode(){
            var codigo	= $('#producto').val();
            var cantidad = $('#cantidad').val();
            console.log(codigo);
            if (codigo != '' || cantidad >=1){
                $.ajax({
                    url 	: './Funciones/verificaCodigo.php',
                    type 	: 'post',
                    dataType : 'text',
                    data    : 'codigo='+codigo+'&cantidad='+cantidad,
                    success :function(res){
                        if (res==0){
                            $('#mensaje').html('El producto: '+codigo+' no está registrado');
                            $('#producto').val('');
                            setTimeout("$('#mensaje').html('');",5000);
                        } else if(res==2) {
                            $('#messStock').html('Excede el número disponible de productos');
                            $('#cantidad').val('1');
                            setTimeout("$('#messStock').html('');",5000);
                        }
                    }, error: function(){
                        alert ('Error al conectar al servidor...');
                    }
                });
            }
        }
        function valida() {
            var ok = true;
            var producto = document.forma01.producto.value;
            var cantidad = document.forma01.cantidad.value;
            if (producto == "") {
                ok = false;
                console.log("No nombre");
            }

            if (cantidad < 1) {
                ok = false;
                $('#messStock').html('Valor no aceptado');
                $('#cantidad').val('1');
                setTimeout("$('#messStock').html('');",5000);
            }

            if (ok == false) {
                $('#error').html('Faltan campos por llenar');
                setTimeout("$('#error').html('');",5000);
            }
            else {
                document.forma01.method = 'post';
                document.forma01.action = 'salva_pedidos.php';
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

<body background= "./Imagenes/platanos.gif">
        <div align="center">
        <br><button onclick="window.location= './lista_pedidos.php';">Regresar al listado.</button><br><br>
            <form name="forma01" action="" method="">
                <label>
                    Id Producto:
                    <input id="producto" type="text" name="producto" placeholder="Escribe el Id del Producto" onblur="verCode();">
                </label>
                <div id="mensaje" class="error"></div>
                <br><br>
                <label for="stock">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" value="1" min="1" onblur="verCode();">
                <div id="messStock" class="error"></div><br><br>
                <input style="margin-right: 50px;" onClick="valida();" type="button" value="Enviar"/>
                <input type="hidden" id="id_sel" name="id_sel" value="0"/>
                <input type="reset" value="Borrar" /><br>
                <div id="error" class="error"></div>
            </form>
        </div>
</body>

</html>