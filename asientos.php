<?php
    require "header.php";
?>
<html>
    <body>
        <div class="jumbotron">
            <div class = "container">
                <div class = "row">
                    <div class ="col-4">
                        <form>
                            <div class="form-group">
                                <h2>Datos de compra</h2><br>
                                <hr>
                                <img src="" alt="200x200"><br>
                                <p><b>Título:</b>P</p>
                                <p><b>Clasificación:</b>P</p>
                                <p><b>Versión:</b>P</p>
                                <p><b>Fecha:</b>P</p>
                                <p><b>Horario:</b>P</p>
                                <p><b>Sala:</b>P</p>
                            </div>
                        </form>
                        <form>
                            <div class ="form group">
                                TOTAL:
                            </div>
                        </form>
                    </div>
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
                                <tr><td colspan=12 bgcolor="000000"></td></tr>
                                <?php for($i = 0; $i <= 10; $i++):?>
                                    <tr>
                                        <?php for($j=0; $j<=10; $j++):?>
                                        <td onclick='cambiarFondo(this)'><img src="img/asiento.png" style="max-width: 25; max-height: 25" > </td>
                                        <?php endfor;?>
                                        <td>A</td>
                                    </tr>
                                <?php endfor;?>
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
    