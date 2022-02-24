<?php
    session_start();

    require "../Back-End/Administrador/Funciones/conecta.php";
    $con = conecta();
    if(!$_SESSION['idU']) {
        //header("Location: ./index.php");
        $img = "./pictureoff.png";
    } else {
        $idU = $_SESSION['idU'];
        $sql = "SELECT * FROM administradores WHERE id=$idU";
        $res = mysql_query($sql, $con);
        $arch_n = mysql_result($res, 0, "Archivo_n");
        $ext = substr(strrchr($arch_n, "."), 1);
        $arch = mysql_result($res, 0, "Archivo");
        $dir = "../Back-End/Administrador/archivos/";
        $img = $dir."$arch.$ext";
    }
    $id = $_REQUEST['id'];
    $carrito = 0;
    $sql = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0 ORDER BY id";
    $resprod = mysql_query($sql,$con);
    $numprod = mysql_num_rows($resprod);
    $sql = "SELECT * FROM pedidos WHERE status = 0";
    $resped = mysql_query($sql, $con);
    if (mysql_num_rows($resped) > 0) {
        $idpedido = mysql_result($resped, 0, "id");
        $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $idpedido";
        $res = mysql_query($sql, $con);
        $carrito = mysql_num_rows($res);
    }
    
?>
<html>
    <head>
        <title>Productos</title>
        <meta charset="utf-8">
        <div style="width: 100%; height:77px">
            <div style="display: inline-block;"><img src="<?php echo $img?>" class="imagenRedonda"/></div>
            <div style="display: inline-block; margin-left:460px;">
            <table style="width: 300px; border-collapse: separate;background-color: blue; margin-bottom:27px">
                    <tr>
                        <td style="width: 100px; background-color: skyblue; text-align:center;"><a href="./index.php">Home</a></td>
                        <td style="width: 100px; background-color: skyblue; text-align:center;"><a href="./producto.php">Productos</a></td>
                        <td style="width: 100px; background-color: skyblue; text-align:center;"><a href="./contacto_formulario.php">Contacto</a></td>
                    </tr>
                </table>
            </div>
            <div style="display: inline-block; margin-left:400px; margin-bottom: 31px;">
                <table>
                    <tr>
                        <td style="margin-bottom: 31px;"><a href="./carrito01.php">Carrito</a></td>
                        <td> (<?php echo $carrito ?>)</td>
                    </tr>
                </table>
            </div>
        </div>
        <script src="../Back-End/Administrador/js/jquery-3.3.1.min.js"></script>
        <script>
            function valida() {
            var ok = true;
            var nombre = document.forma01.nombre.value;
            var mail = document.forma01.correo.value;
            var desc = document.forma01.descripcion.value;
            if (nombre == "" || mail == "" || desc == "") {
                ok = false;
                console.log("Nel prro");
            }

            if (ok == false) {
                alert("Faltan campos por llenar");
            }
            else {
                console.log("Nombre: " +nombre+"\nCorreo: "+mail+"\nMensaje: "+desc);
                document.forma01.method = 'post';
                document.forma01.action = 'contacto_correo.php';
                document.forma01.submit();
            }
            return ok;
        }
        </script>
        <style>
            html {
                min-height: 100%;
                position: relative;
            }
            body {
                margin: 0;
                margin-bottom: 40px;
            }
            footer {
                text-align: center;
                padding: 3px;
                background-color: olivedrab;
                
                position: absolute;
                bottom: 0;
                width: 99.5%;
            }
            .imagenRedonda {
                border-radius: 38px;
                width: 76px;
                height: 76px;
            }
            .error {
                color: red;
            }
        </style>
    </head>
    <body background="./bmo.gif">
        <div align="center">
            <a href="./index.php">Regresar</a>
            <div id="mensaje" class="error"></div><br>
            <form name="forma01" action="" method="">
                <label>
                    Nombre:
                    <input id="campo1" type="text" name="nombre" placeholder="Escribe tu nombre" required>
                </label>
                <br><br>
                <label>Correo:</label>
                <input type="email" name="correo" id="correo" placeholder="Escribe tu correo"><br><br>
                <label>Mensaje:</label>
                <textarea name="descripcion" id="descripcion" placeholder="Escriba aquí la descripción del producto" cols="30" rows="5"></textarea>
                <br><br>
                <input style="margin-right: 50px;" onClick="valida();" type="button" value="Enviar"/>
                <!--<input type="hidden" id="id_sel" name="id_sel" value="0"/>
                <input type="reset" value="Borrar" /><br>-->
                <div id="error" class="error"></div>
            </form>
            <!--<br><button>Finalizar</button>-->
        </div>
        <footer>Derechos Reservados | Términos y condiciones | Redes Sociales</footer>
    </body>
</html>