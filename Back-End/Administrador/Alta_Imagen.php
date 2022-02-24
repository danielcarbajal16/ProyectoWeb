<?php
    session_start();

    if(!$_SESSION['idU']) {
        header("Location: ./index.php");
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
                <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="./bienvenido.php">Inicio</a></th>
                <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="./B2.php">Lista de Administradores</a></th>
                <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="../Productos/lista_productos.php">Productos</a></th>
                <td style="width: 300px; border: solid 1px #000000; background-color: skyblue; color: green; text-align: center; font-weight: bold;">Hola <?php echo $name?></td>
                <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="../Pedidos/lista_pedidos.php">Pedidos</a></th>
                <!--<th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="./Ver_detalle.php?id=<?php echo $idU?>">Detalles de Administrador</a></th>-->
                <th style="width: 150px; border: solid 1px #000000; background-color: skyblue;"><a href="./cerrar_sesion.php">Cerrar sesión</a></th>
            </tr>
        </table>
    </div><br>
    <title>Alta administradores</title>
    <header align="center" style="font-weight: bold; font-size:large">Alta administradores</header>
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script>
        function vermail(){
            var id 	= $('#id_sel').val();
            var correo	= $('#correo').val();
            if (correo != ''){
                $.ajax({
                    url 	: './Funciones/verificaCorreo.php',
                    type 	: 'post',
                    dataType : 'text',
                    data    : 'id='+id+'&correo='+correo,
                    success :function(res){
                        if (res>0){
                            $('#mensaje').html('El correo: '+correo+' ya está registrado');
                            $('#correo').val('');
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
            var apellido = document.forma01.apellido.value;
            var mail = document.forma01.correo.value;
            var rol = document.forma01.rol.value;
            var pass = document.forma01.pasw.value;
            if (nombre == "") {
                ok = false;
                console.log("No nombre");
            }

            if (apellido == "") {
                ok = false;
                console.log("No apellido");
            }

            if (mail == "@udg.mx" || mail == "") {
                ok = false;
                console.log("No mail");
            }

            if (rol == 0) {
                ok = false;
                console.log("No rol");
            } else {
                if (rol == 1) {
                    rol = "Gerente"
                } else {
                    rol = "Ejecutivo"
                }
            }
            

            /*if (pass == "") {
                ok = false;
                console.log("No password");
            }*/

            if ($('#archivo').get(0).files.length === 0) {
                ok = false;
                console.log("No archivo");
            }

            if (ok == false) {
                $('#error').html('Faltan campos por llenar');
                setTimeout("$('#error').html('');",5000);
            }
            else {
                document.forma01.method = 'post';
                document.forma01.action = 'salva_administradores.php';
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
        <br><button onclick="window.location= './B2.php';">Regresar al listado.</button><br><br>
            <form enctype="multipart/form-data" name="forma01" action="" method="">
                <label>
                    Nombre:
                    <input id="campo1" type="text" name="nombre" placeholder="Escribe tu nombre" required>
                </label>
                <br><br>
                <label>
                    Apellido:
                    <input id="campo2" type="text" name="apellido" placeholder="Escribe tu apellido" required>
                </label>
                <br><br>
                <label>Correo:</label>
                <input type="email" name="correo" id="correo" placeholder="Escribe tu correo" onblur="vermail();">
                <div id="mensaje" class="error"></div><br><br>
                <label for="pasw">Contraseña:</label>
                <input type="password" name="pasw" placeholder="Escribe una contraseña">
                <br><br>
                <label for="rol">Rol:</label>
                <select name="rol">
                    <option value="0" selected>Selecciona</option>
                    <option value="1">Gerente</option>
                    <option value="2">Ejecutivo</option>
                </select><br><br>
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