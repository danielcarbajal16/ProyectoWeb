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
    $res = mysql_query($sql, $con);
    if (mysql_num_rows($res) > 0) {
        $idpedido = mysql_result($res, 0, "id");
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
        <script>
            function agrega (id) {
                var selector = document.getElementById("agregar"+id).value;
                //var id = document.getElementById("id_sel").value;
                window.location = "./agregacarrito.php?id="+id+"&cantidad="+selector;
                //console.log(selector + " pitos de duende con id: " +id);
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
        </style>
    </head>
    <body background="./bmo.gif">
        <div align="center" style="width: 100%; margin-top: 50px;">
        <?php
        $arch_n = mysql_result($resprod, $id-1, "archivo_n");
        $ext = substr(strrchr($arch_n, "."), 1);
        $arch = mysql_result($resprod, $id-1, "archivo");
            echo "
            <table>
                <tr>
                    <td rowspan=\"5\"><img src=\"../Back-end/Productos/archivos/"."$arch.$ext"."\" style=\"width: 300px; height: 300px;\"/></td>
                    <td style=\"text-align: center; background-color:khaki;\">".mysql_result($resprod, $id-1, "nombre")."</td>
                    <td rowspan=\"5\" style=\"width: 400px; background-color: palegreen;\">".mysql_result($resprod, $id-1, "descripcion")."</td>
                </tr>
                <tr><td style=\"text-align: center; background-color:khaki;\">$".number_format(mysql_result($resprod, $id-1, "costo"), 2, '.', ',')."</td></tr>
                <tr><td style=\"text-align: center; background-color:khaki;\">".mysql_result($resprod, $id-1, "codigo")."</td></tr>
                <tr><td style=\"text-align: center; background-color:khaki;\">".mysql_result($resprod, $id-1, "stock")."<input type=\"hidden\" id=\"id_sel\" name=\"id_sel\" value=\"$id\"/></td></tr>
                <tr><td style=\"text-align: center; background-color:khaki;\"><button onclick=\"agrega($id);\">Agregar</button><input type=\"number\" id=\"agregar$id\" name=\"agregar\" min=\"1\" max=\"".mysql_result($resprod, $id-1, "stock")."\" value=\"1\" style=\"width : 40px; heigth : 15px\"/></td></tr>
            </table>
            ";
        ?>
        </div>
        <div align="center" style="width: 100%; margin-top: 50px">
        <p style="font-weight: bold;">Productos similares</p>
        <a href="./detalle_producto?id=$i"></a>
        <?php
            for ($i=0;$i<3;$i++) {
                $rand = rand(0,$numprod-1);
                $idrand = mysql_result($resprod, $rand, "id");
                $arch_n = mysql_result($resprod, $rand, "archivo_n");
                $ext = substr(strrchr($arch_n, "."), 1);
                $arch = mysql_result($resprod, $rand, "archivo");
                echo "
                <table style=\"margin-left:80px; display: inline-block; background-color: skyblue\">
                    <tr><td style=\"align-content: center;\"><a href=\"./detalle_producto.php?id=$idrand\"><img src=\"../Back-end/Productos/archivos/"."$arch.$ext"."\" style=\"width: 100px; height: 100px;\"/></a></td></tr>
                    <tr><td style=\"text-align: center;\">".mysql_result($resprod, $rand, "nombre")."</td></tr>
                    <tr><td style=\"text-align: center;\">".mysql_result($resprod, $rand, "codigo")."</td></tr>
                    <tr><td style=\"text-align: center;\">$".number_format(mysql_result($resprod, $rand, "costo"), 2, '.', ',')."</td></tr>
                    <tr><td style=\"text-align: center;\"><button onclick=\"agrega($idrand);\">Agregar</button><input type=\"number\" id=\"agregar$idrand\" name=\"agregar\" min=\"1\" max=\"".mysql_result($resprod, $rand, "stock")."\" value=\"1\" style=\"width : 40px; heigth : 15px\"/></td></tr>
                </table>
                ";
            }
            ?>
        </div>
        <footer>Derechos Reservados | T??rminos y condiciones | Redes Sociales</footer>
    </body>
</html>