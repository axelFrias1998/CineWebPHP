<?php
    session_start();
    if(!isset($_SESSION["funcion"]) && empty($_SESSION["funcion"]) || !isset($_POST["total"]) && empty($_POST["total"]) || !isset($_SESSION["usuario"]) && empty($_SESSION["usuario"] || !isset($_POST["cantidad"]) && empty($_POST["cantidad"])))
        header("Location: index.php");
    else{
        $_SESSION["total"] = $_POST["total"];
        $_SESSION["cantidad"] = $_POST["cantidad"];
        require "header.php";
    }
?>
<html>
    <head>
        <title>Selecciona tus asientos</title>
    </head>
    <body>
        <br>
            <div class = "container jumbotron">
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
                                <p><b>Sala: </b><?php echo $registro[6];?></p>
                                </div>
                                <form>
                                    <div class ="form group">
                                        <b>Boletos: </b><label id="cantidad"><?php echo $_POST["cantidad"];?></label><br>
                                        <b>Total: </b><?php echo "$".$_POST["total"];?>
                                    </div>
                                </form>
                            </div>
                    <?php endif;
                        $_SESSION["formato"] = $registro[3];
                        mysqli_free_result($res);

                        $res = mysqli_query($con, "SELECT FilasAsientos, ColumnasAsientos from sala where Id = ".$registro[6].";");
                        if($size = mysqli_fetch_row($res)){
                            $nFilas = $size[0];
                            $nColumnas = $size[1];
                        }
                        mysqli_free_result($res);
                    ?>
                    <div class="col">
                        <form action="generarOrden.php" method="POST" onsubmit="return validacion()">
                            <div class ="form.group">
                                <h2>Selecciona tus asientos</h2>
                                <hr>
                                <center>
                                    <table>
                                        <tr>
                                            <td><img src="img/asientoSeleccionado.png" style="max-width: 35; max-height: 35"></td>
                                            <td>Seleccionado</td>
                                            <td><img src="img/asientoOcupado.png" style="max-width: 35; max-height: 35"></td>
                                            <td>Ocupado</td>
                                            <td ><img src="img/asiento.png" style="max-width: 35; max-height: 35"> </td>
                                            <td>Disponible</td>
                                        </tr>
                                    </table>
                                </center>
                                <hr>
                                <center>
                                    <table>
                                    <?php 
                                        $res = mysqli_query($con, "SELECT asientofuncion.Asiento_Id, asiento.Lugar, asientofuncion.Funcion_Id, asientofuncion.Disponible
                                        from asientofuncion
                                        inner join asiento on asiento.Id = asientofuncion.Asiento_Id where Funcion_Id =".$_SESSION["funcion"].";");
                                        $contador = 0;
                                        $fila = 65;
                                        while($asiento = mysqli_fetch_row($res)):
                                            if($contador == 0):?>
                                                <tr>
                                                    <td><?php echo chr($fila); $fila++;?></td>
                                                    <!--Si el asiento no está disponible-->
                                                <?php if($asiento[3] == false):?>
                                                        <td>
                                                            <label ><img src="img/asientoOcupado.png" style="max-width: 35; max-height: 35;" title = "<?php echo $asiento[1];?>"></label>
                                                        </td>
                                                <?php elseif($asiento[3]):?>
                                                        <td>
                                                            <input type="checkbox" name="asientos[]" id="asiento<?php echo $asiento[1];?>" style="display:none;" value="<?php echo $asiento[0];?>" onclick="cambia(this, 'imagen<?php echo $asiento[1];?>')">
                                                            <label for="asiento<?php echo $asiento[1];?>"><img src="img/asiento.png" style="max-width: 35; max-height: 35;" id ="imagen<?php echo $asiento[1];?>" title = "<?php echo $asiento[1];?>"></label>
                                                        </td>
                                                <?php endif;?>
                                            <?php
                                                $contador++;
                                                elseif($contador > 0 && $contador < $nColumnas - 1):?>
                                                    <?php if($asiento[3] == false):?>
                                                        <td>
                                                            <label ><img src="img/asientoOcupado.png" style="max-width: 35; max-height: 35;" title = "<?php echo $asiento[1];?>"></label>
                                                        </td>
                                                    <?php elseif($asiento[3]):?>
                                                        <td>
                                                            <input type="checkbox" name="asientos[]" id="asiento<?php echo $asiento[1];?>" style="display:none;" value="<?php echo $asiento[0];?>" onclick="cambia(this, 'imagen<?php echo $asiento[1];?>')">
                                                            <label for="asiento<?php echo $asiento[1];?>"><img src="img/asiento.png" style="max-width: 35; max-height: 35;" id ="imagen<?php echo $asiento[1];?>" title = "<?php echo $asiento[1];?>"></label>
                                                        </td>
                                                    <?php endif;?>
                                            <?php 
                                                $contador++;
                                                elseif($contador == $nColumnas - 1):?>
                                                    <?php if($asiento[3] == false):?>
                                                        <td>
                                                            <label ><img src="img/asientoOcupado.png" style="max-width: 35; max-height: 35;" title = "<?php echo $asiento[1];?>"></label>
                                                        </td></tr>
                                                    <?php elseif($asiento[3]):?>
                                                        <td>
                                                            <input type="checkbox" name="asientos[]" id="asiento<?php echo $asiento[1];?>" style="display:none;" value="<?php echo $asiento[0];?>" onclick="cambia(this, 'imagen<?php echo $asiento[1];?>')">
                                                            <label for="asiento<?php echo $asiento[1];?>"><img src="img/asiento.png" id ="imagen<?php echo $asiento[1];?>"style="max-width: 35; max-height: 35;" title = "<?php echo $asiento[1];?>"></label>
                                                        </td></tr>
                                                    <?php endif;?>
                                            <?php 
                                                $contador = 0;
                                                endif; 
                                        endwhile;
                                        mysqli_free_result($res);
                                        mysqli_close($con);?>
                                    </table>
                                </center>
                                <center><input class="btn btn-danger" type="submit" id="submit" name="submit" value="¡Compra!"></center>
                                <div id="alerta" class="alert alert-danger" role="alert" style="visibility:hidden;">
                                    <h4 class="alert-heading">¡Oh, no! :(</h4>
                                    <p>Selecciona <?php echo $_POST["cantidad"];?> boletos para continuar.</P>                                    
                                </div>
                                <div id="alertaSaldo" class="alert alert-danger" role="alert" style="visibility:hidden;">
                                    <h4 class="alert-heading">¡Oh, no! :(</h4>
                                    <p>No dispones de saldo suficiente para tu compra.</P>                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    <?php
        include_once "footer.php";
    ?>
    </body>
</html>
<script>
    var cantidad = parseInt(document.getElementById('cantidad').textContent);
    var asientosSeleccionados = 0;
    function cambia(checkbox, id){
        if(checkbox.checked){
            if(asientosSeleccionados < cantidad){
                asientosSeleccionados++;
                console.log(cantidad + " ,sekeccionados:" + asientosSeleccionados);
                console.log(checkbox.value + ":seleccionado");
                document.getElementById(id).src = "img/asientoSeleccionado.png";
            }
            else{
                checkbox.checked = false;
                document.getElementById(id).style.backgroundColor = "";
            }
        }
        else{
            asientosSeleccionados--;
            console.log(cantidad + " ,seleccionados:" + asientosSeleccionados);
            console.log(checkbox.value + ":arrepentido");
            document.getElementById(id).src = "img/asiento.png";
        }
    }

    function validacion(){
        if(asientosSeleccionados != cantidad){
            document.getElementById("alerta").style.visibility = 'visible';
            return false;
        }
        else if(asientosSeleccionados == cantidad){
            document.getElementById("alerta").style.visibility = 'hidden';
            var saldo = parseFloat("<?php echo $_SESSION["saldo"];?>");
            var total = parseFloat("<?php echo $_SESSION["total"];?>");
            console.log(saldo + ", total: " + total);
            if(saldo >= total){
                document.getElementById("alertaSaldo").style.visibility = 'hidden';
                return true
            }
            else{
                document.getElementById("alertaSaldo").style.visibility = 'visible';
                return false;
            }
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


       