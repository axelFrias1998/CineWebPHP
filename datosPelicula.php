<?php
    session_start();
    if(!isset($_GET["clave"]))
        header('Location: index.php');
    else{
        include_once "header.php";
        $_SESSION["peliculaId"] = $_GET["clave"];
    }
?>
<html>
	<body>
        <br><br>
        <div class="container">
            <div class="row">
                <?php
                    ini_set("display errors", E_ALL);
                    include_once "conexion.php";
                    $con = conexion();
                    mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
                    $res = mysqli_query($con, "SELECT * FROM pelicula WHERE Id = ".$_GET["clave"].";");
                    if ($registro = mysqli_fetch_row($res)):?>
                        <!--COlumna 1-->
                        <div class="row align-items-center my-5">
                            <div class="col-3"> <br> <br> <br>
                                <img class="img-fluid rounded" src="Avenger.jpg" style="max-width: 500px; max-height: 250px" alt="">
                            </div>
                        </div>
                            <!-- /.col-lg-5 -->
                        <div class="col-6"> <br> <br>
                            <h1 class="font-weight-light"><b><?php echo $registro[1];?></b></h1> <br>
                            <p> <b>Director:</b> <?php echo $registro[2];?> </p>
                            <p>	<b>País:</b><?php echo $registro[7];?> </p>
                            <p>	<b>Año:</b> <?php echo $registro[6];?> </p>
                            <p>	<b>Clasificación:</b><?php echo $registro[8];?> </p>
                            <p>	<b>Duración:</b> <?php echo $registro[9]." minutos.";?> </p>
                            <p>	<b>Sinópsis:</b> <?php echo $registro[3];?></p>
                            <br> <a class="btn btn-primary" href="#" style="background:#FF4500"><b>Comprar boletos</b></a>
                        </div>
                        <div class = "col-4">
                            <div class="list-group">
                            <br><br><br><br>
                                <h2>Horarios:</h2>
                <?php
                    endif;
                        $res = mysqli_query($con, "SELECT funcion.Id, funcion.Fecha, funcion.HoraInicio, tipoproyeccion.Nombre
                                            FROM funcion
                                            INNER JOIN tipoproyeccion ON funcion.TipoProyeccion_Id = tipoproyeccion.Id where funcion.Pelicula_Id = ".$_GET['clave'].";");
                        while($registro = mysqli_fetch_row($res)):
                ?>
                            <a  data-toggle="tooltip" title="Compra" href="compra.php?funcion=<?php echo $registro[0];?>"><button type="button" class="list-group-item list-group-item-action" ><?php echo $registro[1].
                            "\t".$registro[2]."\t".$registro[3];?></button></a>
                            
                <?php
                    endwhile;
                    mysqli_free_result($res);
                    mysqli_close($con);				
                ?>	
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container -->
        </div>
            <!-- Footer -->
            <footer class="py-5 bg-dark">
            <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Cinezona 2019</p>
            </div>
            <!-- /.container -->
            </footer>

            <!-- Bootstrap core JavaScript -->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	</body>
</html>
