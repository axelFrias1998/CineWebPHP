<?php 
    include "conexion.php";
    session_start();
    if((isset($_POST["nombreUsuario"]) && !empty($_POST["nombreUsuario"])) && (isset($_POST["emailUsuario"]) && !empty($_POST["emailUsuario"])) && 
        (isset($_POST["passUsuario"]) && !empty($_POST["passUsuario"])) && (isset($_POST["pass2Usuario"]) && !empty($_POST["pass2Usuario"]))){
        if(strcmp($_POST["passUsuario"], $_POST["pass2Usuario"]) == 0){
            $nombre = $_POST["nombreUsuario"];
            $correo = $_POST["emailUsuario"];
            $pass = $_POST["passUsuario"];
            ini_set("display errors", E_ALL);
            $con = conexion();
            if(mysqli_connect_errno()){
                printf("Conexión fallida: %s\n", mysqli_connect_error());
                exit();
            }
            //CODIFICACIÓN PARA EVITAR CARACTERES RAROS POR ACENTOS
            mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
            $existe = mysqli_query($con, "Select * from usuario where Email = '$correo';");
            echo mysqli_num_rows($existe);
            if(mysqli_num_rows($existe) == 0){
                $insert = mysqli_query($con, "insert into usuario (Nombre, Email, Pass, Saldo, Rol_Id) values ('$nombre', '$correo', '$pass', 0, 2);");
                if($insert){
                    $idRes = mysqli_query($con, "Select Id from usuario where Email = '$correo';");
                    if($id = mysqli_fetch_row($idRes)){
                        $_SESSION["usuario"] = $nombre;
                        $_SESSION["id"] = $id[0];
                        header("Location: index.php");
                    }
                    mysqli_free_result($idRes);
                }
            }
            mysqli_free_result($existe);
            mysqli_close($con);
        }
    }
    else
        echo'<script>alert("No puedes acceder a este formulario.");window.location.href="index.php";</script>';
?>