<?php
    session_start();
?>
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
                    <ul class="navbar-nav ml-auto">
                    <?php
                        if(empty($_SESSION["usuario"]) || !isset($_SESSION["usuario"])){
                    ?>
                    <li class="nav-item active">
                        <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modalLRForm" >Identifícate</button>
                    </li>
                    <?php
                        }
                        elseif(!empty($_SESSION["usuario"])){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><?php echo "Bienvenido ".$_SESSION["usuario"];?></a>
                    </li>
                    <?php
                        }
                    ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="modal fade" id="modalLRForm" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog cascading-modal" role="document">
                <!--Contenido-->
                <div class="modal-content">

                <!--Modaal en cascada-->
                <div class="modal-c-tabs">

                    <!-- Tabs de inicio de sesión o registro -->
                    <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#panelInicio" role="tab"><i class="fas fa-user mr-1"></i>
                        Inicio de sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#panelRegistro" role="tab"><i class="fas fa-user-plus mr-1"></i>
                        Registro</a>
                    </li>
                    </ul>

                    <!--Páneles de identificación-->
                    <div class="tab-content">
                        <!--Panel inicio de sesión-->
                        <div class="tab-pane fade in show active" id="panelInicio" role="tabpanel">

                            <!--Cuerpo inicio de sesión-->
                            <div class="modal-body mb-1">
                                <form method="post">
                                    <div class="md-form form-sm mb-5">
                                        <label data-error="wrong" data-success="right" for="modalLRInput10">Correo</label>
                                        <input type="email" id="correoLogin" class="form-control form-control-sm validate" name="correoLogin" placeholder="Correo">
                                    </div>

                                    <div class="md-form form-sm mb-4">
                                        <label data-error="wrong" data-success="right" for="modalLRInput11">Contraseña</label>
                                        <input type="password" id="passLogin" class="form-control form-control-sm validate" placeholder="Contraseña">
                                    </div>
                                    <div class="text-center mt-2">
                                        <input type="submit" class="btn btn-info" value="Inicio de sesión">
                                        <?php
                                            if(isset($_POST["correoLogin"]))
                                                $_SESSION["usuario"] = $_POST["correoLogin"];
                                        ?>
                                    </div>
                                </form>
                            </div>
                            <!--Footer-->
                            <div class="modal-footer">
                                <!--<div class="options text-right">
                                    <p class="pt-1">Already have an account? <a href="#" class="blue-text">Log In</a></p>
                                </div>-->
                                <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Cerrar</button>
                            </div>

                        </div>
                    <!--/Panel inicio de sesión-->

                    <!--Panel Registro-->
                    <div class="tab-pane fade" id="panelRegistro" role="tabpanel">

                        <!--Body-->
                        <div class="modal-body">
                            <form method="post">
                                <div class="md-form form-sm mb-5">
                                    <label data-error="wrong" data-success="right" for="modalLRInput12">Nombre</label>
                                    <input type="text" id="nombreRegistro" class="form-control form-control-sm validate" placeholder="Nombre">
                                    
                                </div>
                                <div class="md-form form-sm mb-5">
                                    <label data-error="wrong" data-success="right" for="modalLRInput12">Correo</label>
                                    <input type="email" id="emailRegistro" class="form-control form-control-sm validate" placeholder="Correo">
                                    
                                </div>

                                <div class="md-form form-sm mb-5">
                                    <label data-error="wrong" data-success="right" for="modalLRInput13">Contraseña</label>
                                    <input type="password" id="passRegistro" class="form-control form-control-sm validate" placeholder="Contraseña">
                                    
                                </div>

                                <div class="md-form form-sm mb-4">
                                    <label data-error="wrong" data-success="right" for="modalLRInput14">Repite contraseña</label>
                                    <input type="password" id="modalLRInput14" class="form-control form-control-sm validate" placeholder="Repite contraseña">
                                </div>

                                <div class="text-center form-sm mt-2">
                                    <input type="submit" class="btn btn-info" value="Regístrate"><!--<i class="fas fa-sign-in ml-1"></i>-->
                                </div>
                            </form>
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                        <!--<div class="options text-right">
                            <p class="pt-1">Already have an account? <a href="#" class="blue-text">Log In</a></p>
                        </div>-->
                        <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!--/.Panel Registro-->
                    </div>

                </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
        <script src="vendor\jquery\jquery.js"></script>
        <script src="vendor\bootstrap\js\bootstrap.js"></script> 
    </body>
</html>