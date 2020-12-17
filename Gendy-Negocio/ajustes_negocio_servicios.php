<?php
session_start();
require_once 'DataBase.php';
$c=$_SESSION['user'];



if(isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['valor']) 
&& !empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['valor'])){

    $sql1="SELECT * FROM gendy.servicios";
    $num=$DB->prepare($sql1); 
    $num->execute();
    $numero=$num->rowCount(); 
    $numero=$numero+1; 
    
    $sql="INSERT INTO gendy.servicios(`ID_SERVICIOS`, `ID_NEGOCIO`, `NOMBRE_SERVICIOS`, `DESCRIPCION_SERVICIOS`, `PRECIO_SERVICIO`) 
    VALUES (:id_ser, :id_neg, :nombre, :descripcion, :valor)";

    $ingreso = $DB->prepare($sql);

    $ingreso->execute(array(

        ':id_ser' => $numero, 
        ':id_neg' => $c, 
        ':nombre' => $_POST['nombre'],
        ':descripcion' => $_POST['descripcion'],
        ':valor' => $_POST['valor']));

}
?>

<html>

    <head>
        <meta charset="utf-8">
        <title>Gendy | Ajustes Negocio</title>
        <link rel="stylesheet" href="css/ajustes_servicios.css">
    </head>
    <body>
        

            <h1>Servicios negocio</h1>
            
            <div class="titulo">

                <p>Ingrese la informacion de los servicios que presta. En caso de ser más de un servico puede repetir la operación cuantas
                    veces sea necesario.
                </p>
                
                <div class = "botones">

                    <form method="post">
                        <label>Nombre del servicio:</label>
                        <input type="text" name="nombre"> 
                        <label>Descripción del servicio:</label>
                        <input type="text" name="descripcion">
                        <label>Valor del servicio en pesos (COP), sin puntos ni comas:</label>
                        <input type="text" name="valor">
                        <input type="submit" value="Agregar" />
                    </form>
                    
                </div>

                <form action="ajustes_negocio_pre.php" >
                        <input class="boton_volver" type="submit" value="Volver" name='Volver' onclick="" />
                </form>

            </div>

    </body>
</html>