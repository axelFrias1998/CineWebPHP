<?php
    require "header.php";
?>
<html>
    <body>
    <br>
    <div class = "jumbotron">
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
                    
                </div>
                <div class="col">
                    <div class ="form-group">
                        <h3>Selecciona tus boletos</h3><br>
                        <hr>
                        Boleto FORMATO: | $PRECIO&nbsp;&nbsp;&nbsp;<input type="number" name="cantidadBoletos" value = "0" max="10" min="0" data-up-down="init"><br>
                        Total a pagar: <label name="total" > AQUI RESULTADO</label><br>
                        <button type="button" class="btn btn-secondary" onclick="location.href='index.php'">Cancelar</button><button type="button" class="btn btn-danger">Continuar</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    </body>
</html>