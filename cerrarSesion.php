<?php
    session_start();
    if((isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) &&  (isset($_SESSION["id"]) && !empty($_SESSION["id"]))){
        $_SESSION["usuario"] = null;
        $_SESSION["id"] = null;
        $_SESSION["correo"] = null;
        $_SESSION["saldo"] = null;
        header("Location: index.php");
    }else
        echo'<script>alert("No puedes acceder a este formulario.");window.location.href="index.php";</script>';
?>
