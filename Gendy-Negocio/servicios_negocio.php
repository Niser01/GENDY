<?php
session_start();
require_once 'DataBase.php';

if(isset($_SESSION['user'])){
}else{
    header('Location: ../index.php');
}

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
        <link rel="stylesheet" href="css/ajustes.css">
    </head>
    <body>

    <section id="principal">
            <div class="barralateral">
                <form action="MenuNegocio.php">
                    <input class="Glogo" type="image" src="css/Imagenes/Nlogogendy.png" name='Glogo' onclick="openForm()" />
                </form>
                <form action="MenuNegocio.php">
                        <input class="ret" type="image" src="css/Imagenes/retorno_invertido.png" name='ret' onclick="openForm()" />
                </form>

                <div class="abajo">
                    <form action="">
                        <input class="Flogo" type="image" src="css/Imagenes/f_logo.png" name='Flogo' onclick="openForm()" />
                    </form>
                    <form action="">
                        <input class="Ilogo" type="image" src="css/Imagenes/I_logo.png" name='Ilogo' onclick="openForm()" />
                    </form>
                    <form action="">
                        <input class="Tlogo" type="image" src="css/Imagenes/T_logo.png" name='Tlogo' onclick="openForm()" />
                    </form>
                    <form action="CerrarSesion.php" >
                        <input class="logout" type="image" src="css/Imagenes/logout_invertido.png" name='logoff' onclick="openForm()" />
                    </form>
                    <form action="">
                        <input class="falla" type="image" src=" "  />
                    </form>
                </div>

            </div>
        

            
            
            <div class = "botones">

            <br>

            <h1>Portafolio de servicios del negocio</h1>

                <p>Ingrese la informacion de los servicios que presta. En caso de ser más de un servico puede repetir la operación cuantas
                    veces sea necesario.
                </p>
                
              <br>

                    <form method="post">
                        <label>Nombre del servicio:</label>
                        <input type="text" name="nombre"> 
                        <label>Descripción del servicio:</label>
                        <input type="text" name="descripcion">
                        <label>Valor del servicio en pesos (COP), sin puntos ni comas:</label>
                        <input type="text" name="valor">
                        <div class="BMod">
                        <input type="submit" value="Agregar" />
                        </div>
                    </form>
                    
                </div>

            </div>

        </section> 
    </body>
</html>