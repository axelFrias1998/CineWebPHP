<?php
    include "conexion.php";
    session_start();
    if((isset($_POST["emailUsuarioIS"]) && !empty($_POST["emailUsuarioIS"])) && (isset($_POST["passUsuarioIS"]) && !empty($_POST["passUsuarioIS"]))){
        $correo = $_POST["emailUsuarioIS"];
        $pass = $_POST["passUsuarioIS"];
        ini_set("display errors", E_ALL);
        $con = conexion();
        if(mysqli_connect_errno()){
            printf("Conexión fallida: %s\n", mysqli_connect_error());
            exit();
        }else{
            mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
            $existe = mysqli_query($con, "SELECT * from usuario where Email = '$correo' and Rol_Id = 2;");
            if(mysqli_num_rows($existe) == 1){
                $idRes = mysqli_query($con, "SELECT Id, Nombre, Pass, Saldo, Email from usuario where Email = '$correo';");
                if($contrasenia = mysqli_fetch_row($idRes)){
                    if(strcmp($pass, $contrasenia[2]) == 0){
                        $_SESSION["usuario"] = $contrasenia[1];
                        $_SESSION["id"] = $contrasenia[0];
                        $_SESSION["correo"] = $contrasenia[4];
                        $_SESSION["saldo"] = $contrasenia[3];
                        header("Location: index.php");
                    }
                    else{
                        $_SESSION["ContraseniaIncorrecta"] = 1;
                        header("Location: index.php");
                    }
                }
                mysqli_free_result($idRes);
            }
            else{
                $_SESSION["errorRol"] = 1;
                header("Location: index.php");
            }
            mysqli_free_result($existe);
        }
        mysqli_close($con);
    }
    else
        echo'<script>alert("No puedes acceder a este formulario.");window.location.href="index.php";</script>';
?>