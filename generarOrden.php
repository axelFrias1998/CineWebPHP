<?php
    session_start();
    require "pdf.php";
    $cont = 0;
    foreach($_POST["asientos"] as $asiento)
        $cont++;
    
    if((isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) && (isset($_SESSION["funcion"]) && !empty($_SESSION["funcion"])) && (isset($_POST["asientos"]) && !empty($_POST["asientos"])) && (isset($_SESSION["id"]) && !empty($_SESSION["id"])) && (isset($_SESSION["total"]) && !empty($_SESSION["total"]))){
            echo "Pasa del isset";
            ini_set("display errors", E_ALL);
            include_once "conexion.php";
            $con = conexion();
            if(!mysqli_query($con, "UPDATE usuario SET Saldo = ".($_SESSION["saldo"] - $_SESSION["total"])." WHERE  Id = ".$_SESSION["id"].";"));

                echo mysqli_error($con);
            foreach($_POST["asientos"] as $asiento){
                if(!mysqli_query($con, "UPDATE asientofuncion SET Disponible = false, Usuario_Id = ".$_SESSION["id"]." where Funcion_Id = ".$_SESSION["funcion"]." and Asiento_Id = ".$asiento.";"))
                    echo mysqli_error($con);
            }
            if(!mysqli_query($con, "INSERT INTO orden(Monto, Estado, Fecha, Usuario_Id, Funcion_Id) VALUES(".$_SESSION["total"].", true, '".date("Y-m-d")."', ".$_SESSION["id"].", ".$_SESSION["funcion"].");"))
                echo mysqli_error($con);
    }
    creaPDF($_SESSION["usuario"], $_SESSION["correo"], $_SESSION["total"],$cont);
    $_SESSION["funcion"] = null;
    $_SESSION["total"] = null;
    $_SESSION["cantidad"] = null;
?>