<?php
    $nombre = $_REQUEST['nombre'];
    $correo = $_REQUEST['mail'];
    $mensaje = $_REQUEST['descripcion'];

    $mensaje = wordwrap($mensaje, 70, "\r\n");
    
    if (mail($correo, $nombre, $mensaje)) {
        echo "Gracias por enviar sus comentarios! Los tomamos en cuenta.";
        echo "<br><a href=\"./index.php\">Volver a la tienda</a>";
    } else {
        echo "Error durante el envio";
        echo "<br><a href=\"./index.php\">Volver a la tienda</a>";
    }
    
?>