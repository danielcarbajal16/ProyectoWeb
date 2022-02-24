<?php
    session_start();
    session_destroy();
    header("Location: ../Administrador/index.php")
?>