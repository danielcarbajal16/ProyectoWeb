<?php
    $salsa = "pinche.hermoso.alv";
    $cartel = "p.p.c.d.s.alv";
    $pass = "12345";

    $parte = explode(".", $salsa, -1);
    $parte1 = substr($salsa, 0,strripos($salsa, "."));
    $parte2 = substr(strrchr($salsa, "."), 1);
    $prt1 = substr($cartel, 0,strripos($cartel, "."));
    $prt2 = substr(strrchr($cartel, "."), 1);
    $pass = md5($pass);
    $pepe = "123";
    $var1 = 5;
    $var2 = 2;

    echo strripos($salsa, ".");
    echo "<br>$parte[0]<br>";
    echo "$parte1<br>";
    echo "$parte2<br>";
    echo "$prt1<br>";
    echo "$prt2<br>";
    echo "$pass<br>";
    echo md5("123");
    echo "<br>".md5($pepe);
    echo "<br>"."'".date("Y-m-d",mktime(0,0,0,date("m")-1,rand(1,36),date("Y")))."'";
    echo "<br>".$var1*$var2;
    echo "<br>".ceil($var1/$var2);
?>

<html>
    <head>
    
    </head>
    <style>
        table {
            background-color: green;
            border: solid 1px black;
            border-collapse: separate;
        }
        td {
            background-color: olivedrab;
            border: solid 1px black;
        }
        th {
            background-color: olivedrab;
            border: black 1px solid;
        }
    </style>
    <body>
        <table align="center">
            <tr>
                <th>Correo</th>
                <td><input type="email" name="correo" id="correo" placeholder="Escribe tu correo"></td>
            </tr>
            <tr>
                <th>Contrasenia</th>
                <td><input type="password" name="pasw" placeholder="Escribe una contraseña"></td>
            </tr>
            <tr>
                <td align="center" style="width: 50%;"><button>Auxilio</button></td>
                <td align="center"><button>Socorro</button></td>
            </tr>
        </table>
    </body>
</html>