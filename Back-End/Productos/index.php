<?php
    session_start();

    if ($_SESSION['idU']) {
        header("Location: ../Administrador/bienvenido.php");
    }
?>

<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <header align="center" style="font-weight: bold; font-size:large">Login</header>
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script>
        function verUser(){
            var correo	= $('#correo').val();
            var pass = $('#pasw').val();
            if (correo != '' && pass != ''){
                $.ajax({
                    url 	: './Funciones/verificaUsuario.php',
                    type 	: 'post',
                    dataType : 'text',
                    data    : 'correo='+correo+'&pass='+pass,
                    success :function(res){
                        if (res>0){
                            window.location = "./bienvenido.php";
                        }
                        else {
                            $('#mensaje').html('Datos incorrectos');
                            $('#correo').val('');
                            $('#pasw').val('');
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
            var mail = document.forma01.correo.value;
            var pass = document.forma01.pasw.value;

            if (mail == "" || pass == "") {
                ok = false;
                console.log("No mail");
            }

            if (ok == false) {
                $('#error').html('Faltan campos por llenar');
                setTimeout("$('#error').html('');",5000);
            }
        }
    </script>
    <style>
        .error {
            display: inline;
            color: red;
        }
    </style>
</head>

<body background="./Imagenes/pepino_mamado.gif">
    <br>
    <div align="center">
        <form name="forma01" action="" method="">
            <label>Correo:</label>
            <input type="email" name="correo" id="correo" placeholder="Escribe tu correo">
            <div id="mensaje" class="error"></div><br>
            <br><label for="pasw">Contraseña:</label>
            <input type="password" name="pasw" id="pasw" placeholder="Escribe una contraseña">
            <br><br>
            <input onClick="verUser();valida();" type="button" value="Ingresar" style="margin-right: 50px;"/>
            <input type="hidden" id="id_sel" name="id_sel" value="0"/>
            <input type="reset" value="Borrar" /><br>
            <div id="error" class="error"></div>
        </form>
    </div>

</body>

</html>