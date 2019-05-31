<html>
    <head>
        <meta charset="ISO-8859-1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/shop-homepage.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <img src="img/Cinezone.jpg" width="10%" height="10%">
                <a class="navbar-brand" href="index.php">Cinezona</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <?php if(!isset($_SESSION["usuario"])):?>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="modal" data-target="#modalRegistro">Registrarse</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="modal" data-target="#modalInicio">Iniciar Sesión</a>
                            </li>
                        </ul>
                    <?php 
                        endif; 
                        if(isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])): ?>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#" ><?php echo "Bienvenido ".$_SESSION["usuario"];?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cerrarSesion.php">Cerrar Sesión</a>
                            </li>
                        </ul>
                    <?php endif;?>
                </div>
            </div>
        </nav>

        <div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <link rel="stylesheet" href="css/Estilos.css">
            <div class = "modal-dialog card card-signin my-5">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                <div class="container">
                    <div class="modal-body card-body">
                        <h5 class="card-title text-center"><b>Registrarse</b></h5>
                        <form action="registro.php" class="form-signin" method="POST">
                            <div class="form-label-group">
                                <input type="text" id="nombreUsuario" name="nombreUsuario" class="form-control" placeholder="Nombre" required autofocus>
                                <label for="nombreUsuario">Nombre</label>
                            </div>
                            <div class="form-label-group">
                                <input type="email" id="emailUsuario" name="emailUsuario" class="form-control" placeholder="Cuenta de e-mail" required>
                                <label for="emailUsuario">Cuenta de e-mail</label>
                            </div>
                            <div class="form-label-group">
                                <input type="password" id="passUsuario" name="passUsuario" class="form-control" placeholder="Contraseña" required>
                                <label for="passUsuario">Contraseña</label>
                            </div>
                            <div class="form-label-group">
                                <input type="password" id="pass2Usuario" name="pass2Usuario" class="form-control" placeholder="Confirmar contraseña" required>
                                <label for="pass2Usuario">Confirmar contraseña</label>
                            </div>
                            <input class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value ="Registrarme"/>
                            <hr class="my-4">
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
	<!-- Ventana Modal del Inicio de Sesión de los Usuarios -->
        <div class="modal fade" id="modalInicio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <link rel="stylesheet" href="Estilos2.css">
            <div class = "modal-dialog card card-signin my-5">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="container">
                        <div class="modal-body card-body">
                            <h5 class="card-title text-center">Iniciar Sesión</h5>
                            <form class="form-signin" id="IS" name="IS" action="login.php" method="POST">
                                <div class="form-label-group">
                                    <input type="email" id="emailUsuarioIS" name="emailUsuarioIS" class="form-control" placeholder="Cuenta de e-mail" required>
                                    <label for="emailUsuarioIS">Correo</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="password" id="passUsuarioIS" name="passUsuarioIS" class="form-control" placeholder="Contraseña" required>
                                    <label for="passUsuarioIS">Contraseña</label>
                                </div>
                                <input class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value = "Iniciar sesión"/>
                                <hr class="my-4">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
        <script src="vendor\jquery\jquery.js"></script>
        <script src="vendor\bootstrap\js\bootstrap.js"></script> 
    </body>
</html>