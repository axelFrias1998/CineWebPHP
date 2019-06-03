<?php
    session_start();
    if(!isset($_SESSION["usuario"]) && empty($_SESSION["usuario"]) || !isset($_SESSION["id"]) && empty($_SESSION["id"]))
        header("Location: index.php");
    else{
        if(isset($_POST["borrar"])){
            ini_set("display errors", E_ALL);
            include_once "conexion.php";
            $con = conexion();		
            //RECUPERAR LOS REGISTROS
            mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
            $res = mysqli_query($con, "SELECT Pass FROM usuario where Id = ".$_SESSION["id"].";");
            if ($registro = mysqli_fetch_row($res)){
                if(strcmp($_POST["txtActualPass"], $registro[0]) == 0){
                    mysqli_query($con, "DELETE FROM usuario WHERE Id = ".$_SESSION["id"].";");
                    mysqli_query($con, "DELETE FROM orden WHERE Usuario_Id = ".$_SESSION["id"].";" );
                    mysqli_query($con, "UPDATE asientofuncion SET Disponible = true, Usuario_Id = null WHERE Usuario_Id = ".$_SESSION["id"].";");
                    $_SESSION["usuario"] = null;
                    $_SESSION["id"] = null;
                    $_SESSION["saldo"] = null;
                    $_SESSION["correo"] = null;
                    header("Location: index.php");
                }else{
                    header("Location: perfil.php");
                    echo "<script>alert('Contraseña incorrecta');</script>";
                }
            }
            mysqli_free_result($res);
            mysqli_close($con);
        }
        elseif(isset($_POST["actualizar"])){
            ini_set("display errors", E_ALL);
            require_once "conexion.php";
            try{
                $con = conexion();
                mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
                $res = mysqli_query($con, "SELECT Pass, Saldo, Email FROM usuario where Id = ".$_SESSION["id"].";");
                if ($registro = mysqli_fetch_row($res)){
                    if((isset($_POST["txtNombre"]) && !empty($_POST["txtNombre"])) && (!strcmp($_POST["txtActualPass"], $registro[0])) && (strcmp($_SESSION["usuario"], $_POST["txtNombre"]))){
                        if(mysqli_query($con, "UPDATE usuario SET Nombre = '".$_POST["txtNombre"]."' WHERE Id = ".$_SESSION["id"].";")){
                            $_SESSION["usuario"] = $_POST["txtNombre"];
                            echo header("Location: perfil.php");
                        }
                        else
                            echo mysqli_error($con);
                    }
                    if((isset($_POST["txtCorreo"]) && !empty($_POST["txtCorreo"])) && (!strcmp($_POST["txtActualPass"], $registro[0])) && (strcmp($registro[2], $_POST["txtCorreo"]))){
                        if(mysqli_query($con, "UPDATE usuario SET Email = '".$_POST["txtCorreo"]."' WHERE Id = ".$_SESSION["id"].";"))
                            header("Location: perfil.php");
                        else  
                            echo mysqli_error($con);
                    }
                    if((isset($_POST["txtSaldo"]) && !empty($_POST["txtSaldo"])) && (!strcmp($_POST["txtActualPass"], $registro[0]))){
                        $saldoNuevo = $registro[1] + $_POST["txtSaldo"];
                        if(mysqli_query($con, "UPDATE usuario SET Saldo = ".$saldoNuevo." WHERE Id = ".$_SESSION["id"].";")){
                            $_SESSION["saldo"] = $saldoNuevo;
                            header("Location: perfil.php");
                        }
                        else
                            echo mysqli_error($con);
                    }
                    if((isset($_POST["txtNuevaPass"]) && !empty($_POST["txtNuevaPass"])) && (isset($_POST["txtActualPass"]) && !empty($_POST["txtActualPass"])) && (!strcmp($_POST["txtActualPass"], $registro[0]) )&& (strcmp($registro[0], $_POST["txtNuevaPass"]))){
                        if(mysqli_query($con, "UPDATE usuario SET Pass = '".$_POST["txtNuevaPass"]."' WHERE Id = ".$_SESSION["id"].";")){
                            echo "<script>alert('Vuelve a iniciar tu sesión');</script>";
                            $_SESSION["id"] = null;
                            $_SESSION["usuario"] = null;
                        }
                        else
                            echo mysqli_error($con);
                    }
                    else
                        header("Location: perfil.php");
                }
            }
            catch(mysqli_sql_exception $e){
                echo $e;
            }
            mysqli_free_result($res);
            mysqli_close($con);
            header("Location: perfil.php");
        }
    }
?>