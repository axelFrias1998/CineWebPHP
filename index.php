<?php
	session_start();
	include "header.php";
	if(isset($_SESSION["errorRol"])){
		echo'<script>alert("El usuario no tiene acceso al sistema.")</script>';
		$_SESSION["errorRol"] = null;
	}
	if(isset($_SESSION["ContraseniaIncorrecta"])){
		echo'<script>alert("Datos incorrectos")</script>';
		$_SESSION["ContraseniaIncorrecta"] = null;		
	}
	if(isset($_SESSION["peliculaId"]))
		$_SESSION["peliculaId"] = null;
	if(isset($_SESSION["funcion"]))
		$_SESSION["funcion"] = null;
	if(isset($_SESSION["total"]))
		$_SESSION["total"] = null;
	if(isset($_SESSION["cantidad"]))
		$_SESSION["cantidad"] = null;
	if(isset($_SESSION["passDif"])){
		echo'<script>alert("Contraseñas no coinciden")</script>';
		$_SESSION["passDif"] = null;	
	}
	if(isset($_SESSION["errorDesconocido"])){
		echo'<script>alert("Ha ocurrido un error durante tu registro. Vuelve a intentarlo.")</script>';
		$_SESSION["errorDesconocido"] = null;	
	}
?>
<html>
	<head>
	<title>Bienvenido a Cinezona</title>
	</head>
	<body>
		<form>
			<div class="container jumbotron">
				<div class="row">
					<div class="col-lg-3">
						<center>
						<p style="color:#4C236F">
							<h1 class="my-4"> <p style="color:#4C236F"> Avengers: Endgame </p></h1> 
							<h2> <p style="color:#4C236F"> Sólo en cines </p></h2> 
						</center>
						<div class="list-group"> 
							<div>
								<img align="left" src="img/11.jpg" style="max-width: 900px; max-height: 350px"> 
								<img src="img/22.jpg" style="max-width: 900px; max-height: 350px">
								<img src="img/33.jpg" style="max-width: 900px; max-height: 350px">
								<img src="img/44.jpg" style="max-width: 900px; max-height: 350px">
								<img src="img/55.jpg" style="max-width: 900px; max-height: 350px">
							</div>
						</div>
					</div>
		<!-- /.col-lg-3 -->

					<div class="col-lg-9">
					<!----------------AGREGAR---------------> <center> <h1> <b> <p style="color:#FF5733;"> PRÓXIMOS ESTRENOS </p> </b> </h1> </center> <!--------FIN------------->
						<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
								<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
								<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					<!--------AGREGAR------------->
								<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
								<li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
								<li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
								<li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
					<!-----------FIN---------->
							</ol>
						<div class="carousel-inner" role="listbox">
							<div class="carousel-item active">
								<!----AG---> <img class="d-block img-fluid" src="img/Yaz.png" style="max-width: 900px; max-height: 350px" alt="First slide"> <!---FIN---->
							</div>
							<div class="carousel-item">
								<!----AG---> <img class="d-block img-fluid" src="img/Dark.png" style="max-width: 900px; max-height: 350px" alt="Second slide"> <!---FIN---->
							</div>
							<div class="carousel-item">
								<!----AG---> <img class="d-block img-fluid" src="img/Lion2.png" style="max-width: 900px; max-height: 350px" alt="Third slide"> <!---FIN---->
							</div>
							<!-----------------AGREGAR---------------->
							<div class="carousel-item">
								<img class="d-block img-fluid" src="img/Spiderman2.png" style="max-width: 900px; max-height: 350px" alt="Quarter slide">
							</div>
							<div class="carousel-item">
								<img class="d-block img-fluid" src="img/Itt.png" style="max-width: 900px; max-height: 350px" alt="Fifth slide">
							</div>
							<div class="carousel-item">
								<img class="d-block img-fluid" src="img/Male2.png" style="max-width: 900px; max-height: 350px" alt="Sixth slide">
							</div>
							<div class="carousel-item">
								<img class="d-block img-fluid" src="img/Toy.png" style="max-width: 900px; max-height: 350px" alt="Seventh slide">
							</div>
							<!---------------------FIN---------------->
						</div>
							<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
						<br>
						<b> <h1 style="color:#FF5733;"> ENTRADAS A LA VENTA </h1> </b><br><br>
						<div class="row">
							<?php
								ini_set("display errors", E_ALL);
								include_once "conexion.php";
								$con = conexion();		
								//RECUPERAR LOS REGISTROS
								mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
								$res = mysqli_query($con, "SELECT * FROM pelicula");?>
								<?php while ($registro = mysqli_fetch_row($res)):?>
							
									<div class='col-lg-4 col-md-6 mb-4'>
										<div class='card h-100'>
											<a href="datosPelicula.php?c=<?php echo $registro[0];?>"><img class='card-img-top' src="data:image/jpeg;base64, <?php echo base64_encode($registro[5]);?>" style='max-width: 600px; max-height: 350px'></a>
											<div class='card-body'>
												<h4 class='card-title'><a href="datosPelicula.php?c=<?php echo$registro[0];?>"><?php echo  $registro[1];?></a>
												</h4>
												<h6>Director: <?php echo $registro[2];?></h6>
											</div>
											<div class='card-footer'>
												Duración: <?php echo substr($registro[9], 1, 4);?>
											</div>
										</div>
									</div>
							
								<?php
									endwhile;
									mysqli_free_result($res);
									mysqli_close($con);				
								?>
							</div>
						</div>
					<!-- /.row -->
					</div>
			<!-- /.col-lg-9 -->
				</div>
		<!-- /.row -->
			</div>
		</form>
	<?php 
		include_once "footer.php";
	?>
	</body>
</html>
