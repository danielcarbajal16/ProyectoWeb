<html>

<head>
    <meta charset="utf-8">
    <title>Alta administradores</title>
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
                console.log("No carrera");
            } else {
                if (rol == 1) {
                    rol = "Gerente"
                } else {
                    rol = "Ejecutivo"
                }
                console.log(carr);
            }
            

            /*if (pass == "") {
                ok = false;
                console.log("No password");
            }*/

            if (ok == false) {
                alert("Faltan campos por llenar");
            }
            else {
                alert("Nombre: " + nombre
                + "\nApellido: " + apellido
                + "\nRol: " + rol
                + "\nCorreo: " + mail 
                + "\nContraseña: " + pass);
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
    </style>
</head>

<body>
    <a href="./B1.php">Lista de Administradores.</a><br><br>
    <form name="forma01" action="salva_administradores.php" method="POST">
        <label>
            Nombre:
            <input id="campo1" type="text" name="nombre" placeholder="Escribe tu nombre" required>
        </label>

        <br>
        <label>
            Apellido:
            <input id="campo2" type="text" name="apellido" placeholder="Escribe tu apellido" required>
        </label>
        <br>
        <label>Correo:</label>
        <input type="email" name="correo" id="correo" placeholder="Escribe tu correo" onblur="vermail();">
        <!--<br>-->
        <div id="mensaje" class="error"></div><br>
        <label for="pasw">Contrasenia:</label>
        <input type="password" name="pasw" placeholder="Escribe una contraseña">
        <br>
        <label for="rol">Rol:</label>
        <select name="rol">
            <option value="0" selected>Selecciona</option>
            <option value="1">Gerente</option>
            <option value="2">Ejecutivo</option>
        </select>
        <br>
        <input onClick="valida(); return false;" type="submit" value="Enviar"/>
        <input type="hidden" id="id_sel" name="id_sel" value="0"/>
        <input type="reset" value="Borrar" />
    </form>

</body>

</html>