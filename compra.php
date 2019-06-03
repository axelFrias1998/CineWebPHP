<?php
    session_start();
    if(!isset($_SESSION["usuario"]) && empty($_SESSION["usuario"])){
        header("Location: index.php");
    }
    if(!isset($_GET["f"]) && empty($_GET["f"]))
        header("Location: index.php");
    else{
        $_SESSION["funcion"] = $_GET["f"];
        require "header.php";
    }  
?>
<html>
    <body>
    <br><br>
        <div class = "container jumbotron">
            <div class = "row">
            <?php
                ini_set("display errors", E_ALL);
                include_once "conexion.php";
                $con = conexion();
                mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
                $res = mysqli_query($con, "SELECT pelicula.Titulo, pelicula.Imagen, pelicula.Clasificacion, tipoproyeccion.Nombre, funcion.Fecha, funcion.HoraInicio, funcion.Sala_Id, tipoproyeccion.Costo from funcion  inner join pelicula  on funcion.Pelicula_Id = pelicula.Id join tipoproyeccion on funcion.TipoProyeccion_Id = tipoproyeccion.Id  where funcion.Id = ".$_GET["f"].";");
                if ($registro = mysqli_fetch_row($res)):?>
                <div class ="col-4">
                    
                        <div class="form-group">
                            <h2>Datos de compra</h2>
                            <hr>
                            <center><img src="data:image/jpeg;base64, <?php echo base64_encode($registro[1]);?>" alt="200x200"></center>
                            <hr>
                            <p><font color="F9821F"><b>Título: </b></font><?php echo $registro[0];?></p>
                            <p><font color="F9821F"><b>Clasificación: </b></font><?php echo $registro[2];?></p>
                            <p><font color="F9821F"><b>Versión: </b></font><?php echo $registro[3];?></p>
                            <p><font color="F9821F"><b>Fecha: </b></font><?php echo $registro[4];?></p>
                            <p><font color="F9821F"><b>Horario: </b></font><?php echo $registro[5];?></p>
                            <p><font color="F9821F"><b>Sala: </b></font><?php echo $registro[6];?></p>
                        </div>
                </div>
                <div class="col">
                    <form method="post" action="asientos.php" onsubmit="return validacion()">
                        <div class ="form-group">
                            <h2><font color="#F0591C"><b>Selecciona tus boletos</b></font></h2><br>
                            Boleto <?php echo $registro[3];?>: | $<label id="costo"><?php echo $registro[7]?></label><br>
                            
                            <button type="button" class="btn btn-primary" name="menos" style="background:#FFFFFF" onclick="op('resta')"><b><font color="#1C7EF0">  - </font></b></button>
                            <label id="num" name="cantidadBoletos">0</label>
                            <button type="button" class="btn btn-primary" name="mas" style="background:#FFFFFF" onclick="op('suma')"><b><font color="#1C7EF0">  + </font></b></button> <br>
                                
                            Total a pagar: $<label name="total" id="resultadoBoletos">0</label><br>
                            
                            <input type = "hidden" name = "total" id = "inputTotal"/><input type = "hidden" name = "cantidad" id = "cantidadBoletos"/><br>
                            <button type="button" class="btn btn-secondary" style="background:#CEC5BF " color="#FFFFFF" onclick="location.href='index.php'"><b><font color="#FFFFFF"> Cancelar </font></b></button>
                            <!--<button type="button" class="btn btn-secondary" href='index.php'>Cancelar</button>-->&nbsp;
                            <input type="submit" style="background:#F83714; font-color: #FFFFFF " title = "Continuar" class="btn btn-danger">
                        </div>
                    </form>
                    <div id="alerta" class="alert alert-danger" role="alert" style="visibility:hidden;">
                        <h4 class="alert-heading">¡Oh, no! :(</h4>
                        <p>No podemos continuar si no seleccionas al menos un boleto.</P>                                    
                    </div>
                </div>
                <?php 
                    endif;
                    mysqli_free_result($res);
                    mysqli_close($con);
                ?>
                
            </div>
        </div>
    
    <?php
        include_once "footer.php";
    ?>
    </body>
</html>
<script>
    function validacion(){
        var cantidad = parseInt(document.getElementById('num').textContent);
        if(cantidad == 0){
            document.getElementById("alerta").style.visibility = 'visible';
            return false;
        }
        else
            return true;
    }
    function op(x){
        var cantidad = parseInt(document.getElementById('num').textContent);
        var costo = parseFloat(document.getElementById('costo').textContent);
        var total = parseFloat(document.getElementById('resultadoBoletos'.textContent));
        if(cantidad >= 0 && cantidad <= 10){
            if(x == 'resta'){
                cantidad = cantidad - 1;
                if(cantidad >= 0){
                    document.getElementById('num').textContent = cantidad;
                    total = cantidad * costo;
                    document.getElementById('resultadoBoletos').textContent = total;
                    document.getElementById('inputTotal').value = total;
                    document.getElementById('cantidadBoletos').value = cantidad;
                }
            }
            if(x == 'suma'){
                cantidad = cantidad + 1;
                if(cantidad <= 10){
                    document.getElementById('num').textContent = cantidad;
                    total = cantidad * costo;
                    document.getElementById('resultadoBoletos').textContent = total;
                    document.getElementById('inputTotal').value = total;
                    document.getElementById('cantidadBoletos').value = cantidad;
                }
            }
        }
    }
</script>