<?php
    $file_name = $_FILES['archivo']['name'];
    $file_temp = $_FILES['archivo']['tmp_name'];
    $cadena = explode(".", $file_name);
    $ext = $cadena[1];
    $dir = "archivos/";
    $file_enc = md5_file($file_temp);

    echo "File name: $file_name <br>";
    echo "File tmp: $file_temp<br>";
    echo "Ext: $ext<br>";
    echo "File enc: $file_enc<br>";

    if ($file_name != '') {
        $file_name1 = "$file_enc.$ext";
        copy($file_temp, $dir.$file_name1);
    }
?>