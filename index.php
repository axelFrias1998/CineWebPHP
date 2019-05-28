<?php
	session_start();
	include "header.php";
	if(isset($_SESSION["errorRol"])){
		echo'<script>alert("El usuario no tiene acceso al sistema.")</script>';
		$_SESSION["errorRol"] = null;
	}
	if(isset($_SESSION["peliculaId"]))
		$_SESSION["peliculaId"] = null;
	if(isset($_SESSION["funcion"]))
		$_SESSION["funcion"] = null;
?>
<html>
	<body>
		<form>
			<div class="container">
				<div class="row">
					<div class="col-lg-3">
						<h1 class="my-4">Shop Name</h1>
						<div class="list-group">
						<a href="#" class="list-group-item">Category 1</a>
						<a href="#" class="list-group-item">Category 2</a>
						<a href="#" class="list-group-item">Category 3</a>
					</div>
				</div>
		<!-- /.col-lg-3 -->

					<div class="col-lg-9">

						<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
								<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
								<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
							</ol>
						<div class="carousel-inner" role="listbox">
							<div class="carousel-item active">
								<img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
							</div>
							<div class="carousel-item">
								<img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
							</div>
							<div class="carousel-item">
								<img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
							</div>
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
											<a href="datosPelicula.php?clave=<?php echo $registro[0];?>"><img class='card-img-top' src="blob.php?id=<?php
												echo $registro[0];?>" style='max-width: 700px; max-height: 400px' alt=""></a>
											<div class='card-body'>
												<h4 class='card-title'><a href="datosPelicula.php?clave=<?php echo$registro[0];?>"><?php echo  $registro[1];?></a>
												</h4>
												<h6>Director: <?php echo $registro[2];?></h6>
											</div>
											<div class='card-footer'>
												<?php echo $registro[9]." horas.";?>
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

		
	</body>
</html>
