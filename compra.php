<?php
    session_start();
    if(!isset($_SESSION["usuario"]) || empty($_SESSION["usuario"])){
        echo'<script>alert("Identifícate para poder comprar.");</script>';
    }
    if(!isset($_GET["funcion"]) || empty($_GET["funcion"]))
        header("Location: index.php");
    else{
        $_SESSION["funcion"] = $_GET["funcion"];
        require "header.php";
    }  
?>
<html>
    <body>
    <br>
    <div class = "jumbotron">
        <div class = "container">
            <div class = "row">
            <?php
                ini_set("display errors", E_ALL);
                include_once "conexion.php";
                $con = conexion();
                mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
                $res = mysqli_query($con, "SELECT pelicula.Titulo, pelicula.Clasificacion, tipoproyeccion.Nombre, funcion.Fecha, funcion.HoraInicio, funcion.Sala_Id, tipoproyeccion.Costo from funcion  inner join pelicula  on funcion.Pelicula_Id = pelicula.Id join tipoproyeccion on funcion.TipoProyeccion_Id = tipoproyeccion.Id  where funcion.Id = ".$_GET["funcion"].";");
                if ($registro = mysqli_fetch_row($res)):?>
                <div class ="col-4">
                    <form>
                        <div class="form-group">
                            <h2>Datos de compra</h2><br>
                            <hr>
                            <img src="" alt="200x200"><br>
                            <p><b>Título: </b><?php echo $registro[0];?></p>
                            <p><b>Clasificación: </b><?php echo $registro[1];?></p>
                            <p><b>Versión: </b><?php echo $registro[2];?></p>
                            <p><b>Fecha: </b><?php echo $registro[3];?></p>
                            <p><b>Horario: </b><?php echo $registro[4];?></p>
                            <p><b>Sala: </b><?php echo $registro[5];?></p>
                        </div>
                    </form>
                </div>
                <div class="col">
                    <div class ="form-group">
                        <h3>Selecciona tus boletos</h3><br>
                        <hr>
                        Boleto <?php echo $registro[2];?>: | $<label id="costo"><?php echo $registro[6]?></label>
                        
                        <input type="button" name="menos" value = "Restar" onclick="op('resta')"/>
                        <p id="num" name="cantidadBoletos">0</p>
                        <input type="button" name="mas" value = "Sumar" onclick="op('suma')"/><br>
                        
                        Total a pagar: $<label id="total" name="total" id="resultadoBoletos">0</label><br>
                        <button type="button" class="btn btn-secondary" onclick="location.href='index.php'">Cancelar</button><button type="button" class="btn btn-danger">Continuar</button>
                    </div>
                </div>
                <?php 
                    endif;
                    mysqli_free_result($res);
                    mysqli_close($con);
                ?>
                
            </div>
        </div>
    </div>
    </body>
</html>
<script>
    function op(x){
        var cantidad = parseInt(document.getElementById('num').textContent);
        var costo = parseInt(document.getElementById('costo').textContent);
        var total = parseInt(document.getElementById('total'.textContent));
        if(cantidad >= 0 && cantidad <= 10){
            if(x == 'resta'){
                cantidad = cantidad - 1;
                if(cantidad >= 0){
                    document.getElementById('num').textContent = cantidad;
                    total = cantidad * costo;
                    document.getElementById('total').textContent = total;
                }
            }
            if(x == 'suma'){
                cantidad = cantidad + 1;
                if(cantidad <= 10){
                    document.getElementById('num').textContent = cantidad;
                    total = cantidad * costo;
                    document.getElementById('total').textContent = total;
                }
            }
        }
    }
</script>