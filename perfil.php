<?php
    session_start();
    if(isset($_SESSION["datosIncorrectos"])){
        echo "<script>alert('Datos incorrectos');</script>";
        $_SESSION["datosIncorrectos"] = null;
    }
    if((!isset($_SESSION["usuario"]) && empty($_SESSION["usuario"]))){
        header("Location: index.php");
    }
    else
        include_once "header.php";
?>
<html>
    <head>
		<title>Perfil</title>
	</head>
    <body><br><br><br>
        <div class="container jumbotron">
        <?php
            ini_set("display errors", E_ALL);
            include_once "conexion.php";
            $con = conexion();		
            //RECUPERAR LOS REGISTROS
            mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
            $res = mysqli_query($con, "SELECT * FROM usuario where Id = ".$_SESSION["id"].";");
            if ($registro = mysqli_fetch_row($res)):?>
                <div class="row my-2">
                    <div class="col-lg-8 order-lg-2">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="" data-target="#perfil" data-toggle="tab" class="nav-link active">Datos</a>
                            </li>
                            <li class="nav-item">
                                <a href="" data-target="#historial" data-toggle="tab" class="nav-link">Historial de órdenes</a>
                            </li>
                            <li class="nav-item">
                                <a href="" data-target="#editar" data-toggle="tab" class="nav-link">Editar</a>
                            </li>
                        </ul>
                        <div class="tab-content py-4">
                            <div class="tab-pane active" id="perfil">
                                <h5 class="mb-3">Perfil de usuario</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Nombre:</h6>
                                        <p>
                                            <?php echo $registro[1];?>
                                        </p>
                                        <h6>Correo:</h6>
                                        <p>
                                            <?php echo $registro[2];?>
                                        </p>
                                        <h6>Saldo:</h6>
                                        <p>
                                            $<?php echo $registro[4];?>
                                        </p>
                                    </div>
                                </div>
                                <!--/row-->
                            </div>
                            <div class="tab-pane" id="editar">
                                <form role="form" action="cambio.php" method="POST">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Nombre</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name = "txtNombre" type="text" value="<?php echo $registro[1];?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Correo</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name = "txtCorreo" type="email" value="<?php echo $registro[2];?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Agregar saldo</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name = "txtSaldo" type="number" min="0" max="1000">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Nueva Contraseña</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="password" name = "txtNuevaPass">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Contraseña actual:</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="password" name = "txtActualPass" required="required">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-9">
                                            <input type="submit" class="btn btn-danger" name="borrar" value="Eliminar cuenta">
                                            <input type="submit" class="btn btn-primary" name="actualizar" value="Guardar cambios">
                                        </div>
                                    </div>
                                </form>
                            </div>
            <?php endif;
                mysqli_free_result($res);
                mysqli_close($con);
            ?>
                            <div class="tab-pane" id="historial">
                                <table class="table table-hover table-striped">
                                    <tbody>   
                                        <?php
                                            $con = conexion();
                                            mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
                                            $res = mysqli_query($con, "SELECT orden.Fecha, orden.Monto, pelicula.Titulo
                                                                        FROM orden
                                                                        inner join funcion on orden.Funcion_Id = funcion.Id
                                                                        inner join pelicula on funcion.Pelicula_Id = pelicula.Id
                                                                        WHERE orden.Usuario_Id = ".$_SESSION["id"].";");
                                            while ($registro = mysqli_fetch_row($res)):
                                        ?>                                 
                                            <tr>
                                                <td>
                                                <span class="float-right font-weight-bold"><?php echo substr($registro[0], 0, 10);?></span>
                                                    <b><?php echo "Costo: $";?></b>
                                                    <?php echo $registro[1];?>&nbsp;
                                                    <b><?php echo"Película: ";?></b>
                                                    <?php echo $registro[2];?>
                                                </td>
                                            </tr>
                                        <?php endwhile;
                                            mysqli_free_result($res);
                                            mysqli_close($con);
                                        ?>
                                    </tbody> 
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    <?php 
		include_once "footer.php";
	?>
    </body>
    
</html>