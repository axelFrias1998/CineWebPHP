<?php
    header("Content-type: image/jpeg");
    ini_set("display errors", E_ALL);
    $host="127.0.0.1";
    $port=3306;
    $socket="";
    $user="root";
    $password="Suripanta.98";
    $dbname="cinedb";

    $con = new mysqli($host, $user, $password, $dbname, $port, $socket)
        or die ('Could not connect to the database server' . mysqli_connect_error());

    //$con->close();

    
    //COMPROBAR CONEXION
    if (mysqli_connect_errno()) {
        printf("Conexion fallida: %s\n", mysqli_connect_error());
        exit();
    }
    
    echo("Conexion exitosa");
    
    
    //RECUPERAR LOS REGISTROS
    
    $res = mysqli_query($con, "SELECT Imagen FROM pelicula WHERE Id = '$id'");
    if(isset($_GET['id'])){ 
        $id = $_GET['id']; 
         
        $link = mysql_connect("localhost", "root", "Suripanta.98") or die ("ERROR AL CONECTAR"); 
        $db_select = mysql_select_db("db_colossus"); 
         
        $q = "SELECT i_img FROM items WHERE item_id = '$id'"; 
        $img = mysqli_query($q, $link); 
         
        print $img; 
        } 
    ?>
?>