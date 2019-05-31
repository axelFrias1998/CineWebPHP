<?php
    session_start();
    if(!isset($_SESSION["funcion"]) && empty($_SESSION["funcion"]) || !isset($_POST["total"]) && empty($_POST["total"]) || !isset($_SESSION["usuario"]) && empty($_SESSION["usuario"] || !isset($_POST["cantidad"]) && empty($_POST["cantidad"])))
        header("Location: index.php");
    else{
        require "header.php";
    }
?>
<html>
    <body>
        <div class="jumbotron">
            <div class = "container">
                <div class = "row">
                    <?php
                        ini_set("display errors", E_ALL);
                        include_once "conexion.php";
                        $con = conexion();
                        mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
                        $res = mysqli_query($con, "SELECT pelicula.Titulo, pelicula.Imagen, pelicula.Clasificacion, tipoproyeccion.Nombre, funcion.Fecha, funcion.HoraInicio, funcion.Sala_Id, tipoproyeccion.Costo from funcion  inner join pelicula  on funcion.Pelicula_Id = pelicula.Id join tipoproyeccion on funcion.TipoProyeccion_Id = tipoproyeccion.Id  where funcion.Id = ".$_SESSION["funcion"].";");
                        if ($registro = mysqli_fetch_row($res)):?>
                            <div class ="col-4">
                                <div class="form-group">
                                <h2>Datos de compra</h2>
                                <hr>
                                <center><img src="data:image/jpeg;base64, <?php echo base64_encode($registro[1]);?>" alt="200x200"></center>
                                <hr>
                                <br>
                                <p><b>Título: </b><?php echo $registro[0];?></p>
                                <p><b>Clasificación: </b><?php echo $registro[2];?></p>
                                <p><b>Versión: </b><?php echo $registro[3];?></p>
                                <p><b>Fecha: </b><?php echo $registro[4];?></p>
                                <p><b>Hora: </b><?php echo substr($registro[5], 1, 4);?></p>
                                <p><b>Sala: </b><?php echo $registro[6]." ".$_SESSION["funcion"];?></p>
                                </div>
                                <form>
                                    <div class ="form group">
                                        Boletos: <?php echo $_POST["cantidad"];?>
                                        TOTAL: <?php echo "$".$_POST["total"];?>
                                    </div>
                                </form>
                            </div>
                    <?php endif;
                        mysqli_free_result($res);

                        $res = mysqli_query($con, "SELECT FilasAsientos, ColumnasAsientos from sala where Id = ".$registro[6].";");
                        if($size = mysqli_fetch_row($res)){
                            $nFilas = $size[0];
                            $nColumnas = $size[1];
                        }
                        mysqli_free_result($res);
                    ?>
                    <div class="col">
                        <form>
                            <div class ="form.group">
                                <h2>Selecciona tus asientos</h2>
                                <hr>
                                <table>
                                    <tr>
                                        <td bgcolor="#00FF00"><img src="img/asiento.png" style="max-width: 25; max-height: 25" value="1"></td>
                                        <td>Seleccionado</td>
                                        <td bgcolor="#FF0000"><img src="img/asiento.png" style="max-width: 25; max-height: 25"></td>
                                        <td>Ocupado</td>
                                        <td ><img src="img/asiento.png" style="max-width: 25; max-height: 25"> </td>
                                        <td>Disponible</td>
                                    </tr>
                                </table>
                                <hr>
                                <table>
                                    <?php 
                                        $res = mysqli_query($con, "SELECT asientofuncion.Asiento_Id, asiento.Lugar, asientofuncion.Funcion_Id, asientofuncion.Disponible
                                        from asientofuncion
                                        inner join asiento on asiento.Id = asientofuncion.Asiento_Id where Funcion_Id =".$_SESSION["funcion"].";");
                                        $contador = 0;
                                        while($asiento = mysqli_fetch_row($res)):
                                            if($contador == 0):?>
                                                <tr><td onclick='cambiarFondo(this)'><img src="img/asiento.png" style="max-width: 25; max-height: 25" title="<?php echo $asiento[0];?>"></td>
                                            <?php
                                                $contador++;; 
                                                elseif($contador > 0 && $contador < $nColumnas - 1):?>
                                                    <td onclick='cambiarFondo(this)'><img src="img/asiento.png" style="max-width: 25; max-height: 25" title="<?php echo $asiento[0];?>"></td>
                                            <?php 
                                                $contador++;
                                                elseif($contador == $nColumnas - 1):?>
                                                    <td onclick='cambiarFondo(this)'><img src="img/asiento.png" style="max-width: 25; max-height: 25" title="<?php echo $asiento[0];?>"></td></tr>
                                            <?php 
                                                $contador = 0;
                                                endif; 
                                        endwhile;
                                        mysqli_free_result($res);
                                        mysqli_close($con);?>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    function cambiarFondo(celda){
                
                if (celda.style.backgroundColor == "LawnGreen"){
                    celda.style.backgroundColor = "transparent"
                }else{
                    celda.style.backgroundColor = "LawnGreen"
                }
              }
</script>
 <!--
        Obtener número de columnas y fila de la sala
        fetch row de  
            select asientofuncion.Asiento_Id, asiento.Lugar, asientofuncion.Funcion_Id, asientofuncion.Disponible
            from asientofuncion
            inner join asiento on asiento.Id = asientofuncion.Asiento_Id where Funcion_Id = 1;
        agregarle un contador que evalúe:/
              Si contador = 0
                agrega <tr><td>CONTENIDO</td>
              Si contador > 0 y menor a N COLUMNAS
                agrega <td>CONTENIDO</td>
              Si contador = N COLUMNAS -1
                agrega <td></td></tr>-->   