<?php
    session_start();
    if(!isset($_GET["c"]))
        header('Location: index.php');
    else{
        include_once "header.php";
        $_SESSION["peliculaId"] = $_GET["c"];
    }
?>
<html>
    <head>
		<title>Datos de la película</title>
	</head>
	<body>
        <br><br>
        <div class="container jumbotron">
            <div class="row">
            <br><br><br><br><br><br>
                <?php
                    ini_set("display errors", E_ALL);
                    include_once "conexion.php";
                    $con = conexion();
                    mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
                    $res = mysqli_query($con, "SELECT * FROM pelicula WHERE Id = ".$_GET["c"].";");
                    if ($registro = mysqli_fetch_row($res)):?>
                        <!--COlumna 1-->
                        <div class="row align-items-center my-5">
                            <div class="col-3"> 
                                <img class="img-fluid rounded" src="data:image/jpeg;base64, <?php echo base64_encode($registro[5]);?>" style="max-width: 1000px; max-height: 360px">
                            </div>
                        </div>
                            <!-- /.col-lg-5 -->
                        <div class="col-6"> <br> <br>
                            <h1 class="font-weight-light"><b><?php echo $registro[1];?></b></h1> <br>
                            <p> <b>Director: </b> <?php echo $registro[2];?> </p>
                            <p>	<b>País: </b><?php echo $registro[7];?> </p>
                            <p>	<b>Año: </b> <?php echo $registro[6];?> </p>
                            <p>	<b>Clasificación: </b><?php echo $registro[8];?> </p>
                            <p>	<b>Duración: </b> <?php echo $registro[9]." minutos.";?> </p>
                            <p>	<b>Sinópsis: </b> <?php echo $registro[3];?></p>
                        </div>
                        <div class = "col-4">
                            <div class="list-group">
                            <br><br><br><br>
                                <h2>Horarios:</h2>
                <?php
                    endif;
                        $res = mysqli_query($con, "SELECT funcion.Id, funcion.Fecha, funcion.HoraInicio, tipoproyeccion.Nombre
                                            FROM funcion
                                            INNER JOIN tipoproyeccion ON funcion.TipoProyeccion_Id = tipoproyeccion.Id where funcion.Pelicula_Id = ".$_GET['c'].";");
                        while($registro = mysqli_fetch_row($res)):
                ?>
                            <a  data-toggle="tooltip" title="Compra" href="compra.php?f=<?php echo $registro[0];?>"><button type="button" class="list-group-item list-group-item-action" ><?php echo $registro[1].
                            "\t".substr($registro[2], 0, 5)."\t".$registro[3];?></button></a>
                            
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
            <!-- Bootstrap core JavaScript -->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php 
		include_once "footer.php";
	?> 
	</body>
</html>
