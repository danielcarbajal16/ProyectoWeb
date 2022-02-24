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
        function confirmar(id){
            //var nombre = $('#name'+id).val();
            //console.log(nombre+' y '+id);
            if (id > 0){
                if (confirm("Estás seguro que no deseas agregar algo más?")) {
                    $.ajax({
                        url 	: './actualizaCarrito.php',
                        type 	: 'post',
                        dataType : 'text',
                        data    : 'id='+id,
                        success :function(res){
                            if (res>0){
                                console.log("Pedido cerrado correctamente.");
                                window.location = "./index.php";
                            } else if (res == 0) {
                                console.log("No hubo cambios");
                                window.location = "./index.php";
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
            /*footer {
                background-color: black;
                
                height: 40px;
                color: white;
            }*/
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
            <a href="./carrito01.php">Regresar</a>
            <div id="mensaje" class="error"></div><br>
            <table style="border: 1px solid #000000; border-collapse: separate; background-color: blue;">
                <tr>
                    <th style="border: solid 1px #000000; background-color: #6AED62;">Producto</th>
                    <th style="border: solid 1px #000000; background-color: #6AED62;">Cantidad</th>
                    <th style="border: solid 1px #000000; background-color: #6AED62;">Costo Unitario</th>
                    <th style="border: solid 1px #000000; background-color: #6AED62;">Subtotal</th>
                </tr>
                <?php
                $total = 0;
                for ($i=0;$i<$carrito;$i++) {
                    $idprod = mysql_result($res, $i, "id_producto");
                    $idPP = mysql_result($res, $i, "id");
                    $costo = mysql_result($res, $i, "precio");
                    $cantidad = mysql_result($res, $i, "cantidad");
                    $stock = mysql_result($resprod, $idprod-1, "stock");
                    $subtotal = $costo * $cantidad;
                    $total = $total + $subtotal;
                    $prod = mysql_result($resprod, $idprod-1, "nombre");
                    echo "
                    <tr id=\"Fila$idPP\">
                    <td style=\"border: solid 1px #000000; background-color: skyblue;\">$prod</td>
                    <td style=\"border: solid 1px #000000; background-color: skyblue;\">$cantidad</td>
                    <td style=\"border: solid 1px #000000; background-color: skyblue;\">$".number_format($costo, 2, '.', ',')."</td>
                    <td style=\"border: solid 1px #000000; background-color: skyblue;\">$".number_format($subtotal, 2, '.', ',')."</td>
                    </tr>";
                }
                echo "<tr>
                    <td colspan=\"3\" style=\"border: solid 1px #000000; background-color: skyblue; font-weight:bold; text-align:center;\">Total</td>
                    <td style=\"border: solid 1px #000000; background-color: skyblue;\">$".number_format($total, 2, '.', ',')."</td>
                    </tr>";
                ?>
            </table>
            <br><button onclick="confirmar(<?php echo $idpedido?>);">Finalizar</button>
        </div>
        <footer>Derechos Reservados | Términos y condiciones | Redes Sociales</footer>
    </body>
</html>